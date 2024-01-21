<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\BlogRequest;
use App\Models\User;





class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']); // Apply 'admin' middleware to the entire controller
    }

    public function index()
    {
        $posts = Post::all();

        return view('index', ['posts' => $posts]);
    }

    public function create()
    {
        // Display the form for creating a new post
        return view('admins.create_blog');
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
    
        return redirect()->route('index')->with('success', 'Post created successfully');
    }

    public function myblogs()
{
    // fetch the authenticated user
    $user = auth()->user();



    // Fetch all the blogs for the authenticated user with only title and publication date
    $blogs = $user->posts()->select('id', 'title', 'published_at')->get();

    return view('admins.myblogs', compact('blogs'));
}

// edit blog form
public function edit($id)
{
    $post = Post::findOrFail($id);

    // You can pass the $post variable to your view for editing
    return view('admins.edit', compact('post'));
}

    // Handle the update action
    public function update(Request $request, $id)
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

        // Find the post to update
        $post = Post::findOrFail($id);

        // Update post details
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->published_at = $request->input('published_at');

        // Update the post
        $post->save();

        // Update or add images
        for ($i = 1; $i <= 5; $i++) {
            $imageKey = 'image_' . $i;

            if ($request->hasFile($imageKey)) {
                // Delete the existing image if it exists
                if ($post->$imageKey) {
                    Storage::delete($post->$imageKey);
                }

                $image = $request->file($imageKey);
                $imageName = 'post_' . $post->id . '_image_' . $i . '.' . $image->getClientOriginalExtension();
                Storage::putFileAs('public/images', $image, $imageName);

                // Save the new image path to the Post model
                $post->$imageKey = 'storage/images/' . $imageName;
            }
        }

        // Save the post with updated details and image paths
        $post->save();

        return redirect()->route('admin.myblogs')->with('success', 'Post updated successfully');
    }

    //see blog requests from normal users
    public function blogRequests()
    {
        // Fetch blog requests and pass them to the view
        $blogRequests = BlogRequest::all();
        
        return view('admins.blogRequests', compact('blogRequests'));
    }

    public function approveRequest($id)
    {
        $request = BlogRequest::findOrFail($id);
        
        // Update the user's role to 'admin'
        $user = User::findOrFail($request->user_id);
        $user->update(['role' => 'admin']);

        // Delete the blog request record
        $request->delete();

        return redirect()->route('admin.blogRequests')->with('success', 'Request approved successfully.');
    }

    public function declineRequest($id)
    {
        $request = BlogRequest::findOrFail($id);

        // Delete the blog request record
        $request->delete();

        return redirect()->route('admin.blogRequests')->with('success', 'Request declined.');
    }



//delete blog post
public function destroy($id)
{
    $post = Post::findOrFail($id);

    // Delete the images associated with the post
    for ($i = 1; $i <= 5; $i++) {
        $imagePath = $post->{"image_$i"};

        if ($imagePath) {
            // Assuming the images are stored in the 'public' disk
            Storage::disk('public')->delete($imagePath);
        }
    }

    // Delete the post
    $post->delete();

    // Redirect to the index page or wherever you want after deletion
    return redirect()->route('admin.myblogs')->with('success', 'Post deleted successfully');
}

}
