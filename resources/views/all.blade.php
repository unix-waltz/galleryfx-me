@extends('layouts.app')

@section('content')

<div class="content-wrapper">
<div class="container">
<br><br>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($albums as $album)
        <a href="{{route('albums.show' , $album->id)}}" class="col-md-4 text-dark">
            <div class="card card-primary shadow">
                <div class="card-body p-0">
                    <img src="/storage/album_covers/{{$album->cover_image}}" style="height: 300px; width: 100%; object-fit: cover;" class="card-img-top" alt="Album Image">
                    <div class="card-body">
                    <h5 class="card-title">{{$album->name}}</h5>
                    <p class="card-text">{{$album->description}}</p>
                    <div class="d-flex justify-content-between align-items-center">
                      
                        <form method="POST" action="{{ route('albums.destroy', $album->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-dark btn-sm">Hapus</button>
                        </form>

                    </div>
                    </div>

                </div>
            </div>
        </a>
        @endforeach
    </div>




    <div class="d-flex justify-content-between mt-4">
        <p>Showing {{ $albums->firstItem() }} - {{ $albums->lastItem() }} of {{ $albums->total() }} results</p>
        {{ $albums->links('pagination::bootstrap-4') }}
    </div>


</div>
</div>
@endsection
