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
        $posts = Post::paginate(4); // Paginate the posts with 4 items per page

        $apiKey = 'SkkwaWYTVoHBiGAWold1zn5NcUmuWBXe';
        $cityKey = '224758';

        $response = \Illuminate\Support\Facades\Http::withOptions(['verify' => false])->get("https://dataservice.accuweather.com/currentconditions/v1/{$cityKey}?apikey={$apiKey}");

        $weatherData = $response->json();

        return view('index', ['posts' => $posts, 'weatherData' => $weatherData]);
    }

}