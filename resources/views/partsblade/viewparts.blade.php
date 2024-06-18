@extends('layout.main') <!-- Replace with your actual layout -->

@include('include.sidebar')
@section('content')

<style>
    label {
        color: black;
    }

    .card {
        margin-bottom: 1.5rem;
        box-shadow: 0 1px 15px 1px rgba(52, 40, 104, .08);
        background-color: rgba(255, 255, 255, 0.95);
        padding: 20px;
        border-radius: 10px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-control {
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid #060708;
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

    .img-fluid {
        max-width: 100%;
        height: auto;
        display: block;
        margin: 10px 0;
    }

    .small-img {
        width: 150px; /* Set your desired width */
        height: auto; /* Maintain aspect ratio */
    }
</style>

<div class="container h-100">
    <div class="row justify-content-center align-items-center h-100">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <p class="lead">Part Details</p>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Part Image</label>
                                <img src="{{ asset('storage/img/parts/' . $parts->parts_image) }}" alt="Part Image" class="img-fluid small-img">
                            </div>
                            <div class="form-group">
                                <label>Part Name</label>
                                <input class="form-control" type="text" value="{{ $parts->parts_name }}" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" type="text" value="{{ $parts->price }}" readonly>
                            </div>
                            <div class="form-group">
                                <label>Part Type</label>
                                <input class="form-control" type="text" value="{{ $parts->part_type_name }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-3">
                        <a href="/partstable" class="btn btn-secondary ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
