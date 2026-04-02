@if (session('status'))
    <div class="flash-success">
        {{ session('status') }}
    </div>
@endif

@if ($errors->any())
    <div class="flash-error">
        {{ $errors->first() }}
    </div>
@endif
