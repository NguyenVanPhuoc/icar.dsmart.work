<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class CustomField extends Model {
    protected $table = "custom_fields";
    protected $fillable = [
        'title', 'value', 'content', 'type', 'width', 'group_id', 'position'
    ];
}
