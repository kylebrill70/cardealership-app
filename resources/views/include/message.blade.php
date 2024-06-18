@if (session()->has('message_success'))
    <div class="alert alert-success" role="alert">
        {{ session('message_success') }}
    </div>
@endif

