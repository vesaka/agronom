@extends('company.app')
@section('css')
@endsection
@section('title', 'Клиенти')
@section('route', 'Клиенти')
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
            @php $link = route('guest.view', ['клиенти', $project->slug]) @endphp
            <div class="portfolio-item joomla bootstrap col-xs-12 col-sm-4 col-md-3">
                <div class="recent-work-wrap">
                    <a href="{{ $link }}" rel="{{ $project->name }}">
                    {{ HTML::image('assets/img/project/' . $project->filename, $project->name, ['class' => 'presentation-image img-responsive']) }}
                    </a>
                    <div class="overlay">
                      <div class="recent-work-inner">
                        <h3><a href="{{ $link }}">{{ $project->name }}</a></h3>
                        <p>{{ substr($project->description, 0, 200) . '...' }}</p>
                        <a href="{{ $link }}" rel="{{ $project->name }}"><i class="fa fa-eye"></i>Повече информация</a>
                      </div>
                    </div>
                </div>
              </div>
          <!--/.portfolio-item-->
            @endforeach
        </div>
    </div><! --/container -->
@endsection

@section('js')
@endsection