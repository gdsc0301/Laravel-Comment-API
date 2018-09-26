@extends('layouts.app');

@section('content')

<div class="container w-100 bg-dark d-flex flex-column p-3 rounded">
  <div class="d-flex flex-row">
    <img src="{{asset('avatar/'.$user->id.'.png')}}" class="img-thubnail rounded mr-3" style="width: 128px;height: 128px">
    <h2 class="title text-white">
      {{$user->name}}
    <small class="text-muted">{{$user->email}}</small></h2>
  </div>
  <div class="d-flex w-100 flex-column justify-content-start flex-wrap">
    @if(Gate::allows('user.update', $user))
    <div class="container-fluid bg-light d-flex flex-column rounded mt-3 p-3">
      <h5> Update your profile</h5>
      <form class="input-group mb-3" novalidate>
        <div class="custom-file">
          <input disabled type="file" class="custom-file-input" name='image' accept=".png" id="image-input" aria-describedby="image-input-label">
          <label class="custom-file-label" for="image-input">Avatar update under maintenance...</label>
        </div>
        <div class="input-group-append">
          <button class="btn btn-primary" type="button" id="image-submit">Upload</button>
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
      </form>

      <!-- EMAIL -->
      <form class="email-form">
        <div class="input-group">
          <input type="email" id="email-update" class="form-control" placeholder="Your new email" required>
          <div class="input-group-append">
            <button type="button" id="email-submit" class="btn btn-primary">Update Email</button>
          </div>
        </div>
        <small class="email exists text-danger d-none">
          This email is already registered. Try other!
        </small>
      </form>

      <!-- PASSWORD -->
      <form>
        <div class="input-group" >
          <input type="password" id="password-update" class="form-control" placeholder="Your new Password" required>
          <input type="password" id="password-confirm" class="form-control" placeholder="Password confirm" required>
          <div class="input-group-append">
            <button type="button" id="password-submit" class="btn btn-primary btn-block">Update Password</button>
          </div>
        </div>
        <small class="password no-confirmated d-none">

        </small>
      </form>
    </div>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){

        $('#name-submit').click(function(event){
          console.log(event);
          var newName = $('#name-update').val();
          var update = {
            id : {{$user->id}},
            name: newName
          };
          console.log(update);
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            url: '/laravel/public/profile/name-update',
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

        $('#email-submit').click(function(event){

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
            url: '/laravel/public/profile/email-update',
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


        $('#password-submit').click(function(){
          var newPassword = $('#password-update').val();
          var passConfirm = $('#password-confirm').val();

          if(newPassword != passConfirm){
            $(event.target).addClass('is-invalid');
            return false;
          }

          var update = {
            id : {{$user->id}},
            password: newPassword
          };
          console.log(update);
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            url: '/laravel/public/profile/password-update',
            data: update,
            dataType: 'json',
            success:function(){
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
