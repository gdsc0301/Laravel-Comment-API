<?php

namespace App\Http\Controllers;

use App\User;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
  /**
  * By default, all the functions verify the authorization
  * in 'Gate' class. Except the 'GetComments' method.
  * And returns the modificated comments too.
  * As aways, in JSON format.
  */

  //Create a new Comment, using the text sent by 'post'.
  //And insert into the Database.
  public function NewComment(Request $request) {
    if(Gate::allows('comment.create')){
      $cText = $request->commentText;
      $comment = new Comment;
      $comment->author_id = Auth::user()->id;
      $comment->current_text = $cText;
      $comment->save();

      return response()->json($comment);
    }else{
      return false;
    }
  }

  //Search by all the $comments,
  //and get sorted by decrescent creation date.
  public function GetComments(Request $request){
    $comments = Comment::all()->sortByDesc('created_at');

    return response()->json($comments);
  }

  //Get the comment with the 'id' sent by 'put' data.
  //Update the current text.
  //Insert the current text in the 'history' cell.
  //The 'history' is an array, converted to JSON.
  public function UpdateComment(Request $request, $id){
    $comment = Comment::find($id);

    if(Gate::allows('comment.update', $comment)){
      $current_text = $comment->current_text;
      $comment->current_text = $request->text;
      $comment->edited = 'yes';

      $history = $comment->history;
      if($history == null){
        $history = array();
        array_unshift($history, $current_text);
        $comment->history = json_encode($history);
      }else {
        $history = json_decode($history);
        array_unshift($history, $current_text);
        $comment->history = json_encode($history);
      }
      $comment->save();
      return response()->json($comment);
    }else {
      return false;
    }
  }

  //Get the comment, return.
  //And delete from the database
  public function DeleteComment(Request $request){
    $id = $request->comment_id;
    $comment = Comment::find($id);

    if(Gate::allows('comment.delete', $comment)){
      $backup = $comment;
      $comment->delete();

      return response()->json($backup);
    }else{
      return false;
    }
  }
}
