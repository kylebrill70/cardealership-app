@extends('layout.main')

<!-- HTML content -->
@section('content')

<!-- Sidebar --->
@include('include.sidebar')

<!-- Card -->
<div class="card mt-3">
    <div class="card-body">
        <!-- Form POST method -->
        <form action="{{ route('user.update', $user->user_id) }}" method="post">
            <!-- CSRF -->
            @csrf
            @method('PUT')
            <p class="lead">
              EDIT USERS INFORMATION
          </p>
            <!-- First row -->
            <div class="row">
                <!-- Full name field -->
                <div class="mb-3 col-md-6">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name"
                      value="{{$user->full_name}}"/>
                </div>
                <!-- Contact number field -->
                <div class="mb-3 col-md-6">
                  <label for="contact_number">Contact Number</label>
                  <input type="text" class="form-control" id="contact_number" name="contact_number"
                  value="{{$user->contact_number}}"/>
              </div>
            </div>
            <!-- Second row -->
            <div class="row">
                <!-- Gender field -->
                <div class="mb-3 col-md-6">
                  <label for="gender" class="form-label">Gender</label>
                  <select class="form-select" id="gender_id" name="gender_id">
                      @foreach($genders as $gender)
                          <option value="{{ $gender->gender_id }}">{{ $gender->gender }}</option>
                      @endforeach
                  </select>
                </div>
                <!-- Address field -->
                <div class="mb-3 col-md-6">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address"  
                    value="{{$user->address}}"/>
                </div>
            </div>
            <!-- Third row -->
            <div class="row">
                <!-- Username field -->
                <div class="mb-3 col-md-6">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                    value="{{$user->username}}"/>
                </div>
                <!-- Password field -->
                <div class="mb-3 col-md-6">
                  <label for="password">Password</label>
                  <input type="text" class="form-control" id="password" name="password"
                  value="{{$user->password}}"/>
              </div>
            </div>
            <!-- Fourth Row -->
            <div class="row">
                <!-- Access field -->
                <div class="mb-3 col-md-6">
                    <label for="accesstype" class="form-label">Access Type</label>
                    <select class="form-select" id="user_access_id" name="user_access_id">
                        @foreach($accesstypes as $accesstype)
                            <option value="{{ $accesstype->user_access_id }}">{{ $accesstype->user_access_type }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!-- Back button -->
            <button type="submit" class="btn btn-primary float-end">Save</button>
            <a href="/userstable" class="btn btn-secondary col-md-3">Back</a>
        </form>
    </div>
</div>

@endsection
