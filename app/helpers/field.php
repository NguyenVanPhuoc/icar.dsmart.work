<?php
use Illuminate\Support\Facades\Auth;
use App\Models\CustomField;
use App\Models\CustomFieldGroup;

/**
* get field type
* @return array
*/
if(! function_exists('get_fieldType')) {
    function get_fieldType() {
        return array(
            'text'=>'Text',
            'textarea'=>'Textarea',
            'editor'=>'Editor',
            'image'=>'Image'
        );
    }
}
/**
* get field type
* @return array
*/
if(! function_exists('get_fieldColumn')) {
    function get_fieldColumn() {
        return array(
            '2'=>'2 column',
            '3'=>'3 column',
            '4'=>'4 column',
            '5'=>'5 column',
            '6'=>'6 column',
            '7'=>'7 column',
            '8'=>'8 column',
            '9'=>'9 column',
            '10'=>'10 column',
            '12'=>'12 column'
        );
    }
}
/**
* get fields by post_id
* @param $post_id
* @return object
*/
if(! function_exists('get_fieldsByPostId')) {
    function get_fieldsByPostId($post_id) {
        $group = CustomFieldGroup::where('post_id',$post_id)->first();
        if($group):
            return CustomField::select('id','title','value','content','type','width','group_id','position')
            ->where('group_id',$group->id)
            ->orderBy('position','asc')
            ->get();
        endif;
        return;
    }
}
/**
* update meta by id
* @param $id
* @return object
*/
if(! function_exists('update_fieldContent')) {
    function update_fieldContent($id,$content) {
        $field = CustomField::findOrFail($id);
        if($field):
            $field->content = $content;
            $field->save();
        endif;
        return;
    }
}
if(! function_exists('get_fieldContent')) {
    function get_fieldContent($value) {
        $field = CustomField::where('value',$value)->first();
        if($field) return $field->content ;
        return;
    }
}