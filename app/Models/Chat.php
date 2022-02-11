<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;


    // 
    public function idea()
    {
        return $this->belongsTo(Idea::class,'ideaId');
    }
    public function sender()
    {
        return $this->belongsTo(User::class,'fromUser');
    }
    public function receiver()
    {
        return $this->belongsTo(User::class,'toUser');
    }
}
