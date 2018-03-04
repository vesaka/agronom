@extends('company.app')
@section('css')
@endsection
@section('title', 'За нас')
@section('route', 'За нас')
@section('content')
<div class="aboutus">
    <div class="container">
      <h3>Информация за нашата компания</h3>
      <hr>
      <div class="col-md-7 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="300ms">
        <img src="images/7.jpg" class="img-responsive">
        <h4>История</h4>
        <p>Nam tempor velit sed turpis imperdiet vestibulum. In mattis leo ut sapien euismod id feugiat mauris euismod. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Phasellus id nulla risus, vel tincidunt
          turpis. Aliquam a nulla mi, placerat blandit eros. </p>
        <p>In neque lectus, lobortis a varius a, hendrerit eget dolor. Fusce scelerisque, sem ut viverra sollicitudin, est turpis blandit lacus, in pretium lectus sapien at est. Integer pretium ipsum sit amet dui feugiat vitae dapibus odio eleifend.</p>
      </div>
      <div class="col-md-5 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
        <div class="skill">
          <h2>Какво предлагаме</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

          <div class="progress-wrap">
            <h3>Graphic Design</h3>
            <div class="progress">
              <div class="progress-bar  color1" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 85%">
                <span class="bar-width">85%</span>
              </div>

            </div>
          </div>

          <div class="progress-wrap">
            <h4>HTML</h4>
            <div class="progress">
              <div class="progress-bar color2" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
                <span class="bar-width">95%</span>
              </div>
            </div>
          </div>

          <div class="progress-wrap">
            <h4>CSS</h4>
            <div class="progress">
              <div class="progress-bar color3" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                <span class="bar-width">80%</span>
              </div>
            </div>
          </div>

          <div class="progress-wrap">
            <h4>Wordpress</h4>
            <div class="progress">
              <div class="progress-bar color4" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 90%">
                <span class="bar-width">90%</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('js')
@endsection