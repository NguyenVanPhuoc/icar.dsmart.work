<?php
namespace App\Http\Controllers\backends;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Faqs;

class FaqsAdminController extends Controller {
    public function index(Request $request){
		$s = $request->s;
		$status = $request->status;
		$faqs = Faqs::query();
        $faqs = $faqs->leftJoin('posts','posts.id','=','faqs.post_id')
                        ->leftJoin('users','users.id','=','posts.user_id')
						->select('faqs.id as id','title','slug','image_id', 'posts.created_at as created_at','post_id','users.name as author','status')
						->where('type','faqs');
		if($status !="" && $s != ""){
			$faqs = $faqs->where('posts.title','like','%'.$s.'%')->where('posts.status',$status);
		}elseif($s != ""){
			$faqs = $faqs->where('posts.title','like','%'.$s.'%');
		}elseif($status!=""){
			$faqs = $faqs->where('posts.status',$status);
		}
		$faqs = $faqs->latest('faqs.created_at')->paginate(15);
		return view('backends.faqs.list',['faqs'=>$faqs,'s'=>$s,'status'=>$status]);
	}

	public function store(){
		return view('backends.faqs.create');
	}

	public function create(Request $request){
		$rules = [
			'title'=>'required',
			'content'=>'required',
			'status'=>'required'
        ];
        $messages = [
			'title.required'=>'Please enter title',
			'content.required'=>'Please enter content',
			'status.required'=>'Please choose status'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('storeFaqsAdmin')->withErrors($validator)->withInput();;
		else:
			$object = create_post($request->title, $request->excerpt, $request->thumbnail,null,null,'faqs', $request->status, Auth::id());
			if($object){
				$faqs = Faqs::create([
					'content'=>$request->content,
					'post_id'=>$object->id
				]);
				if($faqs){
					$request->session()->flash('success', 'create complete!');
				}else{
					delete_post($object->id);
					$request->session()->flash('error', 'create errors!');
				}
				return redirect()->route('storeFaqsAdmin');
			}else{
				$request->session()->flash('error', 'create errors!');
				return redirect()->route('storeFaqsAdmin');
			}
		endif;
	}

	public function edit($id){
		$faqs = Faqs::findOrFail($id);
		if($faqs){
			$faqs = Post::leftJoin('faqs','faqs.post_id','posts.id')
                ->where('faqs.id',$id)
                ->select('posts.id as post_id','faqs.id as id','title','content','image_id','status')
				->first();
			return view('backends.faqs.edit',['faqs'=>$faqs]);
		}
		return redirect()->route('faqsAdmin');
	}

	public function update(Request $request, $id){
		$rules = [
			'title'=>'required',
			'content'=>'required',
			'status'=>'required'
        ];
        $messages = [
			'title.required'=>'Please enter title',
			'content.required'=>'Please enter description',
			'status.required'=>'Please choose status'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()):
            return redirect()->route('editFaqsAdmin',['id'=>$id])->withErrors($validator)->withInput();;
		else:
			$faqs = Faqs::findOrFail($id);
			$post = update_post($request->title,null, null, null, null, $request->status, $faqs->post_id);
			if($post){
				$request->session()->flash('success', 'update complete!');
				$faqs = Faqs::where('id',$id)->update(['content'=>$request->content]);
				return redirect()->route('editFaqsAdmin',['id'=>$id]);
			}else{
				$request->session()->flash('error', 'update errors!');
				return redirect()->route('editFaqsAdmin',['id'=>$id]);
			}
		endif;
	}
	public function delete(Request $request,$id) {
		$faqs = Faqs::findOrFail($id);
		if(delete_post($faqs->post_id,Auth::id()))
			$request->session()->flash('success', 'delete complete!');
		else
			$request->session()->flash('error', 'delete error!');
		return redirect()->route('faqsAdmin');
	}

	public function deleteChoose(Request $request){
		$result = delete_posts($request->items,Auth::id());
		if($result=="complete")
			$request->session()->flash('success', 'delete complete!');
		else
			$request->session()->flash('error', 'delete error!');
		return redirect()->route('faqsAdmin');
	}
}