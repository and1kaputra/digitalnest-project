<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public  function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
    
    // public function tool(){
    //     return $this->belongsTo(Tools::class, 'tool_id');
    // }

    public function tools() {
        return $this->belongsToMany(Tools::class, 'product_tools', 'product_id', 'tool_id')
        ->wherePivotNull('deleted_at')
        ->withPivot('id');
    }

    public  function creator(){
        return $this->belongsTo(User::class);
    }
}
