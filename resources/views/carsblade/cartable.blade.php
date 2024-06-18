@extends('layout.main')

@include('include.sidebar')

@section('content')
<!-- Card -->
<div class="card mt-3">
    <div class="card-body">
        <h5 class="card-title">Cars Inventory</h5>
        @include('include.message')

        <!-- Search Form and Add Product Button -->
        <div class="mb-3 d-flex justify-content-between align-items-center">
            <form action="{{ route('carproducts.search') }}" method="get" class="d-flex">
                <div class="input-group me-2">
                    <label for="search" class="me-2 align-self-center">Search</label>
                    <input type="text" class="form-control" name="search" id="search" />
                    <button type="submit" class="btn btn-outline-primary">Search</button>
                </div>
            </form>
            <div>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addPartModal">
                    ADD CAR
                </button>
            </div>
        </div>

        <!-- Responsive and hover table -->
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Car Image</th>
                        <th>Car Name</th>
                        <th>Engine Name</th>
                        <th>Price</th>
                        <th>Car Type</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cars as $car)
                    <tr>
                        <td><img src="{{ $car->cars_image ? asset('storage/img/cars/'.$car->cars_image) : asset('img/blank.png') }}" alt="Car Image" width="50"></td>
                        <td>{{ $car->car_name }}</td>
                        <td>{{ $car->engine_name }}</td>
                        <td>{{ $car->price }}</td>
                        <td>{{ $car->car_type_name }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('carproducts.edit', $car->cars_id) }}" class="btn btn-outline-warning">Edit</a>
                                <!-- Trigger the delete modal -->
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $car->cars_id }}">Delete</button>
                            </div>
                        </td>
                    </tr>

                    <!-- Modal for Deleting Car -->
                    <div class="modal fade" id="deleteModal{{ $car->cars_id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $car->cars_id }}" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $car->cars_id }}">Delete Car</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                          </div>
                          <div class="modal-body">
                            Are you sure you want to delete this car?
                          </div>
                          <div class="modal-footer">
                            <form action="{{ route('carproducts.destroy', $car->cars_id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Links -->
        <div class="d-flex justify-content-center">
            {{ $cars->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<!-- Modal for Adding Car -->
<div class="modal fade" id="addPartModal" tabindex="-1" aria-labelledby="addPartModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPartModalLabel">Add New Car</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Add New Car Form -->
        <form action="{{ route('cars.add') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <!-- Form fields -->
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label>Upload Photo</label>
                        <input class="form-control" type="file" id="cars_image" name="cars_image">
                        @error('cars_image') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label>Car Name</label>
                        <input class="form-control" type="text" id="car_name" name="car_name" placeholder="Enter car name">
                        @error('car_name') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label>Engine Name</label>
                        <input class="form-control" type="text" id="engine_name" name="engine_name" placeholder="Enter engine name">
                        @error('engine_name') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Enter description"></textarea>
                        @error('description') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input class="form-control" type="text" id="price" name="price" placeholder="Enter price">
                        @error('price') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                    <div class="form-group">
                        <label for="car_type_id" class="form-label">Car Type</label>
                        <select class="form-select" id="car_type_id" name="car_type_id">
                            @foreach($cartypes as $cartype)
                                <option value="{{ $cartype->car_type_id }}">{{ $cartype->car_type }}</option>
                            @endforeach
                        </select>
                        @error('car_type_id') <p class="text-danger">{{ $message }}</p> @enderror
                    </div>
                </div>
            </div>
            <div class="text-center mt-3">
                <button type="submit" class="btn btn-primary">Add Car</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
