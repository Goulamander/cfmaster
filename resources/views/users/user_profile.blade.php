@extends('layouts.app')
@section('title')
    User Profile
@endsection
@section('content')
<div class="row">
    <div class="col-md-4">

        <br><br>
        <h4 >profile information </h4>
        <p>update your account's profile and email address.</p>

    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">account_circle</i>
                </div>
                <h3 class="card-title">
                    Photo
                </h3>
            </div>
            <div class="card-body">

                    <img  class="user_img" alt="User profile picture"  style="width:100px;border-radius: 50%;"src="{{ Auth::user()->photo ? Auth::user()->photo : 'https://ui-avatars.com/api/?name='.Auth::user()->name.'&color=7F9CF5&background=EBF4FF'}}" />

                        <form   method="POST" action="{{route('updateUserInfo')}}" id="user-profileForm">
                            <div class="form-group">
                                <input type="file" class="form-control" name="userProfileImg" id="user_img" style="opacity:0 ; height:1px; display:none;">
                                <button href="javascript:void(0)"  id="change_imageBttn" class="btn btn-outline-secondary btn-sm rounded">Select a new photo</button>
                            </div>


                            <input type="text" name="" id="id" value="{{ Auth::user()->id }}" hidden>
                            <div class="form-group">
                                <label for="user_name">Name</label><br>
                                <input type="text" name="name"  class="form-control "  id="user_name" value="{{ Auth::user()->name}}">
                                <span class="text-danger error-text name_error"></span>
                            </div>
                            <div class="form-group">
                                <label for="user_email">Email </label><br>
                                <input type="email" name="email"  class="form-control" id="user_email"  value="{{ Auth::user()->email}}">
                                <span class="text-danger error-text email_error"></span>
                            </div>
                            <button type="submit" id="save"class="btn btn-primary mb-2" on>Save</button>
                        </form>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4">

        <br><br>
        <h4 >Update Password </h4>
        <p>ensure your password is using long,random to stay secure.</p>

    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">password</i>
                </div>
            </div>
            <div class="card-body">

                    <form method="POST" action="{{route('changepassword')}}" id="change_password">
                        @csrf
                        <div class="form-group">
                            <label for="current_password">Current Password</label>
                            <input type="password" name="current_password" class="form-control"  id="current_pass" >
                            <span class="text-danger error-text current_password_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" name="new_password" class="form-control"  id="new_pass" >
                            <span class="text-danger error-text new_password_error"></span>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confrm Password</label>
                            <input type="password" name="confirm_password" class="form-control"  id="confirm_pass" >
                            <span class="text-danger error-text confirm_password_error"></span>
                        </div>

                        <button type="submit" id="save"class="btn btn-primary mb-2">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-md-4">

        <br><br>
        <h4 >Delete Account  </h4>
        <p>permanently delete your account</p>

    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header card-header-icon card-header-rose">
                <div class="card-icon">
                    <i class="material-icons">delete</i>
                </div>
            </div>
            <div class="card-body">
               <p>Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain. </p>

               <button class="btn btn-danger mb-2" type="button" onclick="deleteProfile({{Auth::user()->id}})">Delete Account</button>



            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
    <script src="{{ asset('media/js/user-profile.js') }}"></script>
@endsection
