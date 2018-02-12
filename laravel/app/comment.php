<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
	protected $table = "comments";
       protected $fillable = [
        'post_id', 'comments'
       ];
}
