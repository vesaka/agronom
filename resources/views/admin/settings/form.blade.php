@extends('adminlte::page')
@section('title')
Настройки
@stop
@section('css')
<style>
    #map-window {
        width: 100%;
        height: 400px;
        background-color: grey;
    }
</style>
@stop
@section('content_header')
<h1>Настройки</h1>
@stop
@section('content')
<div class="row">
    <form method="POST" action="{{ route('admin.settings.update') }}" class="col-md-12" role="form">
        <fieldset class="col-md-6">
            {!! csrf_field() !!}
            <h3>Контакти</h3>
            <div class="form-group">
                <label for="email">Електронна поща</label>
                <div>
                    <input id="email" type="text" name="email" placeholder="Електронна поща" class="form-control" value="{{ $settings->email or null}}">
                </div>
            </div>
            <div class="form-group">
                <label for="phone">Телефон</label>
                <div>
                    <input id="phone" type="text" name="phone" placeholder="Телефон" class="form-control" value="{{ $settings->phone or null}}">
                </div>
            </div>
            <h3>Адрес</h3>

            <div class="form-group">
                <label for="country">Страна</label>
                <div>
                    <input id="country" type="text" name="country" placeholder="Страна" class="form-control" value="{{ $settings->country or null}}">
                </div>
            </div>
            <div class="form-group col-md-8">
                <label for="residence">Населено място</label>
                <div>
                    <input id="residence" type="text" name="residense" placeholder="Населено място" class="form-control" value="{{ $settings->residense or null}}">
                </div>
            </div>
            <div class="form-group col-md-4">
                <label for="zip_code">Пощенски код</label>
                <div>
                    <input id="zip_code" type="text" name="zip_code" placeholder="Пощенски код" class="form-control" value="{{ $settings->zip_code or null}}">
                </div>
            </div>
            <div class="form-group col-md-8">
                <label for="street">Улица</label>
                <div>
                    <input id="street" type="text" name="street" placeholder="Улица" class="form-control" value="{{ $settings->street or null}}">
                </div>
            </div>

            <div class="form-group col-md-4">
                <label for="number">Номер</label>
                <div>
                    <input id="number" type="integer" name="number" placeholder="Номер" class="form-control" value="{{ $settings->number or null}}">
                </div>
            </div>
            <div class="form-group col-md-12">
                <label for="info">Информация</label>
                <div>
                    <textarea id="info" name="info" placeholder="Информация" class="form-control">{{ $settings->info or null}}</textarea>
                </div>
            </div>
            <div class="form-group col-md-12">
                <button class="btn btn-primary" type="submit" role="submit" name="save">Запазване</button>
                <span class="submit"></span>
            </div>
        </fieldset>

        <fieldset class="col-md-6">
            <h3>Карта</h3>
            <div id="response"></div>
            <div id="map-window"></div>
            <input id="lat_lng" type="hidden" value="" name="lat_lng">
        </fieldset>


    </form>
</div>
@stop
@section('js')
<script src="/assets/js/validator.js"></script>
<script>
    var map, marker = null, latLng,
        position = JSON.parse('{!! $settings->lat_lng or "{lat: 42.697, lng: 23.322}" !!}');

    console.log(position);

    var initMap = function () {
        map = new google.maps.Map(document.getElementById('map-window'), {
            center: new google.maps.LatLng(position.lat, position.lng),
            zoom: 10
        });

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(position.lat, position.lng),
            map: map,
            title: ''
        });

        google.maps.event.addListener(map, "click", function (e) {
            var latLng = e.latLng;

            if (null === marker) {
                marker = new google.maps.Marker({
                    position: latLng,
                    map: map,
                    title: ''
                });
            } else {
                marker.setPosition(latLng);
            }

            document.getElementById('lat_lng').value = JSON.stringify({
                lat: e.latLng.lat(),
                lng: e.latLng.lng()
            });

        });
    };

    document.querySelector('[role=form]').validator({
        email: [
            ['regexp:email', 'Невалиден имейл адрес']
        ],
        phone: [
            //['regexp:phone', 'Невалиден телефонен номер']
        ],
        country: [
            ['regexp:alphaCyrilic', 'Позволени са само букви']
        ],
        residense: [
            ['regexp:alphaCyrilic', 'Позволени са само букви']
        ],
        number: [
            ['regexp:alphaDashCyrilic', 'Позволени са само букви, цифри и тирета']
        ],
        info: [
            ['regexp:alphaDashCyrilic', 'Позволени са само букви, цифри и тирета']
        ]

    }, {
        submitHandler: function (e) {
            e.preventDefault();
            $('[role="submit"]').next().html('');
            $.post({
            url: e.target.action,
            data: new FormData(e.target),
            processData: false,
            contentType: false
        }).done(function(a, b, c) {
            $('#response').html(a);
            $('[role="submit"]').next().html('<span>Успешно запазване</span>');
        }).fail(function(a, b, c) {
            console.log(a,b,c);
            $('[role="submit"]').next().html('');
            if(a.status === 422) {
                var errors = JSON.parse(a.responseText).errors,
                        errorBlocks = document.getElementsByClassName('has-error'),
                        content,
                        input;

                while(errorBlocks.legth > 0) {
                    errorBlocks[0].remove();
                }

                for(var name in errors) {
                    input = document.getElementsByName(name)[0];
                    if (null === input) continue;
                    content = '<div class="has-error">' + errors[name][Object.keys(errors[name])[0]] + '</div>';
                    if (name === 'image') {
                        $(input).closest('controls').append(content);
                    } else {
                        $(input).after(content);
                    }
                }
            }
            $('#response').html(a.responseText);
        });
        }
    });
</script>
<script src="{{ 'https://maps.googleapis.com/maps/api/js?key=' . env('GOOGLE_MAP_API_KEY') . '&callback=initMap' }}" async defer></script>

@stop
