@extends('layout.loginlayout')
@section('content')

<style>
    label {
        color: black;
    }

    .h2 {
        color: black;
    }

    .lead {
        color: black;
    }

    body {
        margin-top: 20px;
        background-color: #ffffff; /* Changed background color to white */
    }

    .card {
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 15px 1px rgba(52, 40, 104, .08);
        background-color: rgba(255, 255, 255, 0.95); /* Slightly opaque to differentiate from background */
        padding: 20px;
        border-radius: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="file"],
    select {
        background: rgba(255, 255, 255, 0.7);
        border: solid;
        border-width: 1px;
        border-radius: 5px;
        padding: 10px;
        width: calc(100% - 20px);
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
    }

    .btn-secondary {
        background-color: #6c757d;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
    }

</style>

<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12">
          @include('include.message')
            <div class="card">
                <div class="card-body">
                  <form action="{{ route('parts.add') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                        <p class="lead">
                            Add New Part
                        </p>
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
                            <a href="/partstable" class="btn btn-secondary ms-2">Back</a>
                            <button type="submit" class="btn btn-primary">Add Part</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
