@extends('layout.loginlayout')

@include('include.sidebar')

@section('content')
<style>
    .card-holder-container {
        display: flex;
        min-height: 100vh;
        background-color: #f8f9fa;
    }
    .sidebar {
        width: 250px; /* Adjust the width of the sidebar as needed */
        background-color: #343a40; /* Sidebar background color */
        color: #fff;
        padding: 15px;
        height: 100vh;
    }
    .main-content {
        flex: 1;
        padding: 15px;
    }
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
    .card h5 {
        font-size: 18px;
        font-weight: bold;
    }
    .card p {
        font-size: 16px;
    }
</style>

<div class="card-holder-container">
    <div class="sidebar">
        @include('include.sidebar')
    </div>
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">Most Sold Car</h5>
                            <p class="card-text">{{ $mostSoldProduct->product_name }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">Total Car Sales</h5>
                            <p class="card-text">{{ number_format($totalSalesAmount,2) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">Least Sold Car</h5>
                            <p class="card-text">{{ $leastSoldProduct->product_name }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">Most Sold Product</h5>
                            <p class="card-text">{{ $partsMostsold->product_name }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">Total Product Sales</h5>
                            <p class="card-text">{{ number_format($partsTotalsale,2) }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <h5 class="card-title">Least Sold Product</h5>
                            <p class="card-text">{{ $partsLeast->product_name }}</p>
                        </div>
                    </div>
                </div>
            </div>

            


        </div>
    </div>
</div>
@endsection
