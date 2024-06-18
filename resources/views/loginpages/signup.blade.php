@extends('layout.loginlayout')
@section('content')

<style>
    label {
        color: white;
    }

    .h2 {
        color: white;
    }

    .lead {
        color: white;
    }

    body {
        margin-top: 20px;
        background: url('../img/dl.jpg'); /* Replace 'path_to_your_image.jpg' with the path to your image */
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed; /* This will fix the background image */
        background-color: #f2f3f8; /* Fallback color if the image is not available */
    }

    .card {
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 15px 1px rgba(52, 40, 104, .08);
        background-color: rgba(255, 255, 255, 0.2); /* Glassmorphism background */
        padding: 20px;
        border-radius: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        background: rgba(255, 255, 255, 0.7); /* Glassmorphism input background */
        border: none;
        border-radius: 5px;
        padding: 10px;
        width: calc(100% - 20px); /* Adjusted width */
    }

    .btn-primary {
        background-color: #007bff; /* Primary button color */
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
    }

</style>

<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12"> <!-- Change this to col-12 to make the form wider -->
          @include('include.message')
            <div class="card">
                <div class="card-body">
                    <!-- ... -->
                    <form action="/saveacc" method="POST">
                        @csrf
                        <p class="lead">
                            Let's Get Started Sign Up for Access.
                        </p>
                        <div class="row">
                            <div class="col-6"> <!-- Change this to col-6 to make two inputs per column -->
                                <div class="form-group">
                                    <label>Name</label>
                                    <input class="form-control" id="full_name" name="full_name" type="text" placeholder="Enter your name" style="width: 100%;"> <!-- Add style="width: 100%;" to make the input wider -->
                                    @error('full_name') <p class="text-danger">{{ $message }}</p> @enderror
                                  </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control" type="text" id="address" name="address" placeholder="Enter your Address" style="width: 100%;">
                                    @error('address') <p class="text-danger">{{ $message }}</p> @enderror
                                  </div>
                            </div>
                            <div class="col-6"> <!-- Add this to make two inputs per column -->
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control" id="username" name="username"placeholder="Enter your username" style="width: 100%;">
                                    @error('username') <p class="text-danger">{{ $message }}</p> @enderror
                                  </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control" type="password" id="password" name="password" placeholder="Enter password" style="width: 100%;">
                                    @error('password') <p class="text-danger">{{ $message }}</p> @enderror
                                  </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6"> <!-- Change this to col-6 to make two inputs per column -->
                                <div class="form-group">
                                    <label>Contact Number</label>
                                    <input class="form-control" type="text" id="contact_number" name="contact_number"placeholder="Enter your phone number" style="width: 100%;">
                                    @error('contact_number') <p class="text-danger">{{ $message }}</p> @enderror
                                  </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input class="form-control" type="password" id="password_confirmation"
                                           name="password_confirmation" placeholder="Confirm password"
                                           style="width: 100%;">
                                </div>
                                @error('password_confirmation') <p class="text-danger">{{ $message }}</p> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender_id" name="gender_id">
                                    @foreach($genders as $gender)
                                        <option value="{{ $gender->gender_id }}">{{ $gender->gender }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Sign up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
