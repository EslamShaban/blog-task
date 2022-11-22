<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Repositories\PostRepository;
use App\Http\Requests\Front\PostRequest;
use App\Models\Post;
use App\Events\NewPostEvent;

class PostController extends Controller
{
    private $postRepository;
    
    public function __construct(PostRepository $post)
    {
        $this->middleware('auth');
        $this->postRepository = $post;
    }

    public function index()
    {
        $posts = $this->postRepository->all();
        return view('home', compact('posts'));

    }

    public function create()
    {
        return view('front.posts.create');
    }

    public function store(PostRequest $request)
    {

        $data = $request->except('_token', '_method');

        $data['user_id'] = auth()->user()->id;

        $post = $this->postRepository->create($data);
        
        if($request->has('image')){

            $this->UploadFile(['file'=>$request->image, 'path_to_save'=>'assets/uploads/posts'], $post);

        }

        $other_users = \App\Models\User::where('id', '!=', auth()->user()->id)->get();

        $notificationMessage = auth()->user()->name . ' has added new post';

        \Notification::send($other_users, new \App\Notifications\SendNotification($notificationMessage));

        broadcast(new NewPostEvent($notificationMessage))->toOthers();

        notify()->success('success', 'Post Added Successfuly');
        return redirect(url('/'));
    
    }

    public function show($slug)
    {
        $post = $this->postRepository->findBy('slug', $slug);
        return view('front.posts.show', compact('post'));
    }

    public function toggle_like(Post $post)
    {
       $like = auth()->user()->toggleLike($post->id);

       if($like instanceof \App\Models\Like){
            //post added like
            return view('front.posts.partials._like')->with('like_counts', $post->likers()->count());

       }else{
            //post removed like
            return view('front.posts.partials._unlike')->with('like_counts', $post->likers()->count());
       }
    }
}
