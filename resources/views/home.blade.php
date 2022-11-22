@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            @forelse($posts as $post)
                <div class="post">
                    <div class="image">
                        <img src="{{$post->image_path}}">
                    </div>
                    <a class="title" href="{{ route('posts.show', $post->slug) }}">{{$post->title}}</a>
                    <p class="desc">{{$post->description}}</p>
                    <div class="info">
                        <span>
                            <i class="fal fa-calendar"></i>
                            {{ $post->created_at->diffForHumans() }}
                        </span>
                        <span>
                            <i class="fal fa-edit"></i>
                            {{ $post->user->name}}
                        </span>
                    </div>
                </div>
            @empty
                <div class="empty">there's no posts yet</div>
            @endforelse
        </div>
        <div class="col-md-4">
            <div class="online-users" style="background-color: #FFF">
                <h3>Online users</h3>
                <ul id="online-users-list">
                    
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
