@extends('layouts.app');

@section('content')

<div class="container w-auto bg-dark d-flex flex-row p-3 rounded flex-wrap">
  <div>
    <img src="{{asset('avatar/'.$user->id.'.png')}}" class="img-thubnail rounded mr-3" style="width: 128px;height: 128px">
  </div>
  <div class="d-flex flex-row flex-wrap mt-3">
    <h2 class="title text-white">
      {{$user->name}}
    <small class="text-muted">{{$user->email}}</small></h2>
  </div>
  <div class="d-flex flex-column justify-content-start flex-wrap">
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
      <form novalidate>
        <div class="input-group" >
          <input type="text" id="name-update" name="name_update" class="form-control" placeholder="Your new name" required>
          <div class="input-group-append">
            <button type="submit" id="name-submit" class="btn btn-primary btn-block">Update Name</button>
          </div>
        </div>
      </form>
      <form novalidate>
        <div class="input-group">
          <input type="email" id="email-update" class="form-control" placeholder="Your new email">
          <div class="input-group-append">
            <button type="submit" id="email-submit" class="btn btn-primary btn-block">Update Email</button>
          </div>
        </div>
      </form>
      <form novalidate>
        <div class="input-group" >
          <input type="password" id="password-update" class="form-control" placeholder="Your new Password">
          <input type="password" id="password-confirm" class="form-control" placeholder="Password confirm">
          <div class="input-group-append">
            <button type="submit" id="password-submit" class="btn btn-primary btn-block">Update Password</button>
          </div>
        </div>
      </form>
    </div>
    <script type="text/javascript">
      $(document).ready(function(){

        $('#name-submit').click(function(event){
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
            url: '/profile/name-update',
            data: update,
            dataType: 'json',
            success:function(){
            }
          });
        });

        $('#email-submit').click(function(){
          var newEmail = $('#email-update').val();
          var update = {
            id : {{$user->id}},
            email: newEmail
          };
          console.log(update);
          $.ajax({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            url: '/profile/email-update',
            data: update,
            dataType: 'json',
            success:function(){
            }
          });
        });


        $('#password-submit').click(function(){
          var newPassword = $('#password-update').val();
          var passConfirm = $('#password-confirm').val();

          if(newPassword != passConfirm){
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
            url: '/profile/password-update',
            data: update,
            dataType: 'json',
            success:function(){
            }
          });
        });

      });
    </script>
    @endif
  </div>
</div>
@endsection
