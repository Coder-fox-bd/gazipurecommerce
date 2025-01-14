@extends('user.layouts.user_two')

@section('title', 'Login')

@section('css')

@endsection

@section('content')
    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-conten padding-y" style="min-height:84vh">

        <!-- ============================ COMPONENT LOGIN   ================================= -->
            <div class="card mx-auto" style="max-width: 380px; margin-top:100px;">
            <div class="card-body">
                @if (Session::has('worning'))
                <div class="alert alert-danger" role="alert">
                    {{ Session::get('worning') }}
                </div>
                @endif
            <h4 class="card-title mb-4">Sign in</h4>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                    {{-- <a href="{{ route('login.facebook') }}" class="btn btn-facebook btn-block mb-2"> <i class="fab fa-facebook-f"></i> &nbsp  Sign in with Facebook</a>
                    <a href="{{ route('login.google') }}" class="btn btn-google btn-block mb-4"> <i class="fab fa-google"></i> &nbsp  Sign in with Google</a> --}}
                <div class="form-group">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> <!-- form-group// -->
                <div class="form-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div> <!-- form-group// -->
                
                <div class="form-group">
                    <a href="{{ route('password.request') }}" class="float-right">Forgot password?</a> 
                    <label class="float-left custom-control custom-checkbox"> 
                        <input class="custom-control-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <div class="custom-control-label"> Remember </div> 
                    </label>
                </div> <!-- form-group form-check .// -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Login  </button>
                </div> <!-- form-group// -->    
            </form>
            </div> <!-- card-body.// -->
            </div> <!-- card .// -->
        
            <p class="text-center mt-4">Don't have account? <a href="{{ route('register') }}">Sign up</a></p>
            <br><br>
        <!-- ============================ COMPONENT LOGIN  END.// ================================= -->
        
        
    </section>
@endsection

@section('js')

@endsection



