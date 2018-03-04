<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Компания | @yield('title', 'Начало')</title>

        <!-- Bootstrap -->
        <link href="/css/bootstrap.min.css" rel="stylesheet">
        <link rel="/stylesheet" href="css/font-awesome.min.css">
        <link rel="/stylesheet" href="css/animate.css">
        <link href="/css/prettyPhoto.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet" />
        @yield('css')
        <!-- =======================================================
          Theme Name: Company
          Theme URL: https://bootstrapmade.com/company-free-html-bootstrap-template/
          Author: BootstrapMade
          Author URL: https://bootstrapmade.com
        ======================================================= -->
    </head>

    <body>
        @php $settings = json_decode(Storage::get('settings.json')); @endphp
        <header>
            <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
                <div class="navigation">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse.collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <div class="navbar-brand">
                                <a href="{{ route('index') }}"><h1><span>Ком</span>пания</h1></a>
                            </div>
                        </div>

                        <div class="navbar-collapse collapse">
                            <div class="menu">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation"><a href="{{ route('index') }}">Начало</a></li>
                                    <li role="presentation"><a href="{{ route('about') }}">За нас</a></li>
                                    <li role="presentation"><a href="{{ route('services') }}">Услуги</a></li>
                                    <li role="presentation"><a href="{{ route('activities') }}">Дейности</a></li>
                                    <li role="presentation"><a href="{{ route('projects') }}">Клиенти</a></li>
                                    <li role="presentation"><a href="{{ route('contacts') }}">Контакти</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        @if(Request::url() !== route('index'))
        <div id="breadcrumb">
            <div class="container">
                <div class="breadcrumb hi-icon-wrap hi-icon-effect wow fadeInLeft" data-wow-duration="1000ms" data-wow-delay="300ms">
                    <li><a href="{{ route('index') }}">Начало</a></li>
                    <li>@yield('route')</li>
                </div>
            </div>
        </div>
        @endif

        @yield('content')

        <footer>
            <div class="footer border-top">
                <div class="container">
                <div class="row">
                    <div class="col-md-4 col-lg-4 col-xl-3 border-bottom">
                        <img class="company-logo" src="{{ asset('/assets/img/logo_agronom1.svg') }}" alt="Лого"/>
                        <div class="hline-w"></div>
                        <h6 class="text-uppercase font-weight-bold"><strong>Информация</strong></h6>
                        
                        <p>{{ $settings->info }}</p>
                    </div>
                    <div class="col-md-4 col-lg-4 col-xl-3 border-right border-bottom">
                        <h6 class="text-uppercase font-weight-bold"><strong>Връзки</strong></h6>
                        <div class="hline-w"></div>
                        <p><a href="{{ route('services') }}"><i class="fa fa-wrench"></i>Услуги</a></p>
                        <p><a href="{{ route('activities') }}"><i class="fa fa-suitcase"></i>Дейности</a></p>
                        <p><a href="{{ route('projects') }}"><i class="fa fa-dashboard"></i>Проекти</a></p>
                        <p><a href="{{ route('about') }}"><i class="fa fa-info"></i>За нас</a></p>
                        <p><a href="{{ route('contacts') }}"><i class="fa fa-phone"></i>Контакти</a></p>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 border-right">
                        <h6 class="text-uppercase font-weight-bold"><strong>Адрес</strong></h6>
                        <div class="hline-w"></div>
                        <p>
                            <i class="fa fa-map-marker"></i>{{ $settings->street }}, {{ $settings->number }},<br/>
                            {{ $settings->zip_code }}, {{ $settings->residense }},<br/>
                            {{ $settings->country }}.<br/>
                        </p>
                    </div>
                </div>
                <div class="pull-right">
                    <a href="#home" class="scrollup"><i class="fa fa-angle-up fa-3x"></i></a>
                </div>
            </div>
            </div>
            <div class="col-md-12 sunshine border-top border-bottom">
                <div class="col-md-6 col-md-offset-3">
                    <div class="copyright">
                        <p>&copy; Developed by <strong>Veselin Tsvetanov</strong>&copy; Original design -
                            Company Theme. All Rights Reserved.</p>
                        <div class="credits">
                            <!--
                              All the links in the footer should remain intact.
                              You can delete the links only if you purchased the pro version.
                              Licensing information: https://bootstrapmade.com/license/
                              Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/buy/?theme=Company
                            -->
                            <a href="https://bootstrapmade.com/bootstrap-business-templates/">Bootstrap Business Templates</a> by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
      <!--/.Footer-->


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="/js/jquery-2.1.1.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/jquery.prettyPhoto.js"></script>
        <script src="/js/jquery.isotope.min.js"></script>
        <script src="/js/wow.min.js"></script>
        <script src="/js/functions.js"></script>
        @yield('js')
    </body>

</html>