@extends('front.app')

@section('title')
Maintenance - {{ config('app.name') }}
@stop

@section('content')
<div class="center">
  <div class="card bordered z-depth-2" style="margin:0% auto;max-width:100%;">
    <div class="card-content">
      <div class="m-b-30 text-center"> <i class="md md-history error-icon"></i>
        <h1 class="pink-text uppercase" style="font-weight:700;">MAINTENANCE[维护中]</h1>
        <p> We are sorry, system is processing server maintenance currently, thanks for your patient and please try again later. Thank you.</p>
        <p>您好，目前系统正在进行例行维护，请稍后再试，谢谢。 </p>
      </div>
    </div>
  </div>
</div>
@stop
