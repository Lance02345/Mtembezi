
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Msafiri</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="{{ asset('assets/weather.js') }}"></script>
   
   
   <style>
        /* Custom styles for the navbar  */
        nav {
            background-color: #013220
        }
        
        nav a {
            color: #F5F5F5 !important;
        }

        .navbar-toggler-icon {
            background-color: white;
        }

        .hero-section {
            background: url('{{ asset('storage/images/hero1.jpg') }}') center/cover no-repeat;
            color: white; /* Text color on the hero section */
            padding: 100px 0; /* Adjust padding as needed */
        }
        
    </style>

    
</head>
<body>
       <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light justify-content-between">
        <a class="navbar-brand" ><img src="{{ asset('storage/images/traveller_2517614.png')}}" 
            style=" width:55px; height:50px;vertical-align: middle;padding-left: 0px;padding-right: 0px; padding-top: 0px; border-style: none; " ><span style="color:#d4af37">Msa</span><span>firi</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
     <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('index') }}" >Home</a>
            </li>
        </ul>
     </div>

    <!-- logged in user drop down  settings -->
    <div class="navbar-nav">
    @if (Auth::check())
    <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white;">
                {{ Auth::user()->name }}
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownUser" style="background-color: #013220; color: black;">
                <style>

                    .dropdown-item:hover {
                        background-color: transparent !important;
                        color: white !important;
                    }
                </style>
                    @if(auth()->user()->isAdmin())
                    <a class="dropdown-item" href="{{ route('admin.createBlog') }}">Add Blog</a>
                    <a class="dropdown-item" href="{{ route('admin.myblogs') }}">My Blogs</a>
                    
                    @if(auth()->user()->isAdmin() && auth()->user()->id == 1)
                    <a class="dropdown-item" href="{{ route('admin.blogRequests') }}">Blog Requests</a>
                    <div class="dropdown-divider"></div>
                   @endif       

                @else
                    <a class="dropdown-item" href="{{ route('user.sendRequest') }}">Request to Blog</a>
                    <div class="dropdown-divider"></div>
                @endif
                <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
        @else
            <!-- Display login and sign-u links if user is not logged in -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Sign Up</a>
            </li>
        @endif
    </div>
</nav>

     <!-- Hero section -->
<div class="hero-section text-center">
    <h1>Welcome to <span style="color:#d4af37">Msa</span><span>firi</span> Blogs</h1>
    <p>Discover exciting stories and adventures of travellers shared by our community.</p>
       
       <!-- Weather Banner -->
    <div id="weather-banner">
                @if(isset($weatherData[0]))
                    Current Weather in Nairobi : {{ $weatherData[0]['WeatherText'] }}, Temperature: {{ $weatherData[0]['Temperature']['Metric']['Value'] }}°C
                @else
                    Unable to fetch weather data.
                @endif
            </div>
</div>

<div class="container mt-4">
    @yield('content')
</div>

          <!-- footer -->
<footer class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <p>&copy; 2024 Msafiri Blog. All rights reserved.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
