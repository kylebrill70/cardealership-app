@extends('layout.main')

@include('include.sidebar')

@section('content')
<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="lead">Edit Car</p>
                    <form action="{{ route('carproducts.update', $carproduct->cars_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Car Image</label>
                                    <img src="{{ asset('storage/img/cars/' . $carproduct->cars_image) }}" alt="Car Image" class="img-fluid small-img">
                                </div>
                                <div class="form-group">
                                    <label>Upload New Photo</label>
                                    <input class="form-control" type="file" id="cars_image" name="cars_image">
                                    @error('cars_image') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Car Name</label>
                                    <input class="form-control" type="text" id="car_name" name="car_name" value="{{ $carproduct->car_name }}">
                                    @error('car_name') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="form-group">
                                    <label>Engine Name</label>
                                    <input class="form-control" type="text" id="engine_name" name="engine_name" value="{{ $carproduct->engine_name }}">
                                    @error('engine_name') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea class="form-control" id="description" name="description">{{ $carproduct->description }}</textarea>
                                    @error('description') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input class="form-control" type="text" id="price" name="price" value="{{ $carproduct->price }}">
                                    @error('price') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="car_type_id" class="form-label">Car Type</label>
                                    <select class="form-select" id="car_type_id" name="car_type_id">
                                        @foreach($cartypes as $cartype)
                                            <option value="{{ $cartype->car_type_id }}" {{ $cartype->car_type_id == $carproduct->car_type_id ? 'selected' : '' }}>{{ $cartype->car_type }}</option>
                                        @endforeach
                                    </select>
                                    @error('car_type_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Update Car</button>
                            <a href="/carstable" class="btn btn-secondary ms-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
