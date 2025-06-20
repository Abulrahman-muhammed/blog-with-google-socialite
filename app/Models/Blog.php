<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'description',
        'image',
        'user_id',
        'category_id',
    ];

    protected function category(){
        return $this->belongsTo(Category::class);
    }
    protected function user(){
        return $this->belongsTo(User::class);
    }
    protected function comments(){
        return $this->hasMany(comment::class);
    }
}
