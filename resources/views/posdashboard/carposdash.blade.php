@extends('layout.loginlayout')

@section('content')

<!-- Display Success Message -->


<!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ZENITH MOTORS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/partsdashboard">PRODUCTS</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/logout">LOGOUT</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
</div>
@endif

<!-- Card Section -->
<div class="container mt-4">
    <div class="row">
        @foreach($cars as $car)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100" data-car-id="{{ $car->cars_id }}">
                    <img src="{{ $car->cars_image ? asset('storage/img/cars/'.$car->cars_image) : asset('img/blank.png') }}" class="card-img-top" alt="Car Image" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $car->car_name }}</h5>
                        <p class="card-text">₱ {{ number_format($car->price, 2) }}</p>
                        <input type="hidden" value="{{ $car->cars_id }}" class="car-id">
                        <a href="{{ route('car.show', ['id' => $car->cars_id]) }}" class="btn btn-primary mt-auto view-car">View</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
