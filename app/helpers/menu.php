<?php
use Illuminate\Support\Facades\Auth;
use App\Models\Menu;
use App\Models\MenuMetas;

/**
 * Menu
 */
if (! function_exists('menuType')) {
	function menuType($type=null){
		$types  = get_type();
		$type_txt = ($type!="link" && $type!=null)? $types[$type]:"Link";
		$html ='<div class="dropdown show type col-md-5">';
		$html .= '<a class="dropdown-toggle" href="#" role="button" id="dropdown-type" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.$type_txt.'</a>';            
		$html .= '<div class="dropdown-menu" aria-labelledby="dropdown-type">';
        $html .='<div class="list-item">';
        foreach($types as $key=>$value){
			$active = ($type==$key)?"active":""; 
            $html .= '<a href="#'.$key.'" class="'.$active.'">'.$value.'</a>';
		}
		$active = ($type=="link")?"active":"";
        $html .= '<a href="#link" class="'.$active.'">'.__('link').'</a>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		return $html;
	}
}
//get sub menu
if (! function_exists('getSubMenu')) {
	function getSubMenu($id){
		return MenuMetas::where('parent',0)->where('menu_id',$id)->orderBy('position','asc')->get();
	}
}
if (! function_exists('get_childrenMenu')) {
	function get_childrenMenu($id){
		return MenuMetas::where('parent',$id)->orderBy('position','asc')->get();
	}
}
//get menu
if (! function_exists('get_parentMenu')) {
	function get_parentMenu($id){
		return Menu::find($id);
	}
}
//get submenu by id
if (! function_exists('get_menu')) {
	function get_menu($slug){
		$menu = Menu::where('slug',$slug)->first();
		if($menu){
			$menu = MenuMetas::query();
			return $menu->leftJoin('posts','posts.id','=','menu_metas.post_id')
						->leftJoin('menus','menus.id','=','menu_metas.menu_id')
						->select('title_custom','title_default','menu_metas.type as type', 'target','posts.slug as slug')
						->where('menus.slug',$slug)
						->orderBy('position','asc')
						->get();
		}
		return;
		
	}
}