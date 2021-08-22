@extends('user.layouts.user_two')

@section('title', 'Login')

@section('css')

@endsection

@section('content')
    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-y">

        <!-- ============================ COMPONENT REGISTER   ================================= -->
            <div class="card mx-auto" style="max-width:520px;">
                <article class="card-body">
                    <header class="mb-4"><h4 class="card-title">Sign up</h4></header>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                            <label for="fname">Name</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
                        </div> <!-- form-group end.// -->
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input class="form-control @error('address') is-invalid @enderror" type="text" name="address" id="address" value="{{ old('address') }}" required autocomplete="address">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="city">City</label>
                                <input type="text" class="form-control  @error('city') is-invalid @enderror" name="city" id="city" value="{{ old('city') }}" required autocomplete="city">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="country">Country</label>
                                <select id="country" class="form-control @error('country') is-invalid @enderror" name="country" value="{{ old('country') }}" required autocomplete="country">
                                    <option> Choose...</option>
                                    <option value="Bangladesh">Bangladesh</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="contact">Phone</label>
                            <input type="tel" class="form-control @error('phone_number') is-invalid @enderror" id="contact" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">
                        </div> <!-- form-group end.// -->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Create password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div> <!-- form-group end.// --> 
                            <div class="form-group col-md-6">
                                <label>Repeat password</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div> <!-- form-group end.// -->  
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block"> Register  </button>
                        </div> <!-- form-group// -->      
                        <div class="form-group"> 
                            <label class="custom-control custom-checkbox"> 
                                <input type="checkbox" class="custom-control-input" name="agreement" required> 
                                <div class="custom-control-label"> I am agree with <a href="#">terms and contitions</a> </div>
                            </label>
                        </div> <!-- form-group end.// -->           
                    </form>
                </article><!-- card-body.// -->
            </div> <!-- card .// -->
            <p class="text-center mt-4">Have an account? <a href="{{ route('login') }}">Log In</a></p>
            <br><br>
        <!-- ============================ COMPONENT REGISTER  END.// ================================= -->
    </section>
    @endsection

    @section('js')
    
    @endsection
