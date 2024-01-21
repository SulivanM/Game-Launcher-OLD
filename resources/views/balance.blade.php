@extends('layouts.app')

@section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
    @include('partials.navbar')

    <div class="balance-container">
      <p class="coin-text">{{ number_format(Auth::user()->dcoin, 2) }} DCOIN</p>

      <form action="{{ route('paypal.process') }}" method="post">
        @csrf
        <button type="submit" name="amount" value="10.00">Ajouter 10 DCOIN</button>
        <button type="submit" name="amount" value="20.00">Ajouter 20 DCOIN</button>
        <button type="submit" name="amount" value="30.00">Ajouter 30 DCOIN</button>

        <label for="custom_amount">Montant personnalisé :</label>
        <input type="number" step="0.01" name="amount_custom" id="custom_amount" placeholder="Entrez le montant">

        <button type="submit">Payer avec PayPal</button>
      </form>
    </div>

  </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
@endsection