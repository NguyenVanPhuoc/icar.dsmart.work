<?php
namespace App\Http\Controllers\backends;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\MenuMetas;
use App\Models\Post;

class MenuAdminController extends Controller
{
	public function index(){
        $menus = Menu::latest()->paginate(15);
		return view('backends.menu.list',['menus'=>$menus]);
	}
	
	public function store(){
        return view('backends.menu.create');
    }	
	public function edit($id){
        $menu = Menu::findOrFail($id);
        if($menu) return view('backends.menu.edit',['menu'=>$menu]);
        else return route()->redirect('menuAdmin');
	}
	
	public function create(Request $request){
        $user = Auth::User();
        $message = "error";
        $menu = new Menu;
        $menu->title = $request->title;         
        if($menu->save()):
            $metas = json_decode($request->metas);
            foreach ($metas as $item):
                $type = explode("#", $item->type);
                $menu_meta = new MenuMetas;                
                $menu_meta->title_custom = $item->title;
                $menu_meta->position = $item->position;
                $menu_meta->menu_id = $menu->id;
                $menu_meta->user_id = $user->id;
                $menu_meta->parent = 0;
                if($type[1]!="link"){
                    $post = get_post($item->value);
                    $menu_meta->type = $post->type;
                    $menu_meta->post_id = $post->id;
                    $menu_meta->title_default = $post->title;
                }else{
                    $menu_meta->type = "link";
                    $menu_meta->title_default = $item->title_value;
                }
                if($item->target==true){
                    $menu_meta->target = "_blank";
                }
                $menu_meta->save();
            endforeach;
            $message = "success";                   
        endif;
        return $message;
    }
    public function update(Request $request, $id){
		$user = Auth::User();
		$message = "error";
    	$menu = Menu::find($id);
        $menu->title = $request->title;
        if($menu->save()):
            $meta = json_decode($request->meta);
            $old_metas = json_decode($request->old_metas);
            $new_metas = json_decode($request->new_metas);
        	$del_items = json_decode($request->delItems);
            //delete recores
            if(count($del_items)>0){
                MenuMetas::destroy($del_items);
            }
            //update recores
            if(count($old_metas)>0){
                foreach ($old_metas as $item):
                    $type = explode("#", $item->type);
                    $menu_meta = MenuMetas::find($item->meta_id);
                    $menu_meta->title_custom = $item->title;
                    $menu_meta->position = $item->position;
                    // $menu_meta->parent = 0;
                    if($type[1]!="link"){
                        $post = get_post($item->value);
                        $menu_meta->type = $post->type;
                        $menu_meta->post_id = $post->id;
                        $menu_meta->title_default = $post->title;
                    }else{
                        $menu_meta->type = "link";
                        $menu_meta->title_default = $item->title_value;
                    }
                    if($item->target==true){
                        $menu_meta->target = "_blank";
                    }
                    $menu_meta->save();
                endforeach;                
            }
            //new recores
    		if(count($new_metas)>0){
                foreach ($new_metas as $item):
                    $type = explode("#", $item->type);
                    $menu_meta = new MenuMetas;
                	$menu_meta->title_custom = $item->title;
                    $menu_meta->position = $item->position;
                    $menu_meta->menu_id = $id;
                    $menu_meta->user_id = $user->id;
                    $menu_meta->parent = 0;
                    if($type[1]!="link"){
                        $post = get_post($item->value);
                        $menu_meta->type = $post->type;
                        $menu_meta->post_id = $post->id;
                        $menu_meta->title_default = $post->title;
                    }else{
                        $menu_meta->type = "link";
                        $menu_meta->title_default = $item->title_value;
                    }
                    if($item->target==true){
                        $menu_meta->target = "_blank";
                    }
                    $menu_meta->save();
        		endforeach;                
            }            
    		$message = "success";                	
        endif;
		return $message;
	}
	//search
	public function searchMenuAjax(Request $request){
        $type = explode("#",$request->type); //var_dump($type[1]);
        $object = Post::where('type',$type[1])->where('status','public')->latest('created_at')->where('title','like', '%'.$request->title.'%')->get();
        $html = '';
        if($object){
            foreach($object as $item):
                $html .= '<a href="#'.$item->slug.'" data-value="'.$item->id.'">'.$item->title.'</a>';
            endforeach;
        }
        return $html;
	}

    public function delete(Request $request, $id){
        $menu = Menu::find($id);
        if($menu){
            $menu->delete();
            $request->session()->flash('success', 'delete complete!');
        }else{
            $request->session()->flash('error', 'delete error!');
        }
		return redirect()->route('menuAdmin');
    }

    /**
     * sub menu
     */
    public function storeSubMenu($id){
        $menu = MenuMetas::find($id);
        return view('backend.menu.sub_menu',['menu'=>$menu]);
    }    
    public function createSubMenu(Request $request, $id){
        $user = Auth::User();
        $message = "error";
        if($request->ajax()):
            $menu = MenuMetas::find($id);
            $menu->title = $request->title;
            $menu->slug = $request->slug;
            if($menu->save()):
                $old_metas = json_decode($request->old_metas);
                $new_metas = json_decode($request->new_metas);
                $del_items = json_decode($request->delItems);

                //change parent value
                if(count($del_items)>0){
                    MenuMetas::destroy($del_items);
                }
                //update recores
                if(count($old_metas)>0){
                    foreach ($old_metas as $item):
                        $type = explode("#", $item->type);
                        $menu_meta = MenuMetas::find($item->meta_id);
                        if($item->title != ""){
                            $menu_meta->title = $item->title;
                            $menu_meta->slug = $item->title;
                        }
                        else{
                            $menu_meta->title = "DSmart";
                            $menu_meta->slug = "dsmart";
                        }
                        if($item->target!="")
                            $menu_meta->target = $item->target;
                        else
                            $menu_meta->target = "_self";
                        $menu_meta->title_value = $item->title_value;
                        $menu_meta->value = $item->value;
                        $menu_meta->type = $type[1];
                        $menu_meta->position = $item->position;
                        $menu_meta->user_id = $menu->user_id;
                        $menu_meta->save();
                    endforeach;                
                }
                if(count($new_metas)>0){
                    foreach ($new_metas as $item):
                        $menu_meta = new MenuMetas;
                        $type = explode("#", $item->type);
                        if($item->title != ""){
                            $menu_meta->title = $item->title;
                            $menu_meta->slug = $item->title;
                        }
                        else{
                            $menu_meta->title = "DSmart";
                            $menu_meta->slug = "dsmart";
                        }
                        if($item->target!="")
                            $menu_meta->target = $item->target;
                        else
                            $menu_meta->target = "_self";
                        $menu_meta->title_value = $item->title;
                        $menu_meta->value = $item->value;
                        $menu_meta->type = $type[1];
                        $menu_meta->parent = $id;
                        $menu_meta->position = $item->position;
                        $menu_meta->menu_id = $menu->menu_id;
                        $menu_meta->user_id = $menu->user_id;
                        $menu_meta->save();
                    endforeach;                
                }  
            endif;
        endif;
        return $message;
    }
}