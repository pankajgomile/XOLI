@extends('layouts.main')
@section('main-section')

@if(Session::has('Message'))
<div class="alert alert-danger text-center">
  <strong> {{Session::get('Message')}}</strong>
</div>
@endif   
<div class="container-fluid login-page">
  <div class="row login-form-box">
      <div class="col-md-6  p-0">
          <div class="pic">
              <img src="./image/login-img.svg" />
          </div>
      </div>
      <div class="col-md-6">
          
            <form action="{{url('post-login')}}" method="POST" id="logForm">
              {{ csrf_field() }}
                  <h1>Login In</h1>
                  <div class="border1"></div>
                 
                  <label>Email</label>
                  <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" >
                  <div>
                    @if ($errors->has('email'))
                    <span class="alert alert-danger">{{ $errors->first('email') }}</span>
                    @endif    
                  </div>
                  <label>Password</label>
                  <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password">
                  <div>
                    @if ($errors->has('password'))
                    <span class="alert alert-danger">{{ $errors->first('password') }}</span>
                    @endif  
                  </div>
                  <button type="submit" class="btn">Sign In</button>
                  <p class="about-text">Don't have an account <a href="{{url('registration')}}">Sign
                      Up</a></p>
                  
              </form>
         
      </div>

  </div>
</div>
@endsection