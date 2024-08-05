@extends('layouts.app')

@section('title', 'Блог - Редагувати статтю')

@section('content')
    @include('components.alert')

    <h2>Редагувати статтю</h2>

    <form class="form-group" method="POST" action="{{ route('articles.update', $article->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <label for="title" class="form-label">Title: </label>
        <input class="form-control w-50" name="title" type="text" value="{{ $article->title }}" placeholder="Title"/><br/><br/>
        <label for="subtitle" class="form-label">Subtitle: </label>
        <input class="form-control w-50" name="subtitle" type="text" value="{{ $article->subtitle }}" placeholder="Subtitle"/><br/><br/>
        <label for="text" class="form-label">Text: </label>
        <textarea class="form-control w-50" name="text" id="editor" rows="10">{{ $article->text }}</textarea><br/><br/>
        <button type="submit" class="btn btn-success">Опублікувати</button>
        <a class="btn btn-secondary" href="{{ route('articles.index') }}">Назад</a>
    </form>
@endsection

@section('script')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                ckfinder: {
                    uploadUrl: '{{ route('ckeditor.upload').'?_token='.csrf_token() }}'
                }
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection

