@extends('layouts.layout')

<div class="container mt-5">
    @section('content')

        <form method="get" action="{{ route('post.index') }}">
            <div class="mb-3">
                <label for="body" class="form-label">Поиск постов по комментариям</label>
                <input type="text" class="form-control" name="body" value="{{ old("body", request()->body) }}">
            </div>
            <button type="submit" class="btn btn-primary">Поиск</button>
        </form>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <ol class="list-group list-group-numbered">
            @foreach($posts as $number => $post)

                <li class="list-group-item d-flex justify-content-between align-items-start" style="margin-top: 40px">
                    <div class="ms-2 me-auto" style=" min-width: 40%">
                        <div class="fw-bold">{{ $post->title}}</div>
                        <p>{{ $post->body }}</p>
                    </div>

                    <div style="margin-left: 50px;  min-width: 55%">
                        <div class="fw-bold">Комментарии</div>
                        <ul class="list-group list-group-flush">
                            @foreach($post->comments as $comment)
                                <li class="list-group-item">
                                    <span class="fw-bold">{{$comment->name}} : {{$comment->email}}</span>
                                    <p>{{$comment->body}}</p>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>



            @endforeach
        </ol>
</div>

@endsection
