@extends('company.app')
@section('css')
@endsection
@section('title', 'Услуги')
@section('route', 'Услуги')
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
            @foreach($entities as $project)
                <div class="col-md-4">
                    <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                        {{ HTML::image('assets/img/service/' . $project->filename, $project->name, ['class' => 'presentation-image']) }}
                        <h4>{{ $project->name }}</h4>
                        <p>{{ substr($project->description, 0, 200) . '...' }}</p>
                        <p><br/><a href="{{ route('guest.view', ['услуги', $project->slug]) }}" class="btn btn-primary">Повече информация</a></p>
                    </div>
                </div>
            @endforeach
        </div>
    </div><! --/container -->
@endsection

@section('js')
@endsection