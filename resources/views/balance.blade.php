@extends('layouts.app')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
    @include('partials.navbar')
    <div class="title-space">
      <h2>BALANCE</h2>
      <p>{{ number_format(Auth::user()->dcoin, 2) }} DCOIN</p>

      <div class="card-container">
        <div class="card">
          <form action="{{ route('paypal.payment') }}" method="post">
            @csrf
            <label for="package">Select Package:</label>
            <select name="package" id="package">
              <option value="5">5 DCOIN</option>
              <option value="10">10 DCOIN</option>
              <option value="50">50 DCOIN</option>
            </select>

            <button type="submit">Pay with PayPal</button>
          </form>
        </div>
      </div>
    </div>

  </main>
</div>

<script src="{{ asset('js/index.js') }}"></script>

@if(session('payment_cancelled'))
<script>
  Swal.fire({
    title: "Payment Canceled",
    text: "Your payment has been canceled.",
    icon: "warning",
  });
</script>
@endif

@if(session('payment_successful'))
<script>
  Swal.fire({
    title: "Payment Successful",
    text: "Your payment was successful.",
    icon: "success",
  });
</script>
@endif

@endsection