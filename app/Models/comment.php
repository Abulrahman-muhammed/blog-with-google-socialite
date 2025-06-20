<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    use HasFactory;
        protected $fillable=[
        'name',
        'email',
        'subject',
        'message',
        'blog_id',
    ];
    protected function blog(){
        return $this->belongsTo(Blog::class);
    }
}
