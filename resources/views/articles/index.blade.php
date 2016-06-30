@extends('layout') @section('content')
<div class="page">
    <h1>статьи</h1>
    <div class="divider"></div>
    <div class="container">
        @if ( Request::is('articles/search*') )
            @include ('partials.search-results', ['returnUrl' => '/articles'])
        @endif
        @if (count($articles))
            @foreach ($articles as $article)
            <div class="row article">
                <div class="col-md-7">
                    <img class="img-responsive" src="{{ $article->image }}" alt="">
                </div>
                <div class="col-md-5" style="position: static">
                    <h3>{{ $article->title }}</h3>
                    <p>{{ $article->short_text }}</p>
                    <a class="btn Button Button__more--positioned" href="/articles/{{ $article->id }}">подробнее<span class="glyphicon glyphicon-chevron-right"></span></a>
                </div>
            </div>
            @endforeach
            <div class="pagination-wrapper">
            @if (!Request::is('articles/search*')) 
               {!! $articles->render() !!}
            @endif
            </div>
        @endif
    </div>
</div>
@stop
