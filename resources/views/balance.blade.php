@extends('layouts.app')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
    @include('partials.navbar')

    <div class="balance-container">
      <p class="coin-text">{{ number_format(Auth::user()->dcoin, 2) }} DCOIN</p>

      <a href="{{ route('paypal.payment') }}" class="btn btn-success">Pay with PayPal </a>
    </div>

  </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
@endsection