<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('index', ['posts' => $posts]);
    }

}