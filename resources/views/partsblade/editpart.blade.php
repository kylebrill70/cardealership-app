@extends('layout.main')

@include('include.sidebar')

@section('content')
<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="lead">Edit Part</p>
                    <form action="{{ route('parts.update', $part->parts_id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Part Image</label>
                                    <img src="{{ asset('storage/img/parts/' . $part->parts_image) }}" alt="Part Image" class="img-fluid small-img">
                                </div>
                                <div class="form-group">
                                    <label>Upload New Photo</label>
                                    <input class="form-control" type="file" id="parts_image" name="parts_image">
                                    @error('parts_image') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Part Name</label>
                                    <input class="form-control" type="text" id="parts_name" name="parts_name" value="{{ $part->parts_name }}">
                                    @error('parts_name') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input class="form-control" type="text" id="price" name="price" value="{{ $part->price }}">
                                    @error('price') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                                <div class="form-group">
                                    <label for="parts_type_id" class="form-label">Part Type</label>
                                    <select class="form-select" id="parts_type_id" name="parts_type_id">
                                        @foreach($parttypes as $parttype)
                                            <option value="{{ $parttype->parts_type_id }}" {{ $parttype->parts_type_id == $part->parts_type_id ? 'selected' : '' }}>{{ $parttype->part_type }}</option>
                                        @endforeach
                                    </select>
                                    @error('parts_type_id') <p class="text-danger">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Update Part</button>
                            <a href="/partstable" class="btn btn-secondary ms-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
