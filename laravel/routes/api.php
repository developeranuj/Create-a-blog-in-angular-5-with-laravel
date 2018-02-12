<?php

use Illuminate\Http\Request;
use App\Blogs;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/userlogin', 'HomeController@UserLogin' );

Route::get('/fetchblogs', function(Request $request){
   $blogs = Blogs::orderBy('id', 'desc')->get();
     return response()->json(['status'=>true, 'postdata'=> $blogs]);
});

Route::post('/imageuploadpage','HomeController@PostImageUploads');

// Insert Posts 

Route::post('/saveposts','HomeController@SavePosts');

// Currunt Posts 

Route::get('/curruntpost/{id}','HomeController@CurruntPosts');

// Delete Post 

Route::post('/deletepost','HomeController@DeletePost');

// Delete Post 

Route::post('/trashpost','HomeController@TrashPost');

// Restore Post 

Route::post('/restorepost','HomeController@PostRestore');

// Single Post 

Route::get('/singlepost/{id}','HomeController@SinglePost');

// Single Post 

Route::post('/insertcomment','HomeController@InsertComment');