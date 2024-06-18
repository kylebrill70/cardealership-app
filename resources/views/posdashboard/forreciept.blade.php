@extends('layout.loginlayout')

@section('content')
<div class="container">
  <div class="row">
      <div class="col-md-8 offset-md-2">
          <div class="card">
              <div class="card-header d-flex justify-content-between align-items-center">
                <a href="{{ url('/posdashboard')}}" class="btn btn-secondary">Back</a>
                  <span>Car Details</span>                 
              </div>
              <div class="card-body">
                  <p><strong>Car Name:</strong> {{ $car->car_name }}</p>
                  <p><strong>Price:</strong> ₱{{ number_format($car->price, 2) }}</p>
                  
                  <form id="payment-form" method="POST" action="{{ route('car.sales', $car->cars_id) }}">
                      @csrf
                      <div class="form-group">
                          <label for="cash">Cash:</label>
                          <input type="number" class="form-control" id="cash" name="cash" placeholder="Enter cash amount">
                      </div>
                      <p><strong>Change:</strong> <span id="change">₱0.00</span></p>
                      <div class="d-flex justify-content-end">
                          <button type="button" class="btn btn-primary" id="receipt-btn">Receipt</button>
                      </div>
                      <p id="error-message" class="text-danger mt-2" style="display:none;">Cash provided is less than the price!</p>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>

<script>
    function formatNumber(num) {
        return num.toLocaleString('en-PH', { style: 'currency', currency: 'PHP' });
    }

    document.getElementById('receipt-btn').addEventListener('click', function() {
    var price = {{ $car->price }};
    var cash = parseFloat(document.getElementById('cash').value);
    var change = cash - price;

    if (isNaN(cash) || cash < price) {
        document.getElementById('error-message').style.display = 'block';
        document.getElementById('change').innerText = '₱0.00';
    } else {
        document.getElementById('error-message').style.display = 'none';
        document.getElementById('change').innerText = formatNumber(change);

        // Create a FormData object to send the form data via AJAX
        var formData = new FormData(document.getElementById('payment-form'));
        
        // Add the change to the FormData
        formData.append('change', change.toFixed(2));

        // Perform the AJAX request
        fetch('{{ route('car.sales', $car->cars_id) }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Clear the cash input field
            document.getElementById('cash').value = '';

            // Create an iframe and load the PDF content into it
            var iframe = document.createElement('iframe');
            iframe.style.display = 'none';
            iframe.src = data.pdf_url;
            document.body.appendChild(iframe);
            iframe.onload = function() {
                iframe.contentWindow.focus();
                iframe.contentWindow.print();
            };
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
});

document.getElementById('cash').addEventListener('input', function() {
    document.getElementById('error-message').style.display = 'none';
    var price = {{ $car->price }};
    var cash = parseFloat(this.value);
    var change = cash - price;
    document.getElementById('change').innerText = formatNumber(change > 0 ? change : 0);
});


</script>
@endsection
