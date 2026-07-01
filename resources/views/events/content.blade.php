<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EVENCIA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background-color: #f5f5f5;
            font-family: sans-serif;
        }
        .bg-banner {
            background: #ac426b
                         no-repeat center center;
            background-size: cover;
            color: #fff;
        }
        .movie-poster {
            width: 280px;
            height: 420px;
            border-radius: 12px;
            overflow: hidden;
        }

        .movie-poster img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .poster-badge {
            background-color: #000;
            color: #fff;
            font-size: 12px;
            text-align: center;
            padding: 4px 0;
            border-radius: 0 0 8px 8px;
        }
        .btn-bms-primary {
            background-color: #6844e0;
            color: white;
            border: none;
            padding: 12px 40px;
            font-weight: 600;
            border-radius: 8px;
        }
        .btn-bms-primary:hover {
            background-color: #6844e0;
            color: white;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-2">
        <div class="container bg-white">
            <a class="navbar-brand" href="#">
                EVENCIA
                <!-- <img src="https://placehold.co/150x40/f84464/fff?text=bookmyshow" alt="Logo" height="40"> -->
            </a>
            
            <div class="flex-grow-1 mx-4">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0 text-muted"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control border-start-0 py-2 fs-7" placeholder="Search for Movies, Events, Plays, Sports and Activities">
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="dropdown">
                    <a class="text-dark text-decoration-none dropdown-toggle fs-6" href="#" role="button" data-bs-toggle="dropdown">
                        Agartala
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-menu-item px-3 text-dark text-decoration-none" href="#">Mumbai</a></li>
                        <li><a class="dropdown-menu-item px-3 text-dark text-decoration-none" href="#">Delhi</a></li>
                    </ul>
                </div>
                <button class="btn btn-sm text-white px-3 py-1" style="background-color: #6844e0;">Sign In</button>
                <button class="navbar-toggler border-0 shadow-none text-dark" type="button">
                    <i class="fa-solid fa-bars fs-4"></i>
                </button>
            </div>
        </div>
    </nav>

    <div class="bg-white py-2 small border-bottom shadow-sm">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="d-flex gap-4">
                <a href="#" class="text-dark text-decoration-none fw-semibold">Movies</a>
                <a href="#" class="text-secondary text-decoration-none">Stream</a>
                <a href="#" class="text-secondary text-decoration-none">Events</a>
                <a href="#" class="text-secondary text-decoration-none">Plays</a>
                <a href="#" class="text-secondary text-decoration-none">Sports</a>
                <a href="#" class="text-secondary text-decoration-none">Activities</a>
            </div>
            <div class="d-flex gap-3 text-secondary" style="font-size: 12px;">
                <a href="#" class="text-secondary text-decoration-none">ListYourShow</a>
                <a href="#" class="text-secondary text-decoration-none">Corporates</a>
                <a href="#" class="text-secondary text-decoration-none">Offers</a>
                <a href="#" class="text-secondary text-decoration-none">Gift Cards</a>
            </div>
        </div>
    </div>

    <div class="bg-banner py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-3 text-center text-md-start">
                    
                        <div class="movie-poster position-relative">
                            @forelse($events as $event)
                                <img src="{{ asset('uploads/'.$show->event->image) }}" alt="{{ $event->event_name }}">
                            @empty
                            @endforelse
                            <!-- <div class="position-absolute top-50 start-50 translate-middle">
                                <button class="btn btn-dark btn-sm rounded-pill opacity-75 px-3">
                                    <i class="fa-solid fa-play me-1"></i> Trailers (2)
                                </button>
                            </div> -->
                        </div>
                        <!-- <div class="poster-badge text-uppercase fw-semibold">In cinemas</div> -->
                    
                </div>

                <div class="col-md-9 mt-4 mt-md-0 ps-md-5">
                    <div class="d-flex justify-content-between align-items-start">
                        <h1 class="fw-bold display-6 m-0">{{ $show->event->event_name }}</h1>
                        <!-- <button class="btn btn-secondary bg-dark border-0 opacity-75 rounded-2 d-none d-md-block">
                            <i class="fa-solid fa-share-nodes me-2"></i>Share
                        </button> -->
                    </div>

                    <!-- <div class="bg-black bg-opacity-50 p-3 my-4 rounded-3 d-flex align-items-center justify-content-between max-w-sm" style="max-width: 450px;">
                        <div class="d-flex align-items-center">
                            <i class="fa-solid fa-thumbs-up text-success fs-4 me-2"></i>
                            <div>
                                <span class="fw-bold">124K+ are interested</span><br>
                                <small class="text-muted text-light opacity-75">Rating will appear once more reviews come in.</small>
                            </div>
                        </div>
                        <button class="btn btn-light btn-sm fw-semibold px-3 py-2 text-dark">Rate now</button>
                    </div> -->

                    <!-- <div class="mb-3">
                        <span class="badge bg-light text-dark px-2 py-1 me-2">2D</span>
                        <span class="badge bg-light text-dark px-2 py-1">Hindi</span>
                    </div> -->

                    <p class="mb-4 text-white-50">
                        {{ $show->event->duration }} min <span class="mx-2">•</span> {{ $show->venue->venue_name }} <span class="mx-2">•</span>{{ $show->show_date }}<span class="mx-2">•</span> {{ $show->show_time }}
                    </p>

                    <a href="{{ route('bookings.layout',$show->id) }}"
                    class="btn btn-bms-primary">
                    Book Tickets
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-8">
                <h3 class="fw-bold mb-3 fs-4 text-dark">About the movie</h3>
                <p class="text-dark mb-2 fw-medium">Yeh jungle toh safe hai, par yeh log? Bilkul nahi!</p>
                <p class="text-secondary text-justify lead fs-6">
                    Welcome to the Jungle is a Hindi movie starring Akshay Kumar, Suniel Shetty, Arshad Warsi, Raveena Tandon, Lara Dutta and many others in pivotal comic-action roles.
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>