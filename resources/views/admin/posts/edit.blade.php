@extends('layouts.app')

@section('content')
    <form method="post" action="{{ route('admin.posts.update', ['post' => $post]) }}">
        @csrf
        <div class="mb-3">
            <label for="slug" class="form-label">Prezzo</label>
            <input type="number" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug"  value="{{ old('slug') }}">
            @error('slug')
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->get('slug') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Città</label>
            <input type="text" class="form-control @error('city') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">
                    <ul>
                        @foreach ($errors->get('title') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
