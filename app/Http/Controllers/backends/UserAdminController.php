<?php
namespace App\Http\Controllers\backends;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\User;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserAdminController extends Controller {

    public function index(Request $request){
        $s = $request->s;
        $role = $request->role;
        $users = User::query(); 
        if($role != "") $users = $users->role($role);
        if($s != "") $users = $users->where('name','like', '%'.$s.'%');
        $users = $users->latest()->paginate(12);
        $data = [
            'users' => $users,
            's' => $s,
            'role' => $role,
            'roles' => Role::all(),
        ];
       return view('backends.users.list',$data);
    }

    public function create(Request $request){
        $data = [
            'roles' => Role::all(),
        ];
       return view('backends.users.create', $data);
    }

    public function store(Request $request, CreatesNewUsers $creator){
        event(new Registered($user = $creator->create($request->all())));
        if($user) {
            $request->session()->flash('success', 'Create Successful!');
            if($request->role != '') {
                $check_exist = Role::where('name', $request->role)->first();
                if($check_exist) $user->assignRole($request->role);
                else {
                    $request->session()->flash('error', 'Role '.$request->role.' not exist!');
                    return redirect()->route('admin.user_create');
                }
            }
        }else{
            $request->session()->flash('error', 'Has error!');
            return redirect()->route('admin.user_create');
        }
        return redirect()->route('admin.users');
    }

    public function edit(Request $request, $id){
        $user = User::findOrFail($id);
        $data = [
            'user' => $user,
            'roles' => Role::all(),
        ];
        return view('backends.users.edit', $data);
    }

    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $rules = [
            'phone'=>['required',Rule::unique('users')->ignore($user->id)],
            'email'=>['required','email',Rule::unique('users')->ignore($user->id)],
            'displayname'=>'required',
        ];
        $messages = [
            'phone.required'=>__('Please input phone number!'),
            'phone.unique'=>__('Phone had exist!'),
            'email.required'=>__('Please input email!'),
            'email.unique'=>__('Email had exist!'),
            'displayname.required'=>__('Please input display name!'),
        ];
        if($request->password != ''){
            $rules['password'] = 'required|min:8|max:32';
            $rules['confirmPassword'] = 'required|same:password';
            $messages['password.required'] = __('Please input password!');
            $messages['password.min'] = __('Password min is 8 characters!');
            $messages['password.max'] = __('Password min is 32 characters!');
            $messages['confirmPassword.required'] = __('Please confirm password!');
            $messages['confirmPassword.same'] = __('Password confirm not match!');
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if($validator->fails()){
            return redirect()->route('admin.user_edit',['id'=>$id])->withErrors($validator)->withInput();
        }else{
            $user->phone = $request['phone'];
            $user->email = $request['email'];
            $user->address = $request['address'];
            $user->image = $request['image'];
            $user->amount = $request['amount'];
            $user->displayname = $request['displayname'];
            if($request->password != '') $user->password = bcrypt($request->password);
            if($user->save()) {
                if($request->role != '') {
                    $check_exist = Role::where('name', $request->role)->first();
                    if($check_exist) $user->syncRoles([$request->role]);
                    else {
                        $request->session()->flash('error', 'Role '.$request->role.' not exist!');
                        return redirect()->route('admin.user_edit',['id'=>$id]);
                    }
                }
                $request->session()->flash('success', 'Update Successful!');
                return redirect()->route('admin.user_edit',['id'=>$id]);
            }else{
                $request->session()->flash('error', 'Has error!');
                return redirect()->route('admin.user_edit',['id'=>$id]);
            }
        }
    }

    public function delete(Request $request, $id){
        $user = User::findOrFail($id);
        $request->session()->flash('success', 'Delete Successful!');
        $user->delete();
        return redirect()->route('admin.users');
    }

    public function deleteChoose(Request $request){
        $items = explode(",",$request->items);
        if(count($items)>0){
            $request->session()->flash('success', 'Delete Successful!');
            User::destroy($items);
        }else{
            $request->session()->flash('error', 'Has error!');
        }
        return redirect()->route('admin.users');
    }

    public function createPermission(Request $request, $permission) {
        return Permission::firstOrCreate(['name' => $permission]);
    }
}