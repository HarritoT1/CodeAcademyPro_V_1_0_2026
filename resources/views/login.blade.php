<!doctype html>
<html lang="es" data-bs-theme="auto">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="Ing. Karina Sayuri Diaz Martinez e Ing. Harol Gael Cardenas Trejo." />

  <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Importante -->

  <title>{{ config('app.name', 'Laravel') }}</title>

  <meta name="generator" content="Astro v5.13.2" />

  <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/sign-in/" />

  <script src="{{ asset('js/color-modes.js') }}"></script>
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
  <meta name="theme-color" content="#712cf9" />
  <link href="{{ asset('css/sign-in.css') }}" rel="stylesheet" />
  <link rel="shortcut icon" type="image/ico" href="{{ asset('img/logo.ico') }}" />
  <link href="{{ asset('css/globalstyles.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('css/particulas.css') }}">

  <script src="{{ asset('js/particulas.js') }}"></script> 

  <script src="{{ asset('js/globalscripts.js') }}" type="text/javascript"></script>

  <style>
    body {
      overflow-x: hidden;
    }

    main.form-signin {
      width: 800px !important;
      max-width: 90% !important;
      padding: 0 5rem !important;
    }

    .button-google {
      background-image: none !important;
      background-color: white !important;
      color: black !important;
      border: solid 1.5px var(--extra-color-1) !important;
    }

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
      background-color: #0000001a;
      border: solid rgba(0, 0, 0, 0.15);
      border-width: 1px 0;
      box-shadow:
        inset 0 0.5em 1.5em #0000001a,
        inset 0 0.125em 0.5em #00000026;
    }

    .b-example-vr {
      flex-shrink: 0;
      width: 1.5rem;
      height: 100vh;
    }

    .bi {
      vertical-align: -0.125em;
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

    .bd-mode-toggle .bi {
      width: 1em;
      height: 1em;
    }

    .bd-mode-toggle .dropdown-menu .active .bi {
      display: block !important;
    }
  </style>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary" id="body">
  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
      <path
        d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z">
      </path>
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
      <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"></path>
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
      <path
        d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z">
      </path>
      <path
        d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z">
      </path>
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
      <path
        d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z">
      </path>
    </symbol>
  </svg>
  <div class="dropdown position-fixed bottom-0 end-0 mb-3 me-3 bd-mode-toggle">
    <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center element-animation" id="bd-theme"
      type="button" aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)">
      <svg class="bi my-1 theme-icon-active" aria-hidden="true">
        <use href="#circle-half"></use>
      </svg>
      <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center element-animation" data-bs-theme-value="light"
          aria-pressed="false">
          <svg class="bi me-2 opacity-50" aria-hidden="true">
            <use href="#sun-fill"></use>
          </svg>
          Light
          <svg class="bi ms-auto d-none" aria-hidden="true">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center element-animation" data-bs-theme-value="dark"
          aria-pressed="false">
          <svg class="bi me-2 opacity-50" aria-hidden="true">
            <use href="#moon-stars-fill"></use>
          </svg>
          Dark
          <svg class="bi ms-auto d-none" aria-hidden="true">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center active element-animation" data-bs-theme-value="auto"
          aria-pressed="true">
          <svg class="bi me-2 opacity-50" aria-hidden="true">
            <use href="#circle-half"></use>
          </svg>
          Auto
          <svg class="bi ms-auto d-none" aria-hidden="true">
            <use href="#check2"></use>
          </svg>
        </button>
      </li>
    </ul>
  </div>
  <main class="form-signin w-100 m-auto">
    <form id="login" action="{{ route('authenticate.login') }}" method="post" enctype="application/x-www-form-urlencoded"
      class="needs-validation" autocomplete="on" novalidate>
      @csrf <!-- Importante para proteger contra CSRF -->

      <img class="mb-4 image-responsive" src="{{ asset('img/logo.png') }}" alt="logotipo" style="width: 5rem;" />
      <h1 class="h5 mb-3 fw-bold text-center">Bienvenido a CodeAcademyPro.com</h1>
      <h3 class="fs-6 text-body-emphasis my-3">Por favor, inicia sesión:</h3>

      <div class="form-floating mb-2">
        <input type="text" maxlength="255" required class="form-control" id="name" name="name" placeholder=""
          value="{{ old('name') }}" />
        <label for="name">Nombre de usuario</label>
        <div class="invalid-feedback">
          Ingresa un usuario válido.
        </div>
      </div>

      <div class="form-floating position-relative mb-2">
        <input type="password" maxlength="255" required class="form-control" id="password" name="password"
          placeholder="" value="" />
        <label for="password">Contraseña</label>
        <span onclick="togglePassword()">
          <img src="{{ asset('img/eyeclosed.png') }}" alt="toggle_pass" class="imageResponsive icon-purple"
            style="width: 1.2rem; position: absolute; top: 20px; right: 10px; cursor: pointer; border-radius: 100%; background-color: transparent;">
        </span>
        <div class="invalid-feedback">
          Ingresa una contraseña válida.
        </div>
      </div>

      <div class="form-check form-switch mb-1">
        <input class="form-check-input input-checkbox-color" type="checkbox" id="remember_token" name="remember_token"
          value="true">
        <label class="form-check-label" for="remember_token"><small>Acuerdate de mí</small></label>
      </div>

      <button class="btn my-2 w-100 py-2 element-animation" type="submit">
        Iniciar sesión
      </button>

      @if($errors->any())
        @foreach ($errors->all() as $error)
          <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" style="text-align: center">
            {{ $error }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close me-2"></button>
          </div>
        @endforeach
      @endif

      @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" style="text-align: center">
          {{ session('status') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close me-2"></button>
        </div>
      @endif

      <div class="d-flex justify-between flex-row align-items-center my-1 gap-3">
        <div class="w-50">
          <hr class="border border-2 opacity-75" style="border-color: var(--extra-color-1) !important;">
        </div>
        <div class="w-50">
          <hr class="border border-2 opacity-75" style="border-color: var(--extra-color-1) !important;">
        </div>
      </div>

      <a class="btn my-2 w-100 py-2 element-animation button-google" href="{{ route('auth.redirect') }}" target="_self" title="Google">
        Continuar con Google
        <img class="image-responsive d-inline-block ms-1" src="{{ asset('img/google.png') }}" alt="google" style="width: 1.3rem;" />
      </a>

      <div class="d-flex justify-between flex-row align-items-center my-1 gap-3">
        <div class="w-50">
          <hr class="border border-2 opacity-75" style="border-color: var(--extra-color-1) !important;">
        </div>
        <div class="w-50">
          <hr class="border border-2 opacity-75" style="border-color: var(--extra-color-1) !important;">
        </div>
      </div>

      <a class="element-animation" href="{{ route("userpassword") }}" target="_self" title="Password recovery">
        Recuperar contraseña
      </a>

      <br>

      <a class="element-animation" href="{{ route("usernew") }}" target="_self" title="Create a new account">
        Crear una cuenta nueva
      </a>

      <br>
      <br>
    </form>

    <div id="burbujas-container"></div>
  </main>
  <script src="{{ asset('js/bootstrap.bundle.min.js') }}" class="astro-vvvwv3sm"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      asig_listeners_of_submit_forms();
    });
  </script>
</body>

</html>