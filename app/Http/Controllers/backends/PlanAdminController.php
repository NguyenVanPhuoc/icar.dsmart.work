<?php
namespace App\Http\Controllers\backends;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Plan;

class PlanAdminController extends Controller {

    public function index(Request $request){
        $plans = Plan::query();
        $keyword = isset($request->keyword) ? $request->keyword : '';
        if($keyword != '') {
            $post_query = function ($query) use ($keyword) {
                return $query->where('title', 'like', '%'.$keyword.'%');
            };
            $plans = $plans->with(['post'=>$post_query])
                        ->whereHas('post', $post_query);
        }
        $plans = $plans->latest()->paginate(12);
        $data = [
            'plans' => $plans,
            'keyword' => $keyword,
        ];
        return view('backends.plans.list',$data);
    }

    public function create(Request $request){
        return view('backends.plans.create');
    }

    public function store(Request $request){
        $rules = [
            'title'=>'required',
            'content'=>'required',
            'min_deposit'=>'required',
            'daily_profit'=>'required',
            'status'=>'required'
        ];
        $messages = [
            'title.required'=>'Please enter title!',
            'content.required'=>'Please enter content!',
            'min_deposit.required'=>'Please enter Minimum Deposit!',
            'daily_profit.required'=>'Please enter Daily Profit!',
            'status.required'=>'Please choose status!'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('admin.plan_create')->withErrors($validator)->withInput();;
        else:
            $object = create_post($request->title, $request->excerpt, $request->thumbnail, $request->metaKey,$request->metaValue,'plan', $request->status, Auth::id());
            if($object){
                $plan = Plan::create([
                    'content'=>$request->content,
                    'min_deposit'=>$request->min_deposit,
                    'daily_profit'=>$request->daily_profit,
                    'post_id'=>$object->id,
                ]);
                if($plan){
                    $request->session()->flash('success', __('Create complete!'));
                    return redirect()->route('admin.plan_create');
                }else{
                    delete_post($object->id);
                    $request->session()->flash('error', __('Create errors!'));
                    return redirect()->route('admin.plan_create');
                }
            }else{
                $request->session()->flash('error', __('Create errors!'));
                return redirect()->route('admin.plan_create');
            }
        endif;
    }

    public function edit(Request $request, $id){
        // $plan = Plan::findOrFail($id);
        $plan = Plan::query();
        $plan = $plan->leftJoin('posts','posts.id','=','plans.post_id')
                        ->select('plans.id as id','title','slug', 'image_id', 'posts.created_at as created_at','post_id','status')
                        ->where('plans.id',$id)
                        ->where('type','plan')
                        ->first();
        $data = [
            'plan' => $plan,
        ];
        // var_dump($plan);
        return view('backends.plans.edit',$data);
    }

    public function update(Request $request, $id){
        $rules = [
            'title'=>'required',
            'content'=>'required',
            'min_deposit'=>'required',
            'daily_profit'=>'required',
            'status'=>'required'
        ];
        $messages = [
            'title.required'=>__('Please enter title!'),
            'content.required'=>__('Please enter content!'),
            'min_deposit.required'=>__('Please enter Minimum Deposit!'),
            'daily_profit.required'=>__('Please enter Daily Profit!'),
            'status.required'=>__('Please choose status!)')
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('admin.plan_edit',['id'=>$id])->withErrors($validator)->withInput();;
        else:
            $plan = Plan::findOrFail($id);
            $post = update_post($request->title,$request->excerpt, $request->thumbnail, $request->metaKey, $request->metaValue, $request->status, $plan->post_id);
            if($post){
                $plan->content = $request->content;
                $plan->min_deposit = $request->min_deposit;
                $plan->daily_profit = $request->daily_profit;
                $plan->save();
                if($plan->wasChanged()) {
                    $request->session()->flash('success', __('Update complete!'));
                }
                return redirect()->route('admin.plan_edit',['id'=>$id]);
            }else{
                $request->session()->flash('error', __('Update errors!'));
                return redirect()->route('admin.plan_edit',['id'=>$id]);
            }
        endif;
    }

    public function delete(Request $request, $id){
        $plan = Plan::findOrFail($id);
        if(delete_post($plan->post_id,Auth::id()))
            $request->session()->flash('success', __('Delete Successful!'));
        else
            $request->session()->flash('error', __('Delete error!'));
        return redirect()->route('admin.plans');
    }

    public function deleteChoose(Request $request){
        $result = delete_posts($request->items,Auth::id());
        if($result=="complete")
            $request->session()->flash('success', __('Delete Successful!'));
        else
            $request->session()->flash('error',  __('Delete error!'));
        return redirect()->route('admin.plans');
    }

}