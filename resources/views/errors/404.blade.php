@extends('front.app')

@section('title')
Page Error - {{ config('app.name') }}
@stop

@section('content')
<div class="center">
  <div class="card bordered z-depth-2" style="margin:0% auto;max-width:100%;">
    <div class="card-content">
      <div class="m-b-30 text-center"> <i class="md md-warning error-icon"></i>
        <h1 class="pink-text uppercase">NOT FOUND</h1>
        <p>You are accessing something that is not here. Please head back.</p>
      </div>
    </div>
  </div>
</div>
@stop
