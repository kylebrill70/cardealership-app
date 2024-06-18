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
    .receipt-header h1,
    .receipt-header h2 {
        margin: 0;
    }
    .receipt-header h2 {
        font-size: 18px;
        margin-top: 5px;
        color: #555;
    }
    .receipt-heading {
        font-size: 20px;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }
    .receipt-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }
    .receipt-table th,
    .receipt-table td {
        border: 1px solid #ccc;
        padding: 8px;
        text-align: left;
    }
    .receipt-table th {
        background-color: #f2f2f2;
    }
    .font-weight-bold {
        font-weight: bold;
    }
    .receipt-footer {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
    }
</style>
<div class="receipt-container">
    <div class="receipt-header">
        <h1>ZENITH MOTORS</h1>
        <h2>Roxas City Avenue</h2>
        <p>Phone: (123) 456-7890</p>
        <p>Email: info@zenithmotors.com</p>
    </div>
    <table class="receipt-table">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cartItems as $item)
            <tr>
                <td>{{ $item->parts_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₱{{ number_format($item->price, 2) }}</td>
            </tr>
            @endforeach
            <tr class="font-weight-bold">
                <td colspan="2">Total</td>
                <td>₱{{ number_format($total, 2) }}</td>
            </tr>
        </tbody>
    </table>
    <div class="receipt-footer">
        <p>Thank you for your purchase!</p>
        <p>Visit us again at Zenith Motors.</p>
    </div>
</div>
@endsection
