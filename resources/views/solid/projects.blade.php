@extends('solid.app')
@section('title')
Проекти |
@stop
@section('css')
@stop
@section('body')
<!-- *****************************************************************************************************************
         TITLE & CONTENT
         ***************************************************************************************************************** -->

<div class="container mtb">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 centered">
            <h2>Проекти</h2>
            <br>
            <div class="hline"></div>
        </div>
    </div>
</div><! --/container -->

<!-- *****************************************************************************************************************
 PORTFOLIO SECTION
 ***************************************************************************************************************** -->
<div class="container">
        <div class="row centered services">
            @foreach($entities as $project)
                <div class="col-md-4">
                {{ HTML::image('assets/img/project/' . $project->filename, $project->name, ['width' => '100%', 'height' => 100]) }}
                <h4>{{ $project->name }}</h4>
                <p>{{ $project->description }}</p>
                <p><br/><a href="{{ route('guest.view', ['service', $project->slug]) }}" class="btn btn-theme">Повече информация</a></p>
            </div>
            @endforeach
        </div>
    </div><! --/container -->
@stop
