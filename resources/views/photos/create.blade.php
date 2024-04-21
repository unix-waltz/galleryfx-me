@extends('layouts.app')

@section('content')
<div class="content-wrapper">
  <div class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
              <div class="col-sm-6">
                @if ($errors->any())
                  @foreach ($errors->all() as $e )
                    {{$e}}
                  @endforeach
                @endif
                  <h1>Upload Photo</h1>
              </div>
          </div>
      </div>
  </div>

  <section class="content">
      <div class="container-fluid">
           <!-- Center the content horizontally -->
              <div class="col-md-8"> <!-- Adjust the column width as needed -->
                          <form action="{{route('photos.store')}}" method="POST" enctype="multipart/form-data">
                              @csrf
                              @method('post')
                              <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" id="title" placeholder="title">
                              </div>
                              <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description">
                              </div>
                              <div class="mb-3">
                                  <label for="photo" class="form-label">Photo</label>
                                  <input type="file" class="form-control" id="photo" name="photo">
                                </div>
                                <input type="hidden" name="album_id" value="{{$album_id}}">
                              <button type="submit" class="btn btn-primary">Submit</button>
                          </form>
              </div>
          </div>
      </div>
  </section>

@endsection
