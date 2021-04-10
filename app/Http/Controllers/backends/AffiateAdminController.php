<?php
namespace App\Http\Controllers\backends;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Affiate;

class AffiateAdminController extends Controller {
    public function index(Request $request){
		$s = $request->s;
		$status = $request->status;
		$affiates = Affiate::query();
        $affiates = $affiates->leftJoin('posts','posts.id','=','affiates.post_id')
                        ->leftJoin('users','users.id','=','posts.user_id')
						->select('affiates.id as id','title','slug', 'image_id', 'posts.created_at as created_at','post_id','users.name as author','status')
						->where('type','affiate');
		if($status !="" && $s != ""){
			$affiates = $affiates->where('posts.title','like','%'.$s.'%')->where('posts.status',$status);
		}elseif($s != ""){
			$affiates = $affiates->where('posts.title','like','%'.$s.'%');
		}elseif($status!=""){
			$affiates = $affiates->where('posts.status',$status);
		}
		$affiates = $affiates->latest('affiates.created_at')->paginate(15);
		return view('backends.affiates.list',['affiates'=>$affiates,'s'=>$s,'status'=>$status]);
	}

	public function store(){
		return view('backends.affiates.create');
	}

	public function create(Request $request){
		$rules = [
			'title'=>'required',
			'turnover'=>'required',
			'rewards'=>'required',
			'status'=>'required'
        ];
        $messages = [
			'title.required'=>'Please enter title',
			'content.turnover'=>'Please enter turnover',
			'content.rewards'=>'Please enter rewards',
			'status.required'=>'Please choose status'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('storeAffiateAdmin')->withErrors($validator)->withInput();;
		else:
			$object = create_post($request->title, null, $request->thumbnail,null,null,'affiate', $request->status, Auth::id());
			if($object){
				$affiate = Affiate::create([
					'turnover'=>$request->turnover,
					'rewards'=>$request->rewards,
					'post_id'=>$object->id
				]);
				if($affiate){
					$request->session()->flash('success', 'create complete!');
				}else{
					delete_post($object->id);
					$request->session()->flash('error', 'create errors!');
				}
				return redirect()->route('storeAffiateAdmin');
			}else{
				$request->session()->flash('error', 'create errors!');
				return redirect()->route('storeAffiateAdmin');
			}
		endif;
	}

	public function edit($id){
		$affiate = Affiate::findOrFail($id);
		if($affiate){
			$affiate = Post::leftJoin('affiates','affiates.post_id','posts.id')
                ->where('affiates.id',$id)
                ->select('posts.id as post_id','affiates.id as id','title','turnover','rewards','image_id','status')
				->first();
			return view('backends.affiates.edit',['affiate'=>$affiate]);
		}
		return redirect()->route('affiateAdmin');
	}

	public function update(Request $request, $id){
		$rules = [
			'title'=>'required',
			'turnover'=>'required',
			'rewards'=>'required',
			'status'=>'required'
        ];
        $messages = [
			'title.required'=>'Please enter title',
			'content.turnover'=>'Please enter turnover',
			'content.rewards'=>'Please enter rewards',
			'status.required'=>'Please choose status'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('editAffiateAdmin',['id'=>$id])->withErrors($validator)->withInput();;
		else:
			$affiate = Affiate::findOrFail($id);
			$post = update_post($request->title,null, $request->thumbnail, null, null, $request->status, $affiate->post_id);
			if($post){
				$request->session()->flash('success', 'update complete!');
				$affiate = Affiate::where('id',$id)->update([
					'turnover'=>$request->turnover,
					'rewards'=>$request->rewards,
					]);
				return redirect()->route('editAffiateAdmin',['id'=>$id]);
			}else{
				$request->session()->flash('error', 'update errors!');
				return redirect()->route('editAffiateAdmin',['id'=>$id]);
			}
		endif;
	}
	public function delete(Request $request,$id) {
		$affiate = Affiate::findOrFail($id);
		if(delete_post($affiate->post_id,Auth::id()))
			$request->session()->flash('success', 'delete complete!');
		else
			$request->session()->flash('error', 'delete error!');
		return redirect()->route('affiateAdmin');
	}

	public function deleteChoose(Request $request){
		$result = delete_posts($request->items,Auth::id());
		if($result=="complete")
			$request->session()->flash('success', 'delete complete!');
		else
			$request->session()->flash('error', 'delete error!');
		return redirect()->route('affiateAdmin');
	}
}