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
        <p>Разполагаме със собствени превозни средства за транспорт.</p>
        <p>Ние разполагаме с различни по обем и тонаж камиони, които са необходими за всеки тип строеж.</p>
        <p>Ние се стреми да предложи на клиентите си лесно, бързо и качествено обслужване във всеки един от отраслите си.</p>
        <p>Фирмата притежава гама от строителна механизация, необходима за всеки строеж.</p>
      </div>
      <div class="col-md-5 wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="600ms">
        <div class="skill">
          <div class="progress-wrap">
            <h3>Осигураваме Перфектна услуга за Вашите нужди</h3>
            <div class="progress">
              <div class="progress-bar  color1" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                <span class="bar-width">100%</span>
              </div>

            </div>
          </div>

          <div class="progress-wrap">
            <h4>Квалифициран и опитен персонал</h4>
            <div class="progress">
              <div class="progress-bar color2" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                <span class="bar-width">100%</span>
              </div>
            </div>
          </div>

          <div class="progress-wrap">
            <h4>Модерна и сигурна техника</h4>
            <div class="progress">
              <div class="progress-bar color3" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                <span class="bar-width">100%</span>
              </div>
            </div>
          </div>

          <div class="progress-wrap">
            <h4>Бърза реакция</h4>
            <div class="progress">
              <div class="progress-bar color4" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                <span class="bar-width">100%</span>
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