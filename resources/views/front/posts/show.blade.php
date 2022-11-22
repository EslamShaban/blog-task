@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="post">
                <div class="image">
                    <img src="{{ $post->image_path }}" alt="post-image">
                </div>
                <h2 class="title">{{$post->title}}</h2>
                <p class="desc">{{$post->description}}</p>
                <hr>
                <div class="actions d-flex justify-content-around">
                    <a style="width: 100%; text-align:center;" href="{{route('posts.toggle_like', $post->id)}}" id="like-post" >
                        @if ($post->likers()->where('user_id', auth()->user()->id)->count())
                            <span style="color: blue"><i class="fas fa-thumbs-up"></i> ({{$post->likers()->count()}}) Like</span>
                        @else
                            <span><i class="fal fa-thumbs-up"></i> ({{$post->likers()->count()}}) Like </span>
                        @endif
                        
                    </a>
                    <a style="width: 100%; text-align:center; text-al" href="#comment">
                        <i class="fal fa-comment"></i> ({{$post->comments()->count()}}) comment
                    </a>         
                                        
                </div>

            </div>
            <div class="post-comments">
                <div id="post-comments">
                    @include('front.posts.partials._comments', ['comments'=> $post->comments])
                </div>
                <div class="leave-comment">
                    <h3>Leave a comment</h3>
                    <form action="{{ route('comment.store', $post->id) }}" method="POST" id="store-comment" novalidate>
                        @csrf
                        <div class="form-group">
                           <textarea id="comment" class="form-control" name="comment" rows="5" required></textarea>
                        </div>
                                                
                        <button class="btn btn-primary" type="submit">Add Comment</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
