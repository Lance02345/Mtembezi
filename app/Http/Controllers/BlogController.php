<?php
namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('index', ['posts' => $posts]);
    }


public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'content' => 'required|string',
        'published_at' => 'required|date',
        'image_1' => 'image|max:20480|mimes:jpeg,png,jpg,gif,svg',
        'image_2' => 'image|max:20480|mimes:jpeg,png,jpg,gif,svg',
        'image_3' => 'image|max:20480|mimes:jpeg,png,jpg,gif,svg',
        'image_4' => 'image|max:20480|mimes:jpeg,png,jpg,gif,svg',
        'image_5' => 'image|max:20480|mimes:jpeg,png,jpg,gif,svg',
    ]);

    $user = Auth::user();

    $post = new Post([
        'title' => $request->input('title'),
        'content' => $request->input('content'),
        'published_at' => $request->input('published_at'),
    ]);

    // Save the post
    $user->posts()->save($post);

    for ($i = 1; $i <= 5; $i++) {
        $imageKey = 'image_' . $i;

        if ($request->hasFile($imageKey)) {
            $image = $request->file($imageKey);
            $imageName = 'post_' . $post->id . '_image_' . $i . '.' . $image->getClientOriginalExtension();
            Storage::putFileAs('public/images', $image, $imageName);

            // Save the image path to the Post model
            $post->$imageKey = 'storage/images/' . $imageName;
        }
    }

    // Save the post with image paths
    $post->save();

    return redirect()->route('posts.index')->with('success', 'Post created successfully');
}
}