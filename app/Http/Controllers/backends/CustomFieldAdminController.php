<?php
namespace App\Http\Controllers\backends;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\CustomField;
use App\Models\CustomFieldGroup;

class CustomFieldAdminController extends Controller {
    public function index(Request $request){
		$s = $request->s;
		$fields = CustomFieldGroup::query();
        $fields = $fields->select('id','title','post_id','created_at');
		if($s != ""){
			$fields = $fields->where('title','like','%'.$s.'%');
		}
		$fields = $fields->latest()->paginate(15);
		return view('backends.fields.list',['fields'=>$fields,'s'=>$s]);
	}

	public function store(){
		return view('backends.fields.create');
	}

	public function create(Request $request){
		$msg = "error";
		if($request->ajax()):
			$check = CustomFieldGroup::where('post_id',$request->post_id)->first();
			if(!$check):
				$group = CustomFieldGroup::create([
					'title'=>$request->title,
					'post_id'=>$request->post_id
				]);
				if($group){
					$metas = json_decode($request->metas);
					foreach ($metas as $item) {
						$field = new CustomField;
						$field->title = $item->title;
						$field->value = $item->value; 
						$field->type = $item->type;
						$field->width = (int)$item->width;
						$field->position = $item->position;
						$field->group_id = $group->id;
						$field->save();
					}
					$request->session()->flash('success', 'create complete!');
				}else{
					$request->session()->flash('error', 'create errors!');
				}
				$msg = 'success';
			else:
				$request->session()->flash('error', 'Item is exist, check again please.');
			endif;
		endif;
	}

	public function edit($id){
		$group = CustomFieldGroup::findOrFail($id);
		if($group){
			$fields = CustomField::select('id','title','value', 'type', 'width', 'group_id','position')
				->where('group_id',$id)
				->orderBy('position','asc')
				->get();
			return view('backends.fields.edit',['fields'=>$fields,'group'=>$group]);
		}
		return redirect()->route('customFieldAdmin');
	}

	public function update(Request $request, $id){
		$msg = "error";
		if($request->ajax()):
			$group = CustomFieldGroup::findOrFail($id);
			if($group):
				$group = CustomFieldGroup::where('id',$group->id)->update([
					'title'=>$request->title,
					'post_id'=>$request->post_id
				]);
				$del_items = json_decode($request->del_items);
				$metas = json_decode($request->metas);
				$metas_old = json_decode($request->metas_old);
				if(count($del_items)>0){
					CustomField::destroy($del_items);
				}
				if(count($metas_old)>0){
					foreach ($metas_old as $item) {
						$field = CustomField::findOrFail($item->id);
						if($field):
							$field->title = $item->title;
							$field->value = $item->value; 
							$field->type = $item->type;
							$field->width = (int)$item->width;
							$field->position = $item->position;
							$field->save();
						endif;
					}
				}
				if(count($metas)>0){
					foreach ($metas as $item) {
						$field = new CustomField;
						$field->title = $item->title;
						$field->value = $item->value; 
						$field->type = $item->type;
						$field->width = (int)$item->width;
						$field->position = $item->position;
						$field->group_id = $id;
						$field->save();
					}
				}
				$request->session()->flash('success', 'edit complete!');
				$msg = 'success';
			else:
				$request->session()->flash('error', 'edit errors!');
			endif;
			return $msg;
		endif;
	}
	public function delete(Request $request,$id) {
		$group = CustomFieldGroup::findOrFail($id);
		if($group):
			$group->delete($id);
			$request->session()->flash('success', 'delete complete!');
		else:
			$request->session()->flash('error', 'delete error!');
		endif;
		return redirect()->route('customFieldAdmin');
	}

	public function deleteChoose(Request $request){
		$items = explode(",",$request->items);
		if(count($items)>0){
			CustomFieldGroup::destroy($items);
			$request->session()->flash('success', 'delete complete!');
		}else{
			$request->session()->flash('error', 'delete error!');
		}
		return redirect()->route('customFieldAdmin');
	}
}