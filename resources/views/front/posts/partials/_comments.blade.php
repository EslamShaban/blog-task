@foreach ($comments as $comment)
    <div class="comment">
        <div class="image">
            <img src="{{ $comment->user->image}}" alt="post-image" style="width:50px;height:50px; border-radius:50%">
        </div>
        <div class="comment-info">
            <b>{{ $comment->user->name }}</b>
            <span>{{ $comment->created_at->diffForHumans() }}</span>
            <p>{{ $comment->comment}}</p>
        </div>
    </div>
@endforeach
