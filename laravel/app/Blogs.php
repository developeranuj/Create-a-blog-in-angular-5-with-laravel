<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blogs extends Model
{
   
	  protected $fillable =['user_id','title','content','featured_image','trash']; 
      protected $table = "blogs";

   public function blog_comments(){
       return $this->hasMany('App\Comment');
   } 
   public function blog_user(){
       return $this->belongsTo('App\User','user_id', 'id');
   }   

}
 