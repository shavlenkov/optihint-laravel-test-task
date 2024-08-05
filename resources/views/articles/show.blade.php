@extends('layouts.app')

@section('title', $article->title)

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="text-start" style="max-width: 800px; width: 100%;">
            <div class="article__title"><h1>{{ $article->title }}</h1></div>
            <div class="article__subtitle"><h3>{{ $article->subtitle }}</h3></div>
            <div class="article__date my-3">Дата публікації: <i>{{ explode(" ", $article->created_at)[0] }}</i></div>
            <div class="article__text">{!! $article->text !!}</div>
        </div>
    </div>
@endsection
