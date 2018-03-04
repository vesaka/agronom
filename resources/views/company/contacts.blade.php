@extends('company.app')
@section('css')
<link rel="stylesheet" href="{{ asset('/assets/css/contacts.css') }}"/>
@endsection
@section('title', 'Контакти')
@section('route', 'Контакти')
@section('content')
<div class="map">
    @php $settings = json_decode(Storage::get('settings.json')) @endphp
    <div id="google-map"></div>
</div>
<section id="contact-page">
    <div class="container">
        <div class="center">
            <h2>Искате да се свържете с нас?</h2>
            <p>Ако имате въпрос или се интересувате от нашите услуги, пратете своето запитване във формата по-долу</p>
        </div>
    <!--/.container-->
</section>
<!--/#contact-page-->

<div class="container mtb">
    <div class="row">
        <div id="contactwrap sunshine">
        <div class="col-lg-8">
            <div class="hline"></div>
            <form action="{{ route('post.message') }}" method="POST" role="form">
                {{ csrf_field() }}
                {!! Honeypot::generate('user_name', 'stamp') !!}
                <div class="form-group">
                    <label for="name">Вашето име</label>
                    <input type="text" class="form-control" id="name" name="name">
                    <p class="error" role="name"></p>
                </div>
                <div class="form-group">
                    <label for="email">Електронна поща</label>
                    <input type="email" class="form-control" id="email" name="email">
                    <p class="error" role="email"></p>
                </div>
                <div class="form-group">
                    <label for="subject">Тема</label>
                    <input type="text" class="form-control" id="subject" name="subject">
                    <p class="error" role="subject"></p>
                </div>
                <div class="form-group">
                    <label for="text">Текст</label>
                    <textarea class="form-control" id="text" rows="3" name="text"></textarea>
                    <p class="error" role="text"></p>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Изпращане</button>
                    <p id="guest" class="error" role="guest"></p>
                    <p id="stamp" class="error" role="stamp"></p>
                    <h4 id="success" class="bg-info text-center"></h4>
                </div>
            </form>
            <div id="test" style="color: black"></div>
        </div><! --/col-lg-8 -->

        <div class="col-lg-4">
            <h4>Нашият Адрес</h4>
            <div class="hline"></div>
            <p>
                {{ $settings->street}}, {{ $settings->number}},<br/>
                {{ $settings->zip_code}}, {{ $settings->residense}},<br/>
                {{ $settings->country}}.<br/>
            </p>
            <p>
                Ел. поща:{{ $settings->email}}<br/>
                Тел.: {{ $settings->phone}}
            </p>
            <p>{{ $settings->info}}</p>
        </div>
        </div>
    </div><! --/row -->
</div><! --/container -->
@stop
@section('js')
<script src="/assets/js/validator.js"></script>
<script>
    document.querySelector('[role=form]').validator({
        name: [
            ['required', 'Посочете вашето име'],
            ['minLength:3', 'Името трябва да е поне три букви'],
            ['maxLength:30', 'Името не трябва да е по-дълго от 30 символа']
        ],
        email: [
            ['required', 'Посочете имейл адрес'],
            ['regexp:email', 'Посочете валиден имейл адрес']
        ],
        subject: [
            ['required', 'Задайте тема на вашето запитване']
        ],
        text: [
            ['required', 'Моля, попълнете вашето запитване към нас'],
            ['maxLength:1500', 'Запитването ви е прекалено дълго. Не трябва да е повече от 1500']
        ]
    }, {
        submitHandler: function(e) {
            e.preventDefault();
            var form = $(e.target);

            $.ajax({
                url: form.attr('action'),
                method: 'POST',
                data: form.serialize(),
            }).done(function(response) {
                $('#success').html(response.message);
            }).fail(function(response, a, b) {
                var data = JSON.parse(response.responseText);
                for(var name in data.errors) {
                    var errorWrapper = $('p.error[role="' + name + '"]');
                    if(null !== errorWrapper) {
                        errorWrapper.html(data.errors[name][0]);
                    } else {
                        $('<p class="error">' + data.errors[name][0] + '</p>').insertAfter('input[name="' + name + '"]');
                    }
                }
                
                //window.location.href('{{ route("index") }}');
            });
            
            return false;

        }
    });
    var initMap = function () {
        var map, marker = null, position = {!! $settings->lat_lng !!};
        map = new google.maps.Map(document.getElementById('google-map'), {
            center: position,
            zoom: 12
        });

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(position.lat, position.lng),
            map: map,
            title: ''
        });
    };
</script>
<script src="{{ 'https://maps.googleapis.com/maps/api/js?key=' . env('GOOGLE_MAP_API_KEY') . '&callback=initMap' }}" async defer></script>

@endsection