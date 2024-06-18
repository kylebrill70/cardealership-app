@extends('layout.loginlayout')

@section('content')
<style>
    body {
        font-family: 'Courier New', Courier, monospace;
        background-color: #f3f3f3;
        color: #333;
    }
    .receipt-container {
        width: 80%;
        max-width: 600px;
        margin: 40px auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .receipt-header {
        text-align: center;
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }
    .receipt-header h3 {
        margin: 0;
    }
    .receipt-header p {
        margin: 0;
        font-size: 14px;
    }
    .receipt-heading {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }
    .receipt-item {
        margin-bottom: 10px;
    }
    .receipt-label {
        font-weight: bold;
    }
    .receipt-item span {
        display: inline-block;
        min-width: 100px;
    }
    .receipt-footer {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
    }
</style>
<div class="receipt-container">
    <div class="receipt-header">
        <h3>Zenith Motor</h3>
        <p>Roxas City</p>
        <p>Phone: (123) 456-7890</p>
        <p>Email: info@zenithmotor.com</p>
    </div>
    <h1 class="receipt-heading">Receipt</h1>
    <div class="receipt-item">
        <span class="receipt-label">Car Name:</span> <span>{{ $car_name }}</span>
    </div>
    <div class="receipt-item">
        <span class="receipt-label">Price:</span> <span>₱{{ number_format($price, 2) }}</span>
    </div>
    <div class="receipt-item">
        <span class="receipt-label">Cash:</span> <span>₱{{ number_format($cash, 2) }}</span>
    </div>
    <div class="receipt-item">
        <span class="receipt-label">Change:</span> <span>₱{{ number_format($change, 2) }}</span>
    </div>
    <div class="receipt-footer">
        <p>Thank you for your purchase!</p>
        <p>Visit us again at Zenith Motor.</p>
    </div>
</div>
@endsection
