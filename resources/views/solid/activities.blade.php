@extends('solid.app')
@section('title')
Дейности |
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
            <h2>Дейности</h2>
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
            @foreach($entities as $activity)
                <div class="col-md-4">
                {{ HTML::image('assets/img/service/' . $activity->filename, $activity->name, ['width' => '100%', 'height' => 100]) }}
                <h4>{{ $activity->name }}</h4>
                <p>{{ $activity->description }}</p>
                <p><br/><a href="{{ route('guest.view', ['service', $activity->slug]) }}" class="btn btn-theme">Повече информация</a></p>
            </div>
            @endforeach
        </div>
    </div><! --/container -->
@stop
