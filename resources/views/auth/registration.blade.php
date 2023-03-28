@extends('layouts.main')
@section('main-section')


<div class="container-fluid signUp-page">
  <div class="row form-box">

      <div class="col-md-6">
          <div class="login">
            <form action="{{url('post-registration')}}" method="POST" id="regForm">
              {{ csrf_field() }}
                  <h1>Sign Up</h1>
                  <div class="border-reg"></div>
                  <label>Name</label>
                  <input type="text" id="inputName" name="name" class="form-control" placeholder="Full name" autofocus>
                  @if ($errors->has('name'))
                  <span class="error">{{ $errors->first('name') }}</span>
                  @endif      
                  <label>Email</label>
                  <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" >
                  
                  @if ($errors->has('email'))
                  <span class="error">{{ $errors->first('email') }}</span>
                  @endif   
                  <label>Password</label>
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                  @if ($errors->has('password'))
                  <span class="error">{{ $errors->first('password') }}</span>
                  @endif  
                  <button type="submit" class="btn">click here for Register</button>
                  <p class="about-text">Don't have an account <a href="{{url('login')}}">Log
                          In</a></p>

              </form>
          </div>
      </div>
      <div class="col-md-6  p-0">
          <div class="pic">
              <img src="./image/signing.png" />
          </div>
      </div>
  </div>
</div>
@endsection