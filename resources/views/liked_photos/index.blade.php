@extends('layouts.app')

@section('content')

    <h1>Liked Photos</h1>

    @if (count($likedPhotos) > 0)
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($likedPhotos as $photo)
                <div class="col">
                    <div class="shadow">
                        <div class="card">
                            <img src="{{ asset('storage/albums/' . $photo->album->id . '/' . $photo->photo) }}" height="250px" class="card-img-top" alt="photo Image">
                            <div class="card-body">
                                <h5 class="card-title">{{ $photo->title }}</h5>
                                <p class="card-text">{{ $photo->description }}</p>
                                <form id="like-form-{{ $photo->id }}" method="POST" action="{{ route('likes.toggle', $photo->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm card-text float-end">❤</button>
                                </form>
                                <a href="{{ route('photos.show', $photo->id) }}" class="btn btn-primary float-start">View</a>
                            </div>
                            <!-- Form Komentar -->
                            <form class="card-footer" method="POST" action="{{ route('comments.store', $photo->id) }}">
                                @csrf
                                <div class="input-group">
                                    <textarea name="content" class="form-control" rows="3" placeholder="Add a comment"></textarea>
                                    <button type="submit" class="btn btn-success">Comment</button>
                                </div>
                            </form>
                            <!-- Daftar Komentar -->
                            <div class="list-group list-group-flush">
                                @foreach ($photo->photoComments as $comment)
                                    <div class="list-group-item">
                                        <h6 class="list-group-item-heading"><strong>{{ $comment->user->name }}</strong> <span class="text-muted ms-2">{{ $comment->created_at->diffForHumans() }}</span></h6>
                                        <p class="list-group-item-text">{{ $comment->content }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p>No liked photos found.</p>
    @endif

@endsection
