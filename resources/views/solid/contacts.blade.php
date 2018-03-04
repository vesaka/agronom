@extends('solid.app')
@section('title')
Контакти |
@stop
@section('css')
@stop
@section('body')

<!-- *****************************************************************************************************************
 CONTACT FORMS
 ***************************************************************************************************************** -->

<div class="container mtb">
    <div class="row">
        <div id="contactwrap"></div>
        <div class="col-lg-8">
            <h4>Свържете се с нас!</h4>
            <div class="hline"></div>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
            <form action="{{ route('post.message') }}" method="POST" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">Вашето име</label>
                    <input type="text" class="form-control" id="name" name="name">
                    <p class="error" bind="name"></p>
                </div>
                <div class="form-group">
                    <label for="email">Електронна поща</label>
                    <input type="email" class="form-control" id="email" name="email">
                    <p class="error" bind="email"></p>
                </div>
                <div class="form-group">
                    <label for="subject">Тема</label>
                    <input type="text" class="form-control" id="subject" name="subject">
                    <p class="error" bind="subject"></p>
                </div>
                <div class="form-group">
                    <label for="text">Текст</label>
                    <textarea class="form-control" id="text" rows="3" name="text"></textarea>
                    <p class="error" bind="text"></p>
                </div>
                <button type="submit" class="btn btn-theme">Изпращане</button>
            </form>
        </div><! --/col-lg-8 -->

        <div class="col-lg-4">
            <h4>Нашият Адрес</h4>
            <div class="hline"></div>
            @php $settings = json_decode(Storage::get('settings.json')) @endphp
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
    </div><! --/row -->
</div><! --/container -->
@stop
@section('js')
<script src="/assets/js/validator.js"></script>
<script>

    document.querySelector('[role=form]').validator({
//        name: [
//            ['required', 'Посочете вашето име'],
//            ['minLength:3', 'Името трябва да е поне три букви'],
//            ['maxLength:30', 'Името не трябва да е по-дълго от 30 символа']
//        ],
//        email: [
//            ['required', 'Посочете имейл адрес'],
//            ['regexp:email', 'Посочете валиден имейл адрес']
//        ],
//        subject: [
//            ['required', 'Задайте тема на вашето запитване']
//        ],
//        text: [
//            ['required', 'Моля, попълнете вашето запитване към нас']
//            ['maxLength:1500', 'Моля, попълнете вашето запитване към нас']
//        ]
    }, {
        submitHandler: function(e) {
            e.preventDefault();
            var form = $(e.target);

            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
            }).done(function(response) {
                console.log(response);
            }).fail(function(response, a, b) {
                console.log(response.status, a, b );
            })

        },
        errorPlacement: function(el, msg) {
            var errorBox = document.querySelector('[role="' + el.name + '"]');
            errorBox.innerHTML = msg;
        }
    });
    var initMap = function () {
        var map, marker = null, position = {!! $settings->lat_lng !!};
        map = new google.maps.Map(document.getElementById('contactwrap'), {
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

@stop
