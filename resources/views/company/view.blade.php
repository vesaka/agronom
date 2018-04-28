@extends('company.app')
@section('css')
<style>
    .feature-image {
        max-width: 160px;
    }
    .img-blog {
        max-width: 320px;
        float: left;

    }
    .view-article img {
        margin-right: 25px;
        border: 1px solid #333a56;
        border-radius: 10px;
    }
</style>
@endsection
@section('title', $entity->name)
@section('route')
<a href="{{ route($type . 's') }}">{{ trans("view.$type") }}</a> / {{ $entity->name }}
@endsection
@section('content')
<div class="row view-article" style="margin: 25px;">
    <div class="col-md-9 col-sm-10">
        <div class="blog-item">
            <div class="col-xs-12 col-sm-12">
                <img class="img-responsive img-blog" src="{{ asset("assets/img/$type/$entity->filename") }}" width="100%" alt="{{ $entity->name }}" />
                <h3>{{ $entity->name }}</h3><hr/>
                <p>{{ $entity->description }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="widget categories">
            <h3>Други {{ trans('view.' . $type) }}</h3>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    @foreach($featured as $feature)
                    @php $link = route('guest.view', [$type, $feature->slug]) @endphp

                    <div class="col-md-12">
                        <a class="single_comments" href="{{ $link }}">
                            <img src="{{ asset("assets/img/$type/$feature->filename") }}" alt="{{ $feature->name }}" class="feature-image"/>
                        </a>
                    </div>
                    <div class="col-md-12">
                        <a class="single_comments" href="{{ $link }}">
                            <h4>{{ $feature->name }}</h4>
                        </a>
                    </div>
                    <hr/>
                    @endforeach
                </div>
            </div>
        </div>
        <!--/.recent comments-->
    </div>
</div>
@endsection

@section('js')
@endsection