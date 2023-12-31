<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Recipes App</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="page-content container note-has-grid">
        <ul class="nav nav-pills mt-2 p-3 bg-white mb-3 rounded-pill align-items-center shadow-sm">
            <li class="nav-item mx-3">
                <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-3 px-md-3 mr-0 mr-md-4 active" id="all-category">
                    <i class="icon-layers mr-1"></i><span class="d-none d-md-block">Products</span>
                </a>
            </li>
            <li class="nav-item mx-3">
                <a href="javascript:void(0)" class="nav-link rounded-pill note-link d-flex align-items-center px-3 px-md-3 mr-0 mr-md-2" id="note-business"> <i class="icon-briefcase mr-1"></i><span class="d-none d-md-block">Recipes</span></a>
            </li>
        </ul>

        <div class="tab-content">

            @yield('content')
        </div>
    </div>
</body>
</html>
