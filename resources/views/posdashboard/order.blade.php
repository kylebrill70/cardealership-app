@extends('layout.loginlayout')

@section('content')
<!-- Card -->
<div class="card mt-3">
    <div class="card-body">
        <a href="{{ url('/partsdashboard')}}" class="btn btn-secondary">Back</a>
        <h5 class="card-title">Order Summary</h5>
        @include('include.message')
        <!-- Responsive and hover table -->
        <div class="table-responsive">
            <table class="table table-hover">
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
                        <td>₱{{ $item->price }}</td>
                    </tr>
                    @endforeach
                    <tr class="font-weight-bold">
                        <td>Total</td>
                        <td></td>
                        <td>₱{{ $total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <form action="{{ route('generateReceipt') }}" method="POST" id="generateReceiptForm">
          @csrf
          <div class="form-group mb-3">
              <label for="amount">Enter Cash Amount:</label>
              <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter amount paid" required>
              <p id="change"></p>
              <input type="hidden" id="changeInput" name="change" value=""> <!-- Hidden input for change -->
          </div>
          <button type="button" class="btn btn-primary mr-2" id="computeChangeBtn">Compute Change</button>
          <button type="button" class="btn btn-primary" id="generateReceiptBtn">Generate Receipt</button>
      </form>
    </div>
</div>

<script>
  document.getElementById('computeChangeBtn').addEventListener('click', function() {
      const amountPaid = document.getElementById('amount').value;
      fetch('/compute-change', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          },
          body: JSON.stringify({ amount: amountPaid })
      })
      .then(response => response.json())
      .then(data => {
          if (data.change) {
              document.getElementById('change').innerText = 'Change: ₱' + data.change;
              document.getElementById('changeInput').value = data.change; // Set the value of the hidden input
          } else {
              document.getElementById('change').innerText = 'Amount paid is less than the total.';
          }
      })
      .catch(error => console.error('Error:', error));
  });

  document.getElementById('generateReceiptBtn').addEventListener('click', function() {
      const form = document.getElementById('generateReceiptForm');
      const formData = new FormData(form);

      fetch('{{ route('generateReceipt') }}', {
          method: 'POST',
          body: formData,
          headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
          }
      })
      .then(response => response.json())
      .then(data => {
          if (data.pdf_url) {
              // Open the PDF in a new tab
              window.open(data.pdf_url, '_blank');

              // Redirect to partsdashboard
              window.location.href = '{{ route('partsdashboard') }}';
          }
      })
      .catch(error => console.error('Error:', error));
  });
</script>
@endsection
