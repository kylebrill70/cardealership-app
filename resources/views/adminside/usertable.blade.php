@extends('layout.main')

<!-- Sidebar --->
@include('include.sidebar')

@section('content')
<!-- Card -->
<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title">List of Users</h5>
        <!-- Responsive and hover table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <div class="mb-3 col-sm-3 ms-1">
                    @include('include.message')
                    <form action="{{ route('adminside.usertable') }}" method="get">
                        <label for="search">Search</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" id="search" value="{{ request()->input('search') }}" />
                            <button type="submit" class="btn btn-outline-primary">Search</button>
                        </div>
                    </form>
                </div>
                <thead>
                    <tr>
                        <th>Users Name</th>
                        <th>Gender</th>
                        <th>Access Type</th>
                        <th>Address</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->full_name }}</td>
                        <td>{{ $user->gender_name }}</td> <!-- Display gender name -->
                        <td>{{ $user->access_type }}</td>
                        <td>{{ $user->address }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="/viewuser/{{$user->user_id}}" class="btn btn-outline-primary">View</a>
                                <a href="/edituser/{{$user->user_id}}" class="btn btn-outline-warning">Edit</a>
                                <a href="/deleteuser/{{$user->user_id}}" class="btn btn-outline-danger">Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
