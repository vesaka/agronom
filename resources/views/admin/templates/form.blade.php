
@section('title')
{{ $title }}
@stop

@section('content_header')
<h1>{{ $title }}</h1>
@stop
@section('content')
<div class="row">
    <form action="{{ isset($model->id) ? route("admin.$entity.update", [$model->id]) : route("admin.$entity.store") }}" method="POST" role="form" enctype="multipart/form-data">
        {!! csrf_field() !!}
        <div class="form-group">
                <button type="submit"  role="submit" class="btn btn-primary">Запазване</button>
                <span></span>
            </div>
        <div class="col-md-7">
            <div class="form-group">
                <label>Качване на снимка</label>
                @include('admin.templates.cropper')
                <input name="crop_data" type="hidden" value="{{ $model->crop_data or ''}}" readonly>
            </div>
            <div class="form-group">
                <label for="title">Наименование:</label>
                <input id="title" class="form-control" name="title" type="text" value="{{ $model->name or null}}"/>
            </div>
            <div class="form-group">
                <label for="comment">Описание:</label>
                <textarea class="form-control" rows="5" name="description">{{ $model->description or Lipsum::medium()->text(5)}}</textarea>
            </div>
            <div class="form-group">
                <button type="submit" role="submit" class="btn btn-primary">Запазване</button>
                <span></span>
            </div>
        </div>
        <div id="response" class="md-5"></div>
    </form>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="/assets/libs/cropper/cropper.min.css">
<style>
    #image {
        height: 300px;
        max-width: 100%;
    }
    .has-error {
        color: red
    }
    .wrapper {
        width: 100%;
        min-height: 100%;
        height: auto !important;
        position: absolute;
    }
</style>
@stop

@section('js')
<script src="/assets/js/validator.js"></script>
<script src="/assets/libs/cropper/cropper.min.js"></script>
<script src="/assets/js/cropper.js"></script>
<script src="/assets/js/admin.js"></script>
<script>
document.querySelector('[role=form]').validator({
    image: [
        ['fileRequired', 'Няма качена снимка'],
        ['hasExtension:jpg,png,jpeg', 'Невалиден файл формат. Разрешени са само jpg,png,jpeg'],
        ['fileMaxSize:20000000', 'Файлът е твърде голям. Максимум 20мб']
    ],
    title: [
        ['required', 'Полето е задължително'],
        ['regexp:alphaDashCyrilic', 'Позволени са само букви, цифри и пунктуационни знаци.']
    ],
    description: [
        ['required', 'Полето е задължително'],
    ]
}, {
    submitHandler: function (e) {
        e.preventDefault();
        $('[role="submit"]').next().html('<span>В процес на запазване...</span>');
        $.post({
            url: e.target.action,
            data: new FormData(e.target),
            processData: false,
            contentType: false,
            accepts: {
                text: 'application/json; charset=utf-8'
            }
        }).done(function(a, b, c) {
            $('#response').html(a);
            $('[role="submit"]').next().html('<span>Успешно запазване</span>');
        }).fail(function(a, b, c) {
            $('[role="submit"]').next().html('');
            if(a.status === 422) {
                var errors = JSON.parse(a.responseText).errors,
                        errorBlocks = document.getElementsByClassName('has-error'),
                        content,
                        error,
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
            $('#response').html(renderException(a.responseText));
        });
        return false;
    },
    errorPlacements: {
        image: function(el, message) {
            $(el).closest('.controls')
                    .append('<div class="has-error">' + message + '</div>');
        }
    },
    classError: 'has-error'
});

(function () {
    Cropper.init({
        aspectRatio: 16 / 9,
        viewMode: 2,
        background: false,
        guides: false,
        center: false,
        highlight: false,
        rotatable: false,
        autoCropArea: 1,
        crop: function (e) {
            Cropper.refresh(e);
        }
    });
})();

</script>
@stop
