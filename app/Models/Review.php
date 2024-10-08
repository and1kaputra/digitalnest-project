<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    
    protected $guarded = ['id'];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function reviewer(){
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
