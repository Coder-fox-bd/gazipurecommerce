<div>
    <style>
        .bordered-box {
            display: block;
            border-radius: 4px;
            border: 1px #ddd solid;
            background-color: #fff;
        }
        .bordered-box .bordered-box-inner {
            border-radius: 4px;
            position: relative;
        }
        .bordered-box .bordered-box-inner ul {
            padding: 0;
        }
        .bordered-box .bordered-box-inner ul li {
            border-bottom: 1px solid #e7e7e7;
            list-style: none;
            padding: 0;
        }
        .bordered-box .bordered-box-inner ul li:last-child {
            border-bottom: 0px;
        }
        .padding-medium {
            padding: 20px 18px!important;
        }
        .small-font {
            font-size: 13px
        }
    </style>
    @section('title', 'Login and security')
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="container padding-y" style="max-width:600px; min-height: 80vh;">
        <nav>
            <ol class="breadcrumb text-white p-0">
                <li class="breadcrumb-item"><a href="#">Your Account</a></li>
                <li class="breadcrumb-item active" aria-current="page">Login and security</li>
            </ol>  
        </nav>
        <h3>Login & security</h3>
        <div class="bordered-box">
            <div class="bordered-box-inner">
                <ul>
                    <li>
                        <div class="row padding-medium small-font">
                            <div class="col-6">
                                <span><strong>Name</strong></span>
                                <p>{{ Auth::user()->name }}</p>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-outline-secondary" data-toggle="collapse" href="#collapse1" role="button" aria-expanded="false" aria-controls="collapse1">Edit</a>
                            </div>
                            <div class="collapse" id="collapse1">
                                {{-- <div class="form-row p-3">
                                    <div class="col">
                                    <label class="sr-only" for="inlineFormInputName">Name</label>
                                    <input type="text" class="form-control" id="inlineFormInputName" value="{{ Auth::user()->name }}">
                                    </div>
                                    <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>   --}}
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row padding-medium small-font">
                            <div class="col-6">
                                <span><strong>Email</strong></span>
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-outline-secondary" data-toggle="collapse" href="#collapse2" role="button" aria-expanded="false" aria-controls="collapse2">Edit</a>
                            </div>
                            <div class="collapse" id="collapse2">
                                
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row padding-medium small-font">
                            <div class="col-6">
                                <span><strong>Password</strong></span>
                                <p>**********</p>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-outline-secondary" data-toggle="collapse" href="#collapse3" role="button" aria-expanded="false" aria-controls="collapse3">Edit</a>
                            </div>
                            <div class="collapse" id="collapse3">
                                
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
