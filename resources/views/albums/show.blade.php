@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Section Header -->
    <section class="py-5 text-center container">
        <div class="row py-lg-5 shad">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">{{$album->name}}</h1>
                <p class="lead text-muted">{{$album->description}}</p>
                <p>
                    <a href="/photo/upload/{{$album->id}}" class="btn btn-dark my-2">Upload Photo</a>
                    <a href="/albums" class="btn btn-secondary my-2">Back</a>
                </p>
            </div>
        </div>
    </section>
<div class="container">
    <!-- Photo Gallery -->
    @if (count($album->photos) > 0)
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($album->photos as $photo)
        
        <div class="col text-dark">
            <div class="shadow">
                <div class="card">
                    <!-- Photo -->
                    <a href="{{route('photos.show' , $photo->id)}}" class=" text-dark">
                        <div class="">
                    <img src="/storage/albums/{{$album->id}}/{{$photo->photo}}" height="250px" class="card-img-top" alt="photo Image">
                    <form class="" id="like-form-{{$photo->id}}" method="POST" action="{{ route('likes.toggle', $photo->id) }}" style="
                     width: 90px;
        height: 30px;
        color: white;
        position: relative;
        top: -35px;
        padding-left: 10px;
        font-size: 20px;
                    ">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm card-text float-end">❤</button>
                    </form></div>
                    <div class="card-body pt-0">
                        <h5 class="card-title">{{$photo->title}}</h5>
                        <p class="card-text">{{$photo->description}}</p>
                    </div>
                    </a>
                    <div class="container">
                        <p>

                            <button data-toggle="collapse" data-target="#collapseExample{{$photo->id}}" aria-expanded="false" aria-controls="collapseExample" type="button" class="btn btn-sm btn-light position-relative">
                                See All Coments
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                 {{$photo->photoComments->count()}}
                                  <span class="visually-hidden">comments</span>
                                </span>
                              </button>
                          </p>
                          <div class="collapse" id="collapseExample{{$photo->id}}">
                            <div class="card card-body p-0">
                               <!-- Comment Form -->
                    <form class="card-footer" method="POST" action="{{ route('comments.store', $photo->id) }}">
                        @csrf
                        <div class="input-group">
                            <textarea name="content" class="form-control p-0" rows="3" placeholder="Add a comment"></textarea>
                            <button type="submit" class="btn btn-dark btn-sm">Comment</button>
                        </div>



                    </form>
                    <!-- Comment List -->
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
                   
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <p>No photos to display</p>
    @endif
</div>
</div>
@endsection

@section('scripts')
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Saat dokumen dimuat, periksa apakah pengguna telah memberikan "like" pada setiap foto
        @foreach($album->photos as $photo)
        $.ajax({
            url: "{{ route('likes.check', $photo->id) }}",
            type: "GET",
            success: function(response) {
                if (response.liked) {
                    // Jika sudah dilike, sembunyikan tombol Like
                    $('#like-form-{{$photo->id}}').hide();
                }
            }
        });
        @endforeach

        // Event handler untuk form Like
        $('form[id^="like-form"]').submit(function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir secara default
            var form = $(this);
            var url = form.attr('action');

            // Kirim permintaan AJAX
            $.ajax({
                url: url,
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    // Tampilkan pesan dari respons
                    alert(response.message);

                    // Perbarui tampilan tombol
                    form.hide();
                    form.siblings('.unlike-form').show();
                },
                error: function(xhr) {
                    // Tangani kesalahan
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });

        // Event handler untuk form Unlike
        $('form[id^="unlike-form"]').submit(function(event) {
            event.preventDefault(); // Mencegah pengiriman formulir secara default
            var form = $(this);
            var url = form.attr('action');

            // Kirim permintaan AJAX
            $.ajax({
                url: url,
                type: 'DELETE',
                data: form.serialize(),
                success: function(response) {
                    // Tampilkan pesan dari respons
                    alert(response.message);

                    // Perbarui tampilan tombol
                    form.hide();
                    form.siblings('.like-form').show();
                },
                error: function(xhr) {
                    // Tangani kesalahan
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    });
</script>
@endsection
