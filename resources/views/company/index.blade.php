@extends('company.app')
@section('content')
<section id="main-slider" class="no-margin">
    <div class="carousel slide">
        <div class="carousel-inner">
            <div class="item active" style="background-image: url(assets/img/trucks.jpg)">
                <div class="container">
                    <div class="row slide-margin">
                        <div class="col-sm-6">
                            <div class="carousel-content">
                                <h2 class="animation animated-item-1">Добре дошли <span>Company</span></h2>
                                <p class="animation animated-item-2">Accusantium doloremque laudantium totam rem aperiam, eaque ipsa...</p>
                                <a class="btn-slide animation animated-item-3" href="{{ route('about') }}">Научете повече</a>
                            </div>
                        </div>

                        <div class="col-sm-6 hidden-xs animation animated-item-4">
                            <div class="slider-img">
                                <img src="images/slider/img3.png" class="img-responsive">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--/.item-->
        </div>
        <!--/.carousel-inner-->
    </div>
    <!--/.carousel-->
</section>
<!--/#main-slider-->

<div class="feature">
    <div class="container">
        <div class="text-center">
            @foreach($services as $service)
            <div class="col-md-3">
                <div class="hi-icon-wrap hi-icon-effect wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                    {{ HTML::image('assets/img/service/' . $service->filename, $service->name, ['class' => 'presentation-image']) }}
                    <h2><a href="{{ route('guest.view', ['услуги', $service->slug]) }}">{{ $service->name }}</a></h2>
                    <p>{{ substr($service->description, 0, 100) . '...' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="border-top"></div>
    <div class="text-center cta-link">
        <a href="{{ route('services') }}" class="btn btn-primary">Повече за нашите услуги</a>
    </div>

   </div>
        <div class="cta"></div>
        <hr/>
        <div class="about">
            <div class="container">
                <h2 class="text-center">За нас</h2>
                <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
        
                <img src="{{ asset('/assets/img/tractor-on-farm.jpg') }}" class="img-responsive" />
            </div>

            <div class="col-md-6 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
                <h2>Template built with Twitter Bootstrap</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero,
                    pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
                    libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
                </p>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus interdum erat libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque
                    libero, pulvinar tincidunt leo consectetur eget. Curabitur lacinia pellentesque </p>
            </div>
        </div>
    </div>

    <div class="lates">
        <div class="container">
            <div class="text-center">
                <h2>Дейности</h2>
            </div>
            @foreach($activities as $activity)
            <div class="col-md-4 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
                {{ HTML::image('assets/img/activity/' . $activity->filename, $activity->name, ['class' => 'presentation-image']) }}
                <h3><a href="{{ route('guest.view', ['дейности', $activity->slug]) }}">{{ $activity->name }}</a></h3>

                <p>{{ substr($activity->description, 0, 100) }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <section id="partner">
        <div class="container">
            <div class="center wow fadeInDown">
                <h2>Our Partners</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut <br> et dolore magna aliqua. Ut enim ad minim veniam</p>
            </div>

            <div class="partners">
                <ul>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms" src="images/partners/partner1.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms" src="images/partners/partner2.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="900ms" src="images/partners/partner3.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1200ms" src="images/partners/partner4.png"></a></li>
                    <li> <a href="#"><img class="img-responsive wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="1500ms" src="images/partners/partner5.png"></a></li>
                </ul>
            </div>
        </div>
        <!--/.container-->
    </section>
    <!--/#partner-->

    @endsection