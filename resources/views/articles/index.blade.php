@extends('layouts.app')

@section('title', 'Блог')

@section('content')
    @include('components.alert')

    <div class="d-flex justify-content-between align-items-center my-4">
        @can('create', new \App\Models\Article())
            <a class="btn btn-success" href="{{ route('articles.create') }}">Створити статтю</a>
            <br><br>
        @endcan

        @if(Auth::check())
            <div class="d-flex">
                <div><b>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</b></div>
                <div class="mx-4"><a href="{{ route('get.signout') }}">Вийти</a></div>
            </div>
        @endif
    </div>
    <div class="container mt-5">
        <h1 class="mb-4">Список статей</h1>
        <div class="d-flex justify-content-end mb-3">
            <button id="sortBtn" class="btn btn-secondary">
                Сортувати за датою публікації  <i class="fa fa-sort"></i>
            </button>
        </div>
        <div class="row" id="articlesContainer">
            @foreach($articles as $article)
                    <div class="card mb-3" data-created-at="{{ $article->created_at }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $article->title }}</h5>
                            <p class="card-text">{{ $article->subtitle }}</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <a href="{{ route('show', $article->slug) }}" class="btn btn-primary">Читати далі</a>
                                <div class="d-flex">
                                    @can('update', new \App\Models\Article())
                                    <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-warning btn-sm d-flex align-items-center justify-content-center p-3">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    @endcan
                                    @can('delete', new \App\Models\Article())
                                    <form class="ms-2" method="POST" action="{{ route('articles.destroy', $article->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center justify-content-center p-3">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $articles->links('vendor.pagination.custom-pagination') }}
    </div>
@endsection

@section('script')
    <script>
        let ascending = false;

        document.getElementById('sortBtn').addEventListener('click', function() {
            let container = document.getElementById('articlesContainer');
            let cards = Array.from(container.getElementsByClassName('card'));

            cards.sort((a, b) => {
                let dateA = new Date(a.getAttribute('data-created-at'));
                let dateB = new Date(b.getAttribute('data-created-at'));
                return ascending ? dateA - dateB : dateB - dateA;
            });

            cards.forEach(card => container.appendChild(card));

            ascending = !ascending;
            this.innerHTML = ascending ?
                'Сортувати за зростанням <i class="fa fa-sort-asc"></i>' :
                'Сортувати за спаданням <i class="fa fa-sort-desc"></i>';
        });
    </script>
@endsection
