<?php
namespace App\Http\Controllers\backends;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Actions\Transaction\CreateNewTransaction;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\User;
use App\Events\UpdateUserAmount;

class TransactionAdminController extends Controller {
    
    public function index(Request $request){
        $list = Transaction::query();
        $keyword = isset($request->keyword) ? $request->keyword : '';
        if($keyword != '') {
            $user_query = function ($query) use ($keyword) {
                return $query->select('id', 'name', 'displayname')->where('name', 'like', '%'.$keyword.'%')->orWhere('displayname', 'like', '%'.$keyword.'%');
            };
            $list = $list->with(['user'=>$user_query])
                        ->whereHas('user', $user_query);
        }else $list = $list->with('user:id,displayname,name');
        $list = $list->with('user:id,displayname')->latest()->paginate(10);
        $data = [
            'list' => $list,
            'keyword' => $keyword,
            'types' => generate_transaction_types(),
            'statuses' => generate_transaction_status(),
        ];
        return view('backends.transactions.list',$data);
    }

    public function create(Request $request){
        $data = [
            'users' => User::select('id', 'displayname')->get(),
            'types' => generate_transaction_types(),
            'statuses' => generate_transaction_status(),
        ];
        return view('backends.transactions.create', $data);
    }

    public function store(Request $request, CreateNewTransaction $creator){
        $transaction = $creator->create($request->all());
        if($transaction) {
            $request->session()->flash('success', __('Create Successful!'));
            if($request->status == 'complete') {
                $diff_amount = $request->type == 'withdraw' ? - floatval($request->amount) : floatval($request->amount);
                if(isset($transaction->user) && (floatval($transaction->user->amount) + $diff_amount >= 0)) {
                    event(new UpdateUserAmount($transaction->user, $diff_amount));
                    $request->session()->flash('success', __('Create Successful!'));
                }else{
                    Transaction::where('id', $transaction->id)->update(['status'=>'request']);
                    $request->session()->flash('success', __('User\'s amount not enough - Status has changed to Request!'));
                }
            }
        }else $request->session()->flash('error', 'Has error!');
        return redirect()->route('admin.transaction_create');
    }

    public function edit(Request $request, $id){
        $transaction = Transaction::findOrFail($id);
        $data = [
            'users' => User::select('id', 'displayname')->get(),
            'types' => generate_transaction_types(),
            'statuses' => generate_transaction_status(),
            'transaction' => $transaction,
        ];
        return view('backends.transactions.edit', $data);
    }

    public function update(Request $request, $id){
        $rules = [
            'amount'=>'required',
            'status'=>'required'
        ];
        $messages = [
            'amount.required' => __('Please enter Amount of Transaction!'),
            'status.required' => __('Please choose status!')
        ];
        if($request->status == 'complete') {
            $rules['image'] = 'required';
            $messages['image.required'] = __('Please choose Payment Receipt\'s image!');
        }
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('admin.transaction_edit',['id'=>$id])->withErrors($validator)->withInput();
        else:
            $res = Transaction::findOrFail($id);

            $user = User::find($res->user_id);
            if($res->checkActionToUser()) { # had send/subtract coins to/from user amount
                if($request->status == 'complete') { # status complete and had send/subtract coins to/from user amount -> change amount
                    $diff_amount = $res->type == 'withdraw' ? floatval($res->amount) - floatval($request->amount) : floatval($request->amount) - floatval($res->amount);
                }else{
                    $diff_amount = $res->type == 'withdraw' ? floatval($res->amount) : - floatval($res->amount);
                    $res->user_action = 'no';
                }
            }else{
                if($request->status == 'complete') { # change action to 'yes' and send/subtract coins to/from user amount
                    $diff_amount = $res->type == 'withdraw' ? - floatval($res->amount) : floatval($res->amount);
                    $res->user_action = 'yes';
                }else $diff_amount = 0;
            }
            if(isset($res->user) && (floatval($res->user->amount) + $diff_amount >= 0)) {
                $res->content = $request->content;
                $res->amount = $request->amount;
                $res->status = $request->status;
                $res->image = $request->image;
                $res->author = Auth::id();
                if($res->save()) {
                    event(new UpdateUserAmount($user, $diff_amount));
                    if($res->wasChanged()) {
                        $request->session()->flash('success', __('Update complete!'));
                    }
                }
            }else $request->session()->flash('error', __('User not exist or user\'s amount not enough!'));
            return redirect()->route('admin.transaction_edit',['id'=>$id]);
        endif;
    }

    public function delete(Request $request, $id){
        $transaction = Transaction::findOrFail($id);
        // if($transaction->status == 'complete') {
        //     $diff_amount = $transaction->type == 'withdraw' ? floatval($transaction->amount) : - floatval($transaction->amount);
        //     if(isset($transaction->user)) {
        //         if(floatval($transaction->user->amount) + $diff_amount >= 0) {
        //             event(new UpdateUserAmount($transaction->user, $diff_amount));
        //         }else{
        //             $request->session()->flash('error', __('User\'s amount not enough! Can not delete!'));
        //             return redirect()->route('admin.transactions');
        //         }
        //     }
        // }else{
        //     $transaction->checkActionToUser()
        // }
        if($transaction->checkActionToUser()) {
            $diff_amount = $transaction->type == 'withdraw' ? floatval($transaction->amount) : - floatval($transaction->amount);
            if(isset($transaction->user)) {
                if(floatval($transaction->user->amount) + $diff_amount >= 0) {
                    event(new UpdateUserAmount($transaction->user, $diff_amount));
                }else{
                    $request->session()->flash('error', __('User\'s amount not enough! Can not delete!'));
                    return redirect()->route('admin.transactions');
                }
            }
        }
        
        $request->session()->flash('success', 'Delete Successful!');
        $transaction->delete();
        return redirect()->route('admin.transactions');
    }

    public function deleteChoose(Request $request){
        $items = explode(",",$request->items);
        if(count($items)>0){
            $total_delete = 0;
            foreach ($items as $item) {
                $transaction = Transaction::findOrFail($item);
                if($transaction->status == 'complete') {
                    $diff_amount = $transaction->type == 'withdraw' ? floatval($transaction->amount) : - floatval($transaction->amount);
                    if(isset($transaction->user)) {
                        if(floatval($transaction->user->amount) + $diff_amount >= 0) {
                            event(new UpdateUserAmount($transaction->user, $diff_amount));
                            $transaction->delete();
                            $total_delete++;
                        }
                    }else{
                        $transaction->delete();
                        $total_delete++;
                    }
                }
            }
            if ($total_delete > 0) $request->session()->flash('success', __('Delete Successful!'));
                else $request->session()->flash('error', __('No items can be delete!'));
        }else{
            $request->session()->flash('error', __('Has error!'));
        }
        return redirect()->route('admin.transactions');
    }

}