<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CustomFieldGroup extends Model {
    protected $table = "custom_field_group";
    protected $fillable = [
        'title', 'post_id'
    ];
}