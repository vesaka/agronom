@extends('company.app')
@section('css')
@endsection
@section('title', 'Дейности')
@section('route', 'Дейности')
@section('content')
<!-- *****************************************************************************************************************
         TITLE & CONTENT
         ***************************************************************************************************************** -->

<div class="header-row" id="header-row" style="padding: 0px; overflow:hidden; height:300px;">
   <div class="container-fluid" style="padding: 0px; margin:0;">
      <div class="row"> 
         <div class="col-md-12"> 
               <img src="{{ asset('/assets/img/service-banner.jpg') }}" alt="company logo" style="width: 100%;">
         </div>     
      </div>
   </div>
</div>

<!-- *****************************************************************************************************************
 PORTFOLIO SECTION
 ***************************************************************************************************************** -->
<div class="container">
        <div class="row centered services">
            @foreach($entities as $activity)
                <div class="col-md-4">
                {{ HTML::image('assets/img/activity/' . $activity->filename, $activity->name, ['width' => '100%', 'height' => 100]) }}
                <h4>{{ $activity->name }}</h4>
                <p>{{ $activity->description }}</p>
                <p><br/><a href="{{ route('guest.view', ['дейности', $activity->slug]) }}" class="btn btn-theme">Повече информация</a></p>
            </div>
            @endforeach
        </div>
    </div><! --/container -->
@endsection

@section('js')
@endsection