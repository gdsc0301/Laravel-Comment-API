@extends('layouts.app')

@section('content')
<link href="{{ asset('css/commeeting.css') }}" rel="stylesheet">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="textarea-container">
                <label style="color: black">Your comment!</label>
                <textarea class="post" maxlength="15000" id="post-textarea"></textarea>
                <input class="post" id='post-submit' type="submit" onclick="">
            </div>
            <div class="card">
                <div class="card-header">Dashboard</div>
                @if(count($comments) > 0)
                    @foreach($comments as $comment)
                      <div class='comment-container'>
                          <div class='comment-content'>
                              <div class='user-image'>
                                <img src='{{asset("avatar/".$comment->author->id.".png")}}'>
                              </div>
                              <div class='comment' id='{{$comment->id}}'>
                                <div class='comment name'><a href='{{url("/profile/id=".$comment->author->id)}}'>{{$comment->author->name}}</a></div>
                                {{$comment->current_text}}
                              </div>
                              <div class="comment-update hidden" id="{{$comment->id}}">
                                  <label>Update your comment</label>
                                  <textarea class="comment-textarea"></textarea>
                                  <input class="comment-update" type="submit">
                              </div>
                              <div class="comment status">
                                <div class="status creation-date">{{$comment->created_at}}</div>
                                @if($comment->edited == 'yes')
                                <div class="status edited">edited</div>
                                <div class="status update-date">{{$comment->updated_at}}</div>
                                @endif
                              </div>
                          </div>

                          <div class="comment-modify">
                            @if(Gate::allows('comment.update', $comment))
                            <div class="button edit" id="{{$comment->id}}">edit</div>
                            @endif
                            @if(Gate::allows('comment.delete', $comment))
                            <div class="button delete" id="{{$comment->id}}">drop</div>
                            @endif
                          </div>
                      </div>
                    @endforeach
                @else
                  No comments
                @endif

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
