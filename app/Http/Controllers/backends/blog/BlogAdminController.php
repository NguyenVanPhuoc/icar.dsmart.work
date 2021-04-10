<?php
namespace App\Http\Controllers\backends\blog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Post;

class BlogAdminController extends Controller {
	public function index(Request $request){
		$s = $request->s;
		$status = $request->status;
		$blogs = Blog::query();
        $blogs = $blogs->leftJoin('posts','posts.id','=','blogs.post_id')
                        ->leftJoin('users','users.id','=','posts.user_id')
                        ->select('blogs.id as id','title','slug', 'image_id','slug', 'image_id', 'posts.created_at as created_at','post_id','users.name as author','status')
                        ->where('type','blog');
		if($status !="" && $s != ""){
			$blogs = $blogs->where('posts.title','like','%'.$s.'%')->where('posts.status',$status);
		}elseif($s != ""){
			$blogs = $blogs->where('posts.title','like','%'.$s.'%');
		}elseif($status!=""){
			$blogs = $blogs->where('posts.status',$status);
		}
		$blogs = $blogs->latest('blogs.created_at')->paginate(15);
		return view('backends.blog.list',['blogs'=>$blogs,'s'=>$s,'status'=>$status]);
	}

	public function store(){
		return view('backends.blog.create');
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
            return redirect()->route('storeBlogAdmin')->withErrors($validator)->withInput();;
		else:
			$object = create_post($request->title, $request->excerpt, $request->thumbnail, $request->metaKey,$request->metaValue,'blog', $request->status, Auth::id());
			if($object){
				$blog = Blog::create([
                    'content'=>$request->content,
                    'cat_ids'=>$request->blogCats,
					'post_id'=>$object->id
				]);
				if($blog){
					$request->session()->flash('success', 'create complete!');
				}else{
					delete_post($object->id);
					$request->session()->flash('error', 'create errors!');
				}
				return redirect()->route('storeBlogAdmin');
			}else{
				$request->session()->flash('error', 'create errors!');
				return redirect()->route('storeBlogAdmin');
			}
		endif;
	}

	public function edit($id){
		$blog = Blog::findOrFail($id);
		if($blog){
			$blog = Post::leftJoin('blogs','blogs.post_id','posts.id')
                ->where('blogs.id',$id)
                ->select('posts.id as post_id','blogs.id as id','title','slug','content','image_id','meta_key','meta_value','type','status','user_id')
				->first();
			return view('backends.blog.edit',['blog'=>$blog]);
		}
		return redirect()->route('blogAdmin');
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
            return redirect()->route('editBlogAdmin',['id'=>$id])->withErrors($validator)->withInput();;
		else:
			$blogCat = Blog::findOrFail($id);
			$post = update_post($request->title,null, $request->thumbnail, $request->metaKey, $request->metaValue, $request->status, $blogCat->post_id);
			if($post){
				$request->session()->flash('success', 'update complete!');
				$blogCat = Blog::where('id',$id)->update(['content'=>$request->content]);
				return redirect()->route('editBlogAdmin',['id'=>$id]);
			}else{
				$request->session()->flash('error', 'update errors!');
				return redirect()->route('editBlogAdmin',['id'=>$id]);
			}
		endif;
	}
	//change slug
     public function changeSlug(Request $request,$id){
        $message = 'error';
		if($request->ajax()):
			$blogCat = Blog::findOrFail($id);
            $slug = change_slugPost($request->slug, $blogCat->post_id);
            if(strlen($slug)>0) $message = $slug;
        endif;
        return $message;
    }
	public function delete(Request $request,$id) {
		$blogCat = Blog::findOrFail($id);
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