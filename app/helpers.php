<?php 
use App\Models\Media;
use App\Models\Option;
use Illuminate\Support\Str;
include('helpers/mediaCategory.php');
include('helpers/media.php');
include('helpers/post.php');
include('helpers/page.php');
include('helpers/blogCategory.php');
include('helpers/blog.php');
include('helpers/menu.php');
include('helpers/plan.php');
include('helpers/affiliate.php');
include('helpers/faq.php');
include('helpers/field.php');


if (! function_exists('str_limit')) {
	function str_limit($string, $length, $replace){
		return Str::limit($string, $length, $replace);
	}
}

if (! function_exists('get_option')) {
	function get_option($key){
		$option = Option::select('value')->where('key', $key)->first();
		if($option) return $option->value;
			else return NULL;
	}
}

if (! function_exists('format_currency')) {
	function format_currency($number){
		$currency = trim(get_option('currency'));
		if($currency=="vnd" || $currency=="coins")
			return number_format($number,0,".",".").' '.$currency;
		else
			return $currency.number_format($number,0,".",".");
	}
}

if (! function_exists('format_dateCS')) {
	function format_dateCS($date, $full = null){
		if($full!=null) return date_format($date,'Y/m/d H:i:s');
			else return date_format($date,'Y/m/d');
	}
}

if (! function_exists('image')) {
	function image($id, $w, $h, $alt=''){
        $allow = array('gif','png','jpg','jpeg','JPEG','svg','PNG','JPG', 'GIF','SVG');
		$img = Media::find($id);
		if($img && in_array($img->type,$allow))
			$html = ($img->type!="svg") ? '<img src="/image/'.$img->path.'/'.$w.'/'.$h.'" alt="'.$alt.'"/>' : '<img src="'.url('uploads').'/'.$img->path.'"/>';
		else
			$html = '<img src="/image/noImage.jpg/'.$w.'/'.$h.'" alt="'.$alt.'"/>';
		return $html;
	}
}

if (! function_exists('imageAuto')) {
	function imageAuto($id, $alt){
		$image = Media::find($id);
		if(!empty($image))
			$html = '<img src="'.url('uploads').'/'.$image->path.'" alt="'.$alt.'">';
		else
			$html = '<img src="'.url('uploads').'/noImage.jpg" alt="'.$alt.'"/>';
		return $html;
	}
}

if (! function_exists('url_img')) {
	function url_img($id){
		$image = Media::find($id);
		if(!empty($image))
			return url('uploads').'/'.$image->path;
		else
			return url('uploads').'/noImage.jpg"';
		return;
	}
}
if (! function_exists('get_frontUrlImg')) {
	function get_frontUrlImg($id){
		$image = Media::find($id);
		if(!empty($image))
			return url('uploads').'/'.$image->path;
		return;
	}
}

if (! function_exists('generate_transaction_status')) {
	function generate_transaction_status(){
		return array(
			'request' => 'Request',
			'complete' => 'Complete',
		);
	}
}

if (! function_exists('generate_transaction_types')) {
	function generate_transaction_types(){
		return array(
			'withdraw' => 'Withdraw',
        	'send' => 'Recharge to account',
		);
	}
}

if (! function_exists('ordinal_suffix_of')) {
	function ordinal_suffix_of($i) {
	    $j = $i % 10;
	    $k = $i % 100;
	    if ($j == 1 && $k != 11) return $i."<sup>st</sup>";
	    if ($j == 2 && $k != 12) return $i."<sup>nd</sup>";
	    if ($j == 3 && $k != 13) return $i."<sup>rd</sup>";
	    return $i."<sup>th</sup>";
	}
}