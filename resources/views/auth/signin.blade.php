@extends('layouts.app')

@section('title', 'Блог - Sign In')

@section('content')
    <div class="row">
        <div class="col-md-8 col-lg-6 col-xl-4 mx-auto mt-4">
            <h3 class="text-center">Sign In</h3>
            <form method="POST" action="{{ route('post.signin') }}">
                @csrf
                <div class="mb-4">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" value="{{ old('email') }}" name="email" id="email"/>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password"/>
                </div>

                <button type="submit" class="btn btn-primary">Sign in</button>
            </form>
        </div>
    </div>
@endsection
