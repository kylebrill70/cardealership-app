@extends('layout.main')

<!-- Sidebar -->
@include('include.sidebar')

@section('content')
<!-- Card -->
<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title">Parts Inventory</h5>
        @include('include.message')

        <!-- Search Form and Add Product Button -->
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <form action="{{ route('partstable') }}" method="GET" class="d-flex mb-3">
                <div class="input-group me-2">
                    <input type="text" class="form-control" name="search" placeholder="Search by part name" value="{{ $search }}">
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                </div>
            </form>
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addPartModal">
                    ADD PART
                </button>
                <a href="/partstypetable" class="btn btn-primary">PART TYPE</a>
            </div>
        </div>

        <!-- Responsive and hover table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Parts Image</th>
                        <th>Parts Name</th>
                        <th>Price</th>
                        <th>Part Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parts as $part)
                    <tr>
                        <td><img src="{{ $part->parts_image ? asset('storage/img/parts/'.$part->parts_image) : asset('img/blank.png') }}" alt="Parts Image" width="60px" height="60px"></td>
                        <td>{{ $part->parts_name }}</td>
                        <td>{{ $part->price }}</td>
                        <td>{{ $part->part_type_name }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('parts.view', $part->parts_id) }}" class="btn btn-outline-primary">View</a>
                                <a href="/editpartspage/{{$part->parts_id}}" class="btn btn-outline-warning">Edit</a>
                                <a href="/deletepartspage/{{$part->parts_id}}" class="btn btn-outline-danger">Delete</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Pagination Links -->
<div class="d-flex justify-content-center">
    {{ $parts->appends(request()->input())->links('pagination::bootstrap-5') }}
</div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addPartModal" tabindex="-1" aria-labelledby="addPartModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPartModalLabel">Add New Part</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Add New Part Form -->
        <form action="{{ route('parts.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <!-- Form fields -->
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Upload Photo</label>
                        <input class="form-control" type="file" id="parts_image" name="parts_image">
                        @error('parts_image') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label>Part Name</label>
                        <input class="form-control" type="text" id="parts_name" name="parts_name" placeholder="Enter part name">
                        @error('parts_name') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Price</label>
                        <input class="form-control" type="text" id="price" name="price" placeholder="Enter price">
                        @error('price') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label for="parts_type_id" class="form-label">Part Type</label>
                        <select class="form-select" id="parts_type_id" name="parts_type_id">
                            @foreach($parttypes as $parttype)
                                <option value="{{ $parttype->parts_type_id }}">{{ $parttype->part_type }}</option>
                            @endforeach
                        </select>
                        @error('parts_type_id') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Add Part</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
