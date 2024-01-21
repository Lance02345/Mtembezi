<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;

//search filter
class SearchController extends Controller
{
    public function search(Request $request)
{
    $query = $request->input('query');
    $results = Post::where('title', 'like', '%' . $query . '%')->paginate(4);

    return view('searchResults', compact('results'));
}

//see all blogs by a specific user
public function adminPosts(User $user)
{
    $results = $user->posts()->paginate(4);

    return view('searchResults', compact('user', 'results'));
}
}
