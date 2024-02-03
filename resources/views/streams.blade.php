@extends('layouts.app') @section('content')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<div class="container">
  @include('partials.sidebar')
  <main>
    @include('partials.navbar')
    <link href="https://vjs.zencdn.net/7.8.2/video-js.css" rel="stylesheet" />
    <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
    <script src="https://vjs.zencdn.net/7.8.2/video.js"></script>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <video id="my-video" class="video-js" controls preload="auto" width="1280" height="720" data-setup="{}">
            <source src="http://{{$_SERVER['SERVER_NAME']}}/hls/mystream.m3u8" type="application/x-mpegURL"
              res="9999" label="auto" />
            <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser
              that <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
          </video>
        </div>
      </div>
    </div>
  </main>
</div>
<script src="{{ asset('js/index.js') }}"></script>
@endsection