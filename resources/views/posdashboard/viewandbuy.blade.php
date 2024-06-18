@extends('layout.loginlayout')

@section('content')

<style>
  @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400;500;700&display=swap');
  
  body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      font-family: 'Montserrat', sans-serif;
      background: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('{{ $car->cars_image ? asset('storage/img/cars/'.$car->cars_image) : asset('img/blank.png') }}') no-repeat center center fixed;
      background-size: cover;
      color: #fff;
  }
  .container {
      padding: 20px;
      border-radius: 10px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      max-width: 600px;
      width: 100%;
      height: 80vh;
      position: relative;
      text-align: center;
  }
  .header {
      position: absolute;
      top: 20px;
      left: 20px;
  }
  .header a {
      text-decoration: none;
      color: #007bff;
      font-weight: bold;
  }
  .content {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
  }
  .content p {
      margin: 10px 0;
      color: white;
  }
  .content .car-name {
      font-size: 6em;
      font-weight:100;
      width: 150%;
  }
  .content .car-description {
      font-size: 1.75em;
      font-weight: 400;
      width: 200%; /* Adjust the width here */
  }
  .content .car-price {
      font-size: 1.5em;
      font-weight: 500;
  }
  .footer {
      position: absolute;
      bottom: 20px;
      right: 20px;
  }
  .buy-now-button {
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      text-decoration: none;
  }
  .buy-now-button:hover {
      background-color: #0056b3;
  }
</style>

<div class="header">
  <a href="/posdashboard">Back</a>
</div>
<div class="container">
  <div class="content">
    <p class="car-name"><strong>{{ $car->car_name }}</strong></p>
    <p class="car-description">{{ $car->description }}</p>
    <p class="car-price"><strong>Price: ₱{{ number_format($car->price, 2) }}</strong></p>
  </div>

</div>
<div class="footer">
  <form action="{{ route('car.buy') }}" method="POST">
    @csrf
    <input type="hidden" name="car_id" value="{{ $car->cars_id }}">
    <button type="submit" class="buy-now-button">Buy Now</button>
  </form>
</div>

@endsection
