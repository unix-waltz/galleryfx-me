@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gallery</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/album">Home</a></li>
                        <li class="breadcrumb-item active">Gallery</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-end">
                <div class="col-md-6">
                    <div class="d-grid gap-2">
                        <a class="btn btn-dark float-right" href="/albums/create">
                            <i class="fas fa-plus mr-1"></i> Buat Album Baru
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
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
                                    <button type="submit" class="btn btn-sm btn-dark">Hapus</button>
                                </form>

                            </div>
                            </div>

                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-between mt-4">
            <p>Showing {{ $albums->firstItem() }} - {{ $albums->lastItem() }} of {{ $albums->total() }} results</p>
            {{ $albums->links('pagination::bootstrap-4') }}
        </div>
    </section>
    <!-- /.content -->

    <!-- Buat Album Baru -->
   
    <!-- /.content -->
</div>

@endsection
