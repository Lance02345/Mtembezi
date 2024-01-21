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

        $apiKey = 'u7VZRYGrAxiQu81BN4hsCdzfAU1Z5uIF';
        $cityKey = '224758'; // Replace with your actual city key

        $response = \Illuminate\Support\Facades\Http::withOptions(['verify' => false])->get("https://dataservice.accuweather.com/currentconditions/v1/{$cityKey}?apikey={$apiKey}");

        $weatherData = $response->json();

        return view('index', ['posts' => $posts, 'weatherData' => $weatherData]);
    }

}