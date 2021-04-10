<?php
namespace App\Http\Controllers\backends\blog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\BlogCate;
use App\Models\Post;

class BlogCatAdminController extends Controller {
	public function index(Request $request){
		$s = $request->s;
		$status = $request->status;
		$blogCates = BlogCate::query();
        $blogCates = $blogCates->leftJoin('posts','posts.id','=','blog_cats.post_id')
                        ->leftJoin('users','users.id','=','posts.user_id')
                        ->select('blog_cats.id as id','title','slug', 'image_id','slug', 'image_id', 'posts.created_at as created_at','post_id','users.name as author','status')
                        ->where('type','blogCat');
		if($status !="" && $s != ""){
			$blogCates = $blogCates->where('posts.title','like','%'.$s.'%')->where('posts.status',$status);
		}elseif($s != ""){
			$blogCates = $blogCates->where('posts.title','like','%'.$s.'%');
		}elseif($status!=""){
			$blogCates = $blogCates->where('posts.status',$status);
		}
		$blogCates = $blogCates->latest('blog_cats.created_at')->paginate(15);
		return view('backends.blog.list_cat',['blogCates'=>$blogCates,'s'=>$s,'status'=>$status]);
	}

	public function store(){
		return view('backends.blog.create_cat');
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
            return redirect()->route('storeBlogCatAdmin')->withErrors($validator)->withInput();;
		else:
			$object = create_post($request->title, $request->excerpt, $request->thumbnail, $request->metaKey,$request->metaValue,'blogCat', $request->status, Auth::id());
			if($object){
				$blogCat = BlogCate::create([
					'content'=>$request->content,
					'post_id'=>$object->id
				]);
				if($blogCat){
					$request->session()->flash('success', 'create complete!');
				}else{
					delete_post($object->id);
					$request->session()->flash('error', 'create errors!');
				}
				return redirect()->route('storeBlogCatAdmin');
			}else{
				$request->session()->flash('error', 'create errors!');
				return redirect()->route('storeBlogCatAdmin');
			}
		endif;
	}

	public function edit($id){
		$blogCat = BlogCate::findOrFail($id);
		if($blogCat){
			$blogCat = Post::leftJoin('blog_cats','blog_cats.post_id','posts.id')
                ->where('blog_cats.id',$id)
                ->select('posts.id as post_id','blog_cats.id as id','title','slug','content','image_id','meta_key','meta_value','type','status','user_id')
				->first();
			return view('backends.blog.edit_cat',['blogCat'=>$blogCat]);
		}
		return redirect()->route('blogCatAdmin');
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
            return redirect()->route('editBlogCatAdmin',['id'=>$id])->withErrors($validator)->withInput();;
		else:
			$blogCat = BlogCate::findOrFail($id);
			$post = update_post($request->title,null, $request->thumbnail, $request->metaKey, $request->metaValue, $request->status, $blogCat->post_id);
			if($post){
				$request->session()->flash('success', 'update complete!');
				$blogCat = BlogCate::where('id',$id)->update(['content'=>$request->content]);
				return redirect()->route('editBlogCatAdmin',['id'=>$id]);
			}else{
				$request->session()->flash('error', 'update errors!');
				return redirect()->route('editBlogCatAdmin',['id'=>$id]);
			}
		endif;
	}
	//change slug
     public function changeSlug(Request $request,$id){
        $message = 'error';
		if($request->ajax()):
			$blogCat = BlogCate::findOrFail($id);
            $slug = change_slugPost($request->slug, $blogCat->post_id);
            if(strlen($slug)>0) $message = $slug;
        endif;
        return $message;
    }
	public function delete(Request $request,$id) {
		$blogCat = BlogCate::findOrFail($id);
		if(delete_post($blogCat->post_id,Auth::id()))
			$request->session()->flash('success', 'delete complete!');
		else
			$request->session()->flash('error', 'delete error!');
		return redirect()->route('blogCatAdmin');
	}

	public function deleteChoose(Request $request){
		$result = delete_posts($request->items,Auth::id());
		if($result=="complete")
			$request->session()->flash('success', 'delete complete!');
		else
			$request->session()->flash('error', 'delete error!');
		return redirect()->route('blogCatAdmin');
	}
}