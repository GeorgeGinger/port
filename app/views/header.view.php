<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
  <script src="../assets/js/color-modes.js"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="generator" content="Hugo 0.122.0">
  <title><?= APP_NAME ?></title>

  <link href="<?= ROOT ?>/assets/css/main.min.css" rel="stylesheet" crossorigin="anonymous">
  <!-- <link href="<?= ROOT ?>/assets/css/bootstrap.min.css" rel="stylesheet"> -->
  <link href="<?= ROOT ?>/assets/css/bootstrap-icons.css" rel="stylesheet">
  <link href="<?= ROOT ?>/assets/css/headers.css" rel="stylesheet">
  <link href="<?= ROOT ?>/assets/css/header-moje.css" rel="stylesheet">

  <link rel="stylesheet" href="<?= ROOT ?>/assets/photoswipe/dist/photoswipe.css">

  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    .b-example-divider {
      width: 100%;
      height: 3rem;
      background-color: rgba(0, 0, 0, .1);
      border: solid rgba(0, 0, 0, .15);
      border-width: 1px 0;
      box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -.125em;
      fill: currentColor;
    }

    .nav-scroller {
      position: relative;
      z-index: 2;
      height: 2.75rem;
      overflow-y: hidden;
    }

    .nav-scroller .nav {
      display: flex;
      flex-wrap: nowrap;
      padding-bottom: 1rem;
      margin-top: -1px;
      overflow-x: auto;
      text-align: center;
      white-space: nowrap;
      -webkit-overflow-scrolling: touch;
    }

    .btn-bd-primary {
      --bd-violet-bg: #712cf9;
      --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

      --bs-btn-font-weight: 600;
      --bs-btn-color: var(--bs-white);
      --bs-btn-bg: var(--bd-violet-bg);
      --bs-btn-border-color: var(--bd-violet-bg);
      --bs-btn-hover-color: var(--bs-white);
      --bs-btn-hover-bg: #6528e0;
      --bs-btn-hover-border-color: #6528e0;
      --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
      --bs-btn-active-color: var(--bs-btn-hover-color);
      --bs-btn-active-bg: #5a23c8;
      --bs-btn-active-border-color: #5a23c8;
    }

    .bd-mode-toggle {
      z-index: 1500;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }
  </style>


</head>

<body class="">



  <div class="container-fuid header-img-moje rounded fixed-top text-shadow-moje">

    <header class="">


      <div class="container">
        <nav class="navbar navbar-expand navbar-dark">

          <ul class="navbar-nav nav-pills text-center dflex-moje header_font_moje">
            <li class="nav-item"><a class="nav-link" href="https://mapy.cz/s/lelonubete" target="_blank"><i
                  class="bi bi-geo-alt-fill pe-2"></i>Kynskeho 122, Slany</a></li>
            <li class="nav-item"><a class="nav-link" href="tel:+420 776 740 434"><i
                  class="bi bi-telephone-fill pe-2"></i>+420 776 740 434</a></li>
          </ul>
        </nav>
      </div>

      <div class="container">
        <!-- <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom"> -->

        <nav class="navbar navbar-expand-lg navbar-dark">

          <a href="<?= ROOT ?>/home" class="navbar-brand">
            <span class="fs-1 text-light">Sauna Klub Slaný</span>
          </a>

          <!-- toggle nav for mobile nav burger menu-->

          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-nav"
            aria-controls="main-nav" aria-expanded="false" aria-label="Toggle navigation">
            <!-- ikona burger menu -->
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="main-nav">

            <ul class="navbar-nav nav-pills ms-auto text-center fs-3">
              <li class="nav-item"><a href="<?= ROOT ?>/home"
                  class="nav-link <?php if ($stranka == "home")
                    echo "active"; ?>">Domů</a></li>
              <li class="nav-item"><a href="<?= ROOT ?>/sluzby"
                  class="nav-link <?php if ($stranka == "sluzby")
                    echo "active"; ?>">Služby</a></li>
              <li class="nav-item"><a href="<?= ROOT ?>/obsazenost"
                  class="nav-link <?php if ($stranka == "obsazenost")
                    echo "active"; ?>">Obsazenost</a></li>
              <li class="nav-item"><a href="<?= ROOT ?>/kudyknam"
                  class="nav-link <?php if ($stranka == "kudyknam")
                    echo "active"; ?>">Kudyknám</a></li>
              <li class="nav-item"><a href="<?= ROOT ?>/galerie"
                  class="nav-link <?php if ($stranka == "galerie")
                    echo "active"; ?>">Galerie</a></li>
            </ul>
          </div>
        </nav>
      </div>

    </header>

  </div>

  <main class="container-fluid col-12 col-lg-8 my-3 px-0 padding-top-moje">