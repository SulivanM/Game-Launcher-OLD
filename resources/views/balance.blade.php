@extends('layouts.app') @section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
   @include('partials.navbar')
  </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
@endsection