<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory,SoftDeletes;


    protected  $primaryKey = 'id';

    

    protected $dates = ['deleted_at']; 


   
    public function user () {
        return $this->belongsTo(User::class,'user_id','id');
    }


  

    
}
