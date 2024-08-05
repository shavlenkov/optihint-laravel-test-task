@if(Session::get('message'))
    <div class="alert {{ Session::get('class') }}" role="alert">
        {{ Session::get('message') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <br/>
@endif
