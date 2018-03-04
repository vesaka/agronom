<div class="col-md-12">
    <div class="img-container">
        <img id="image" src="{{ isset($model->id) ? "/assets/img/$entity/original/$model->filename" : '/assets/img/portfolio/portfolio_01.jpg' }}" alt="{{ $model->name or null }}">
    </div>
</div>
<div class="col-md-12 text-center controls">
    <div class="btn-group">
        <button type="button" class="btn btn-primary" data-method="reset" title="Нулиране">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="$().cropper(&quot;reset&quot;)">
                <span class="fa fa-refresh"></span>&nbsp;Нулиране
            </span>
        </button>
        <label class="btn btn-primary btn-upload" for="inputImage" title="Качване на изображение">
            <input type="file" class="sr-only" id="inputImage" name="image" accept=".jpg,.jpeg,.png,.gif,.bmp,.tiff">
            <span class="docs-tooltip" data-toggle="tooltip" data-animation="false" title="">
                <span class="fa fa-upload"></span>&nbsp;Разглеждане...
            </span>
        </label>
    </div>
</div>

