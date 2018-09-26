@extends('layouts.app');

@section('content')

<div class="container w-100 bg-dark d-flex flex-column p-3 rounded">
  <div class="d-flex flex-row">
    <img src="{{asset('../storage/app/avatar/'.Auth::user()->avatar)}}" class="img-thubnail rounded mr-3" style="width: 128px;height: 128px">
    <h2 class="title text-white">
      {{$user->name}}
    <small class="text-muted">{{$user->email}}</small></h2>
  </div>
  <div class="d-flex w-100 flex-column justify-content-start flex-wrap">
    @if(Gate::allows('user.update', $user))
    <div class="container-fluid bg-light d-flex flex-column rounded mt-3 p-3">
      <h5> Update your profile</h5>

      <!-- AVATAR -->
      <form enctype="multipart/form-data" action="avatar-update" method="post" class="input-group avatar-form mb-3">
        <div class="custom-file">
          <input type="file" name='avatar' accept=".png, .jpg" id="image-input" required>
          <label class="custom-file-label" for="image-input">Avatar File</label>
        </div>
        <div class="input-group-append">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <button class="btn btn-primary" type="submit" id="image-submit">Upload</button>
        </div>
      </form>

      <!-- NAME -->
      <form>
        <div class="input-group" >
          <input type="text" id="name-update" name="name_update" class="form-control" placeholder="Your new name" required>
          <div class="input-group-append">
            <button type="button" id="name-submit" class="btn btn-primary btn-block">Update Name</button>
          </div>
        </div>
        <small class="empty-name text-danger d-none">
          Your name should have atleast 3 characters.
        </small>
      </form>

      <!-- EMAIL -->
      <form class="email-form">
        <div class="input-group">
          <input type="email" id="email-update" class="form-control" placeholder="Your new email" required>
          <div class="input-group-append">
            <button type="submit" id="email-submit" class="btn btn-primary">Update Email</button>
          </div>
        </div>
        <small class="email exists text-danger d-none">
          This email is already registered. Try other!
        </small>
      </form>

      <!-- PASSWORD -->
      <form>
        <div class="input-group" >
          <input type="password" id="password-update" class="form-control pass" placeholder="Your new Password" required>
          <input type="password" id="password-confirm" class="form-control pass" placeholder="Password confirm" required>
          <div class="input-group-append">
            <button type="button" id="password-submit" class="btn btn-primary btn-block">Update Password</button>
          </div>
        </div>
        <small class="password-unconfirmed text-danger d-none">
          Password confirmation doesn't match.
        </small>
        <small class="password-empty text-danger d-none">
          Fill in both fields. Equals preferably.
        </small>
        <small class="password-small text-danger d-none">
          Password must have atleast 6 chatacters.
        </small>
      </form>
    </div>

    <script type="text/javascript">
      $(document).ready(function(){

        //NAME
        $('#name-submit').click(function(event){
          if($('#name-update').val().length < 3){
            console.log($('#name-update').val().length);
            $('.empty-name').removeClass('d-none');
            return false;
          }
          var newName = $('#name-update').val();
          var update = {
            id : {{$user->id}},
            name: newName
          };
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            url: 'name-update',
            data: update,
            dataType: 'json',
            success:function(obj){
              if(obj == 401){
                $("#name-update").addClass('is-invalid');
              }else{
                location.reload();
              }
            }
          });
        });

        $('.email-form').on('submit', function(e){
          e.preventDefault();
          var newEmail = $('#email-update').val();
          var update = {
            id : {{$user->id}},
            email: newEmail
          };
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            url: 'email-update',
            data: update,
            dataType: 'json',
            success:function(obj){
              if(obj == 403){
                $('#email-update').addClass("is-invalid");
                $('.email.exists').removeClass('d-none');
              }else{
                location.reload();
              }
            }
          });
        });

        //PASSWORD
        $('#password-submit').click(function(event){
          var newPassword = $('#password-update').val();
          var passConfirm = $('#password-confirm').val();

          if(newPassword != passConfirm){
            $(".password-unconfirmed").removeClass('d-none');
            $("input.pass").addClass("is-invalid");
            return false;
          }else if(newPassword == '' || passConfirm == ''){
            $(".password-empty").removeClass('d-none');
            $("input.pass").addClass("is-invalid");
            return false;
          }else if(newPassword.length < 6 || passConfirm.length < 6){
            $(".password-small").removeClass('d-none');
            $("input.pass").addClass("is-invalid");
            return false;
          }

          var update = {
            id : {{$user->id}},
            password: newPassword
          };

          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            url: 'password-update',
            data: update,
            dataType: 'json',
            success:function(obj){
              if(obj == 401){
                $(event.target).addClass('is-invalid');
              }else{
                location.reload();
              }
            }
          });
        });
      });
    </script>
    @endif
  </div>
</div>
@endsection
