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
                    <form action="#" method="get">
                        <label for="search">Search</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" id="search" />
                            <a type="submit"  class="btn btn-outline-primary">Search</a>
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
                    @foreach ($delusers as $deluser)
                    <tr>
                        <td>{{ $deluser->full_name }}</td>
                        <td>{{ $deluser->gender_name }}</td> <!-- Display gender name -->
                        <td>{{ $deluser->access_type}}</td>
                        <td>{{ $deluser->address }}</td>
                        <td>
                          <td>
                            <td>
                              <div class="btn-group">
                                  <a href="{{ route('user.restore', ['id' => $deluser->user_id]) }}" class="btn btn-outline-primary">Restore</a>
                                  <a href="{{ route('user.delete', ['id' => $deluser->user_id]) }}" class="btn btn-outline-danger">Delete</a>
                              </div>
                          </td>
                          
                        </td>
                        
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
