<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="shortcut icon" href="assets/ico/favicon.ico">

        <title>@yield('title')Бизнес</title>
        <!-- Bootstrap core CSS -->
        <link href="assets/css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="assets/css/style.css" rel="stylesheet">
        <link href="assets/css/font-awesome.min.css" rel="stylesheet">
        @yield('css')

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="assets/js/modernizr.js"></script>
    </head>
    <body>
        @php $settings = json_decode(Storage::get('settings.json')); @endphp
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ route('start') }}" ><img src="/assets/img/logo_agronom.svg" alt="" width="64px" height="64px"/></a>
                </div>
                @php
                    $services = App\Models\Service::get();
                    $projects = App\Models\Project::get();
                    $activities = App\Models\Activity::get();
                @endphp
                <div class="navbar-collapse collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="{{ route('services') }}">Услуги</a>
                            <ul class="nav navbar-nav pull-right">
                            @foreach($services as $service)
                            <li><a href="{{ route('guest.view', ['service', $service->slug]) }}">{{ $service->name }}</a></li>
                            @endforeach
                            </ul>

                        </li>
                        <li>
                            <a href="{{ route('activities') }}">Дейности</a>
                            <ul class="nav navbar-nav pull-right">
                            @foreach($activities as $activity)
                            <li><a href="{{ route('guest.view', ['activity', $activity->slug]) }}">{{ $activity->name }}</a></li>
                            @endforeach
                            </ul>

                        </li>
                        <li>
                            <a href="{{ route('projects') }}">Проекти</a>
                            <ul class="nav navbar-nav pull-right">
                            @foreach($projects as $project)
                            <li><a href="{{ route('guest.view', ['project', $project->slug]) }}">{{ $project->name }}</a></li>
                            @endforeach
                            </ul>

                        </li>
                        <li><a href="{{ route('about') }}">За нас</a></li>
                        <li><a href="{{ route('contacts') }}">Контакти</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </div>
        @yield('body')
        <div id="footerwrap">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4">
                        <h4>About</h4>
                        <div class="hline-w"></div>
                        <p>{{ $settings->info }}</p>
                    </div>
                    <div class="col-lg-4 links">
                        <h4>Връзки</h4>
                        <div class="hline-w"></div>
                        <p><a href="{{ route('services') }}"><i class="fa fa-wrench"></i>Услуги</a></p>
                        <p><a href="{{ route('activities') }}"><i class="fa fa-suitcase"></i>Дейности</a></p>
                        <p><a href="{{ route('projects') }}"><i class="fa fa-dashboard"></i>Проекти</a></p>
                        <p><a href="{{ route('about') }}"><i class="fa fa-info"></i>За нас</a></p>
                        <p><a href="{{ route('contacts') }}"><i class="fa fa-phone"></i>Контакти</a></p>
                    </div>
                    <div class="col-lg-4">
                        <h4>Адрес</h4>
                        <div class="hline-w"></div>
                        <p>
                            <i class="fa fa-map-marker"></i>{{ $settings->street }}, {{ $settings->number }},<br/>
                            {{ $settings->zip_code }}, {{ $settings->residense }},<br/>
                            {{ $settings->country }}.<br/>
                        </p>
                    </div>

                </div><!--/row -->
            </div><!--/container -->
        </div><!--/footerwrap -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/retina-1.1.0.js"></script>
        <script src="assets/js/jquery.hoverdir.js"></script>
        <script src="assets/js/jquery.hoverex.min.js"></script>
        <script src="assets/js/jquery.prettyPhoto.js"></script>
        <script src="assets/js/jquery.isotope.min.js"></script>
        <script src="assets/js/custom.js"></script>
        <script src="assets/js/jssor.min.js"></script>
        <script>
// Portfolio
(function ($) {
    "use strict";
    var $container = $('.portfolio'),
            $items = $container.find('.portfolio-item'),
            portfolioLayout = 'fitRows';

    $(window).scroll(function() {
        if ($(document).scrollTop() > 50) {
          $('.navbar').addClass('shrink');
        } else {
          $('.navbar').removeClass('shrink');
        }
      });
    if ($container.hasClass('portfolio-centered')) {
        portfolioLayout = 'masonry';
    }

    $container.isotope({
        filter: '*',
        animationEngine: 'best-available',
        layoutMode: portfolioLayout,
        animationOptions: {
            duration: 750,
            easing: 'linear',
            queue: false
        },
        masonry: {
        }
    }, refreshWaypoints());

    function refreshWaypoints() {
        setTimeout(function () {
        }, 1000);
    }

    $('nav.portfolio-filter ul a').on('click', function () {
        var selector = $(this).attr('data-filter');
        $container.isotope({filter: selector}, refreshWaypoints());
        $('nav.portfolio-filter ul a').removeClass('active');
        $(this).addClass('active');
        return false;
    });

    function getColumnNumber() {
        var winWidth = $(window).width(),
                columnNumber = 1;

        if (winWidth > 1200) {
            columnNumber = 5;
        } else if (winWidth > 950) {
            columnNumber = 4;
        } else if (winWidth > 600) {
            columnNumber = 3;
        } else if (winWidth > 400) {
            columnNumber = 2;
        } else if (winWidth > 250) {
            columnNumber = 1;
        }
        return columnNumber;
    }

    function setColumns() {
        var winWidth = $(window).width(),
                columnNumber = getColumnNumber(),
                itemWidth = Math.floor(winWidth / columnNumber);

        $container.find('.portfolio-item').each(function () {
            $(this).css({
                width: itemWidth + 'px'
            });
        });
    }

    function setPortfolio() {
        setColumns();
        $container.isotope('reLayout');
    }

    $container.imagesLoaded(function () {
        setPortfolio();
    });

    $(window).on('resize', function () {
        setPortfolio();
    });
})(jQuery);
        </script>
        @yield('js')
    </body>
</html>
