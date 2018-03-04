@extends('solid.app')
@section('title')
Начало |
@stop
@section('css')
<link href="assets/css/main.css" rel="stylesheet">
@stop
@section('body')
<div id="headerwrap">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <img src="assets/img/truck_home.jpeg" class="img-responsive">
            </div>
            <div class="col-lg-12 header-text">
                <h1>Eyecatching Bootstrap 3 Theme.</h1>
                <h5>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</h5>
                <h5>More Lorem Ipsum added here too.</h5>
            </div>
        </div><!-- /row -->
    </div> <!-- /container -->
</div><!-- /headerwrap -->
<div id="service">
    <div class="container">
        <div class="row centered services">
            @foreach($services as $service)
                <div class="item col-md-4">
                <h4>{{ $service->name }}</h4>
                {{ HTML::image('assets/img/service/' . $service->filename, $service->name, ['width' => '100%', 'height' => 100, 'class' => 'service-image']) }}
                <p class="cta-wraper"><a href="{{ route('guest.view', ['service', $service->slug]) }}" class="btn btn-theme">Повече информация</a></p>
                <div class="hidden-info" style="display: none">
                <p class="text"></p>
                </div>
            </div>
            @endforeach
        </div>
    </div><! --/container -->
</div><! --/service -->
<div id="portfoliowrap">
    <h3>LATEST WORKS</h3>
    <div class="portfolio-centered">
        <div class="recentitems portfolio">
            @foreach($projects as $project)
            <div class="portfolio-item graphic-design">
                <div class="he-wrap tpl6">
                    <img src="assets/img/project/{{ $project->name }}" alt="">
                    <div class="he-view">
                        <div class="bg a0" data-animate="fadeIn">
                            <h3 class="a1" data-animate="fadeInDown">A Graphic Design Item</h3>
                            <a data-rel="prettyPhoto" href="assets/img/portfolio/portfolio_09.jpg" class="dmbutton a2" data-animate="fadeInUp"><i class="fa fa-search"></i></a>
                            <a href="single-project.html" class="dmbutton a2" data-animate="fadeInUp"><i class="fa fa-link"></i></a>
                        </div><!-- he bg -->
                    </div><!-- he view -->
                </div><!-- he wrap -->
            </div><!-- end col-12 -->
            @endforeach
        </div><!-- portfolio -->
    </div><!-- portfolio container -->
</div><!--/Portfoliowrap -->

<!-- *****************************************************************************************************************
 TESTIMONIALS
 ***************************************************************************************************************** -->
<!--<div id="twrap">
    <div class="container centered">
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <i class="fa fa-comment-o"></i>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                <h4><br/>Marcel Newman</h4>
                <p>WEB DESIGNER - BLACKTIE.CO</p>
            </div>
        </div><! --/row -->
    </div><! --/container -->
</div><! --/twrap -->
@stop
@section('js')
<script src="assets/js/main.js"></script>
@stop
