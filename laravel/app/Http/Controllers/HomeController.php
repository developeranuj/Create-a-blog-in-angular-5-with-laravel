<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Blogs;
use App\Comment;
class HomeController extends Controller
{

  public function UserLogin(Request $request){
       
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
          $user = Auth::user();
            // Authentication passed...
          return response()->json(['status' => true,'userdata'=>$user], 200);
        } 
        else{
          return response()->json(['status' => false], 200);     
        }
  }
  

  public function PostImageUploads(Request $request){

        $destinationPath = "uploads"; // upload path
        $extension = $request->file('file')->getClientOriginalExtension(); // getting image
        $fileName = rand(11111,99999).'.'.$extension; // renameing image
        $request->file('file')->move($destinationPath, $fileName); // uploading file
        $url =  url('/').'/uploads/'.$fileName;
        return response()->json(['status' => true, 'link' => $url ], 200);

  }   

  public function SavePosts(Request $request){


      $blogs = new BLogs();
      

      if($request->id){
        $updateblog = Blogs::where('id', '=', $request->id);

        $updateblog->update([ 
          'user_id'=> $request->user_id,
          'title'=> $request->post_title,
          'content'=> $request->post_content,
          'featured_image'=> $request->postimage,
          'trash' => 1
         
        ]);
        //$updateblog->save();

         return response()->json(['status'=> true, 'message'=> 'Updated Successfully']); 
      }
      else{
        $blogs->fill([
          'user_id'=> $request->user_id,
          'title'=> $request->post_title,
          'content'=> $request->post_content,
          'featured_image'=> $request->postimage,
          'trash' => 1
        ]);

       $blogs->save();

       return response()->json(['status'=> true, 'postid'=> $blogs->id]);

      }
        
  }

  public function CurruntPosts($id){

    $curruntpost = Blogs::where('id', '=', $id)->first();

    if(!empty($curruntpost)){

       return response()->json(['status' => true, 'postdata' => $curruntpost ], 200);
    }
    else{
      return response()->json(['status' => false ], 200);
    }
  }
  
  public function DeletePost(Request $request){

  $deletepost = Blogs::where('id', '=', $request->id)->delete();

  if($deletepost){

     return response()->json(['status' => true, 'message'=> 'Deleted Successfully']);
  }
  else{
    return response()->json(['status' => false ], 200);
  }
 }



 public function TrashPost(Request $request){

  $trashpost = Blogs::where('id', '=', $request->id)->update(['trash'=>2]);

  if($trashpost){

     return response()->json(['status' => true, 'message'=> 'Trashed Successfully']);
  }
  else{
    return response()->json(['status' => false ], 200);
  }
 }
 
 public function PostRestore(Request $request){

  $restorepost = Blogs::where('id', '=', $request->id)->update(['trash'=>1]);

  if($restorepost){

     return response()->json(['status' => true, 'message'=> 'Trashed Successfully']);
  }
  else{
    return response()->json(['status' => false ], 200);
  }
 }

 public function SinglePost($id){

    $singlepost = Blogs::with('blog_comments', 'blog_user')
                          ->where('id', '=', $id)
                          ->first();
    return response()->json(['status' => true, 'postdata'=>  $singlepost]);                    
 }
 public function InsertComment(Request $request){
/*    $comment = new Comment();

    $comment->fill({
       'blogs_id' => $request->blogs_id,
       'username' => $request->name,
       'comment' => $request->comment
    });
    $comment->save();*/
 }

}

