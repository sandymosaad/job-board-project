<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>job board</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .card {
        position: relative;
    }

    .card-img-top {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 70px;
        height: 70px;
        border-radius: 50%;
    }

    .card-body {
        margin-top: 10px;
    }
    </style>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand mr-2" href="#">X company</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03"
            aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#raina">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/posts/create">Create Post</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts.index', ['status' => 'approved']) }}">Approved Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts.index', ['status' => 'pending']) }}">Posts pending</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts.index', ['status' => 'rejected']) }}">Rejected Posts </a>
                </li>



            </ul>
            <form class="d-flex ms-auto my-2 my-lg-0">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="container-fluid mt-4">


        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
