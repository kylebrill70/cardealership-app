@extends('layout.main')

<!-- HTML content -->
@section('content')

<!-- Sidebar --->
@include('include.sidebar')

<!-- Card -->
<div class="card mt-3">
    <div class="card-body">
        <!-- Form POST method -->
        <form action="{{ route('user.destroy', $user) }}" method="POST">
            <!-- CSRF -->
            @csrf
            @method('DELETE')
            <p class="lead" style="color: red">
              DELETE THIS USER!!!
          </p>
            <!-- First row -->
            <div class="row">
                <!-- Full name field -->
                <div class="mb-3 col-md-6">
                    <label for="full_name">Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name"
                      value="{{$user->full_name}}" readonly/>
                </div>
                <!-- Contact number field -->
                <div class="mb-3 col-md-6">
                  <label for="contact_number">Contact Number</label>
                  <input type="text" class="form-control" id="contact_number" name="contact_number"
                  value="{{$user->contact_number}}" readonly/>
              </div>
            </div>
            <!-- Second row -->
            <div class="row">
                <!-- Gender field -->
                <div class="mb-3 col-md-6">
                    <label for="gender_id">Gender</label>
                    <input type="text" class="form-control" id="gender_id" name="gender_id"
                    value="{{$user->gender_name}}"  readonly/>
                </div>
                <!-- Address field -->
                <div class="mb-3 col-md-6">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" name="address"  
                    value="{{$user->address}}" readonly/>
                </div>
            </div>
            <!-- Third row -->
            <div class="row">
                <!-- Username field -->
                <div class="mb-3 col-md-6">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username"
                    value="{{$user->username}}" readonly/>
                </div>
                <!-- Password field -->
                <div class="mb-3 col-md-6">
                  <label for="password">Password</label>
                  <input type="text" class="form-control" id="password" name="password"
                  value="{{$user->password}}" readonly/>
              </div>
            </div>
            <div class="row">
                  <!-- AccessType field -->
                  <div class="mb-3 col-md-6">
                    <label for="access_type">Access Type</label>
                    <input type="text" class="form-control" id="access_type" name="access_type"
                    value="{{$user->access_type}}" readonly/>
                </div>
            </div>
            <!-- Back button -->
            <button type="submit" class="btn btn-outline-danger float-end">Delete</button>
            <a href="/userstable" class="btn btn-secondary col-md-3">Back</a>
        </form>
    </div>
</div>

@endsection
