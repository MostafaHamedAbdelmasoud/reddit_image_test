@extends('layouts.app')

@section('content')
    <div class="container text-center">

        <div class="row">
            @forelse($reddit_images as $reddit_image)
                <div class="col-md-4 text-center py-4">
                    <a href="{{$reddit_image->url}}">
                        <img class="rounded-circle" src="{{$reddit_image->url}}" width="140"
                             height="140">
                    </a>
                    <h6 class="py-2">{{ \Illuminate\Support\Str::limit($reddit_image->title, 50, $end='...') }}
                        ....</h6>
                    <p><a class="btn btn-secondary" href="{{$reddit_image->url}}" role="button">View image &raquo;</a>
                    </p>
                </div><!-- /.col-lg-4 -->

            @empty
            @endforelse



        </div>
            {!! $reddit_images->render() !!}
    </div>
@endsection
