<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\CommentRepository;
use App\Events\NewCommentEvent;
use App\Models\Post;

class CommentController extends Controller
{
        
    private $commentRepository;
    
    public function __construct(CommentRepository $comment)
    {
        $this->commentRepository = $comment;
    }

    public function store(Request $request, Post $post)
    {

        $data = [
            'user_id'   => auth()->user()->id,
            'post_id'   => $post->id,
            'comment'   => $request->comment
        ];

        $this->commentRepository->create($data);
        
        $notificationMessage = auth()->user()->name . ' has add a new comment to your post';

        $post->user->notify(new \App\Notifications\SendNotification($notificationMessage));

        broadcast(new NewCommentEvent($notificationMessage, $post->user));     


        return view('front.posts.partials._comments')->with('comments', $post->comments);
    }
}
