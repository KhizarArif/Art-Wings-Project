<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/7.3.2/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('frontend_assets/css/styles.css') }}">
    <title>Material Design for Bootstrap - Laravel</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
    <!-- MDB -->

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>


    <!-- Styles -->
    <style>
        /* Color of the links BEFORE scroll */
        .navbar-before-scroll .nav-link,
        .navbar-before-scroll .navbar-toggler-icon {
            color: #b9b6b6;
        }

        /* Color of the links AFTER scroll */
        .navbar-after-scroll .nav-link,
        .navbar-after-scroll .navbar-toggler-icon {
            color: #4f4f4f;
        }

        /* Color of the navbar AFTER scroll */
        .navbar-after-scroll {
            background-color: #fff;
        }

        /* Transition after scrolling */
        .navbar-after-scroll {
            transition: background 0.5s ease-in-out, padding 0.5s ease-in-out;
        }

        /* Transition to the initial state */
        .navbar-before-scroll {
            transition: background 0.5s ease-in-out, padding 0.5s ease-in-out;
        }

        /* An optional height of the navbar AFTER scroll */
        .navbar.navbar-before-scroll.navbar-after-scroll {
            padding-top: 5px;
            padding-bottom: 5px;
        }

        /* Navbar on mobile */
        @media (max-width: 991.98px) {
            #main-navbar {
                background-color: #fff;
            }

            .nav-link,
            .navbar-toggler-icon {
                color: #4f4f4f !important;
            }
        }
    </style>
</head>

<body>
    <!--Main Navigation-->
    <header style="height: 15vh;">

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-md fixed-top navbar-before-scroll shadow-0"
            style="height:10vh;">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button data-mdb-collapse-init class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                    data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Collapsible wrapper -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <!-- Logo -->
                        <a class="navbar-brand me-1" href="#"><img
                                src="https://ascensus-mdb-uikit-tutorial.mdbgo.io/img/logo.png" height="20px"
                                alt="Logo" loading="lazy" /></a>

                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#!">Projects</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#!">About me</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#!">Testimonials</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="#!">Contact</a>
                        </li>
                    </ul>

                    <ul class="navbar-nav flex-row">
                        <!-- Icons -->
                        <li class="nav-item">
                            <a class="nav-link pe-2" href="#!">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2" href="#!">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-2" href="#!">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link ps-2" href="#!">
                                <i class="fab fa-instagram"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Collapsible wrapper -->

            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->

        {{-- <div class="row d-flex justify-content-center align-items-center bg-white">
            <?php
            
            use function App\Helpers\getSubCategories;
            
            $subCategories = getSubCategories();
            ?>
            @if ($subCategories->isNotEmpty())
            @foreach ($subCategories as $getSubCategory)
            <div class="navbar_subCategory">
                <a href="javascript:void(0)" class="navbar_subCategory_link">
                    <p class="navbar_subCategory_text">{{$getSubCategory->name}}</p>
                </a>
            </div>
            @endforeach
            @endif
        </div> --}}

    </header>
    <!--Main Navigation-->
