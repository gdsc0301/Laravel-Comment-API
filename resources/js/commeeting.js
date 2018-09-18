//ComMeeting API v1.2
//Author: Guilherme dos Santos Carvalho
//Target: BetLabs

//Request the comments in JSON format.


function GetComments(){
  $.ajax({
    method: 'get',
    url: '/comments',
    data: {
      //Laravel CSRF token for authorization.
      _token: '{!! csrf_token() !!}',
    },
    success:function(obj){
      return obj;
    },
    error:function(err){
      return err;
    }
  });
}

//Send the text via AJAX to create a new Comment.
function SendComment(comment_text){
  //Array with the comment text;
  var objectComment = {
    commentText: comment_text
  };

  $.ajax({
    //Laravel CSRF token for authorization.
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method:'post',
    url: '/comments/add',
    data: objectComment,
    dataType: 'json',
    success:function(obj){
      //Returns the sent comment.
      //Or false in case of non authorization.
      location.reload();
      return obj;
    },
    error:function(err){
      return err;
    }
  });
}

//Send the text via AJAX via 'put' data, and the 'id' through the url.
function UpdateComment(commentID, comment_text){
  var updateData = {text: comment_text};

    $.ajax({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      },
      method: 'put',
      url: '/comment/id='+commentID,
      data: updateData,
      success:function(obj){
        location.reload();
        return obj;
      },
      error:function(err){
        return err;
      }
    });
}

//Send the id through 'post' data, for being deleted.
function DeleteComment(commentID){
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    method: 'post',
    url: '/comment/delete',
    data: {comment_id:commentID},
    success:function(obj){
      location.reload();
      return obj;
    },
    error:function(err){
      return err;
    }
  });
}


//
//
//PERSONAL PAGE EVENTS
$('#post-submit').click(function(){
    var text = $('#post-textarea').val();
    SendComment(text);
    $('#post-textarea').val('');
});

$('input.comment-update').click(function(){
  var id = $(this).parent().attr('id');
  var text = $(this).prev().val();

  $(this).parent().toggleClass('hidden');
  UpdateComment(id, text);
});

$('.edit.button').click(function(){
  var id = $(this).attr('id');
  $('#'+id+'.comment-update').toggleClass('hidden');
});

$('.delete.button').click(function(){
  var id = $(this).attr('id');
  DeleteComment(id);
});
