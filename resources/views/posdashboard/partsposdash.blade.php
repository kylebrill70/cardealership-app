@extends('layout.loginlayout')

@section('content')

<!-- Display Success Message -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{ session('success') }}
</div>
@endif

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">ZENITH MOTORS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="/posdashboard">CARS</a>
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

<div class="container-fluid mt-4">
    <div class="row">
        <!-- Parts Table -->
        <div class="col-md-8">
            <h2>Available Parts</h2>
            <div class="row">
                @foreach($parts as $part)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100" data-part-id="{{ $part->parts_id }}">
                            <img src="{{ $part->parts_image ? asset('storage/img/parts/'.$part->parts_image) : asset('img/blank.png') }}" class="card-img-top" alt="Part Image" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $part->parts_name }}</h5>
                                <p class="card-text">₱ {{ number_format($part->price, 2) }}</p>
                                <button class="btn btn-primary mt-auto add-to-cart-btn" data-part-id="{{ $part->parts_id }}">Add to Cart</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Cart -->
        <div class="col-md-4">
            <h2>Cart</h2>
            <div id="cart-items" class="bg-light p-3">
                <!-- Cart items will be appended here dynamically -->
        </div>
        <form id="checkout-form" action="{{ route('checkout') }}" method="POST" style="display: none;">
            @csrf
                <button type="submit" class="btn btn-success mt-3" id="checkout-btn" style="display: none;">Checkout</button>
        </form>
        <div>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('checkout') }}">Check Out</a>
            </li>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const cartItemsContainer = document.getElementById('cart-items');
    const checkoutButton = document.getElementById('checkout-btn');

    document.querySelectorAll('.add-to-cart-btn').forEach(button => {
        button.addEventListener('click', function() {
            const partId = this.dataset.partId;
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ part_id: partId })
            })
            .then(response => response.json())
            .then(data => {
                updateCartPreview(data.cart);
            })
            .catch(error => console.error('Error:', error));
        });
    });

    function updateCartPreview(cart) {
        cartItemsContainer.innerHTML = '';
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p>No items in cart</p>';
            return;
        }

        cart.forEach(item => {
            const cartItem = document.createElement('div');
            cartItem.classList.add('cart-item');
            cartItem.innerHTML = `
                <p>${item.parts_name} - ₱${item.price} x ${item.quantity}</p>
                <button class="btn btn-danger btn-sm remove-from-cart-btn" data-cart-id="${item.cart_id}">Remove</button>
            `;
            cartItemsContainer.appendChild(cartItem);
        });

        checkoutButton.style.display = 'block';

        document.querySelectorAll('.remove-from-cart-btn').forEach(button => {
            button.addEventListener('click', function() {
                const cartId = this.dataset.cartId;
                fetch('/cart/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ cart_id: cartId })
                })
                .then(response => response.json())
                .then(data => {
                    updateCartPreview(data.cart);
                })
                .catch(error => console.error('Error:', error));
            });
        });
    }

    // Fetch the initial cart state
    fetch('/cart')
    .then(response => response.json())
    .then(data => {
        updateCartPreview(data.cart);
    })
    .catch(error => console.error('Error:', error));
});




</script>
@endsection
