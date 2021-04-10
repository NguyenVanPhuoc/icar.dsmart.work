<?php
namespace App\Http\Controllers\backends;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Actions\Transaction\CreateDeposit;
use App\Events\NewDeposit;
use App\Models\PlanUser; //Deposit
use App\Models\Plan;
use App\Models\User;
use App\Events\UpdateUserAmount;

class DepositAdminController extends Controller {

    public function index(Request $request){
        $list = PlanUser::query();
        $keyword = isset($request->keyword) ? $request->keyword : '';
        if($keyword != '') {
            $user_query = function ($query) use ($keyword) {
                return $query->select('id', 'name', 'displayname')->where('name', 'like', '%'.$keyword.'%')->orWhere('displayname', 'like', '%'.$keyword.'%');
            };
            $list = $list->with(['user'=>$user_query])
                        ->whereHas('user', $user_query);
        }else $list = $list->with('user:id,displayname,name');
        $list = $list->with('plan')->paginate(10);
        $data = [
            'list' => $list,
            'keyword' => $keyword,
        ];
        return view('backends.deposits.list',$data);
    }

    public function create(Request $request){
        $data = [
            'users' => User::select('id', 'displayname')->get(),
            'plans' => Plan::select('id', 'post_id', 'daily_profit')->postPublished()->get(),
        ];
        return view('backends.deposits.create', $data);
    }

    public function store(Request $request, CreateDeposit $creator){
        event(new NewDeposit($deposit = $creator->create($request->all())));
        if($deposit) {
            event(new UpdateUserAmount($deposit->user, - $deposit->amount));
            $request->session()->flash('success', __('Create Successful!'));
        }else{
            return redirect()->route('admin.deposit_create');
        }
        return redirect()->route('admin.deposit_create');
    }

    public function edit(Request $request, $id){
        $res = PlanUser::findOrFail($id);
        $data = [
            'users' => User::select('id', 'displayname')->get(),
            'plans' => Plan::select('id', 'post_id', 'daily_profit')->get(),
            'res' => $res,
        ];
        return view('backends.deposits.edit', $data);
    }

    public function update(Request $request, $id){
        // $rules = [
        //     'amount'=>'required',
        // ];
        // $messages = [
        //     'amount.required' => __('Please enter Amount of Request!'),
        // ];
        // $validator = Validator::make($request->all(), $rules, $messages);
        // if ($validator->fails()):
        //     return redirect()->route('admin.deposit_edit',['id'=>$id])->withErrors($validator)->withInput();
        // else:
            $res = PlanUser::findOrFail($id);
            // $res->user_id = $request->user_id;
            // $res->plan_id = $request->plan_id;
            // $res->amount = $request->amount;
            $res->stop_date = $request->stop_date;
            $res->save();
            if($res->wasChanged()) {
                $request->session()->flash('success', __('Update complete!'));
            }
            return redirect()->route('admin.deposit_edit',['id'=>$id]);
        // endif;
    }

    public function delete(Request $request, $id){
        $deposit = PlanUser::findOrFail($id);
        $request->session()->flash('success', __('Delete Successful!'));
        $deposit->delete();
        return redirect()->route('admin.deposits');
    }

    public function deleteChoose(Request $request){
        $items = explode(",",$request->items);
        if(count($items)>0){
            $request->session()->flash('success', __('Delete Successful!'));
            PlanUser::destroy($items);
        }else{
            $request->session()->flash('error', __('Has error!'));
        }
        return redirect()->route('admin.deposits');
    }
}