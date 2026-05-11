<!doctype html>
<html lang="es" data-bs-theme="auto">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="" />
  <meta name="author" content="Ing. Karina Sayuri Diaz Martinez e Ing. Harol Gael Cardenas Trejo." />

  <meta name="csrf-token" content="{{ csrf_token() }}"> <!-- Importante -->

  <title>CodeAcademyPro</title>

  <meta name="generator" content="Astro v5.13.2" />

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <script src="../js/color-modes.js"></script>
  <link href="../css/bootstrap.min.css" rel="stylesheet" />
  <meta name="theme-color" content="#712cf9" />
  <link href="../css/carousel.css" rel="stylesheet" />
  <link href="../css/product.css" rel="stylesheet" />
  <script src="../js/jspdf.umd.min.js"></script>
  <script src="../js/jsPDF_Generate.js"></script>

  <link href="../css/globalstyles.css" rel="stylesheet" />
  <script src="../js/globalscripts.js" type="text/javascript"></script>

  <link rel="shortcut icon" type="image/ico" href="../img/logo.ico" />

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

<body style="background-image: var(--body-background) !important;" id="body">
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
    <button class="btn py-2 dropdown-toggle d-flex align-items-center element-animation" id="bd-theme" type="button"
      aria-expanded="false" data-bs-toggle="dropdown" aria-label="Toggle theme (auto)" style="width: 40px;">
      <svg class="bi my-1 theme-icon-active" aria-hidden="true">
        <use href="#circle-half"></use>
      </svg>
      <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
      <li>
        <button type="button" class="dropdown-item d-flex align-items-center element-animation"
          data-bs-theme-value="light" aria-pressed="false">
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
        <button type="button" class="dropdown-item d-flex align-items-center element-animation"
          data-bs-theme-value="dark" aria-pressed="false">
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
        <button type="button" class="dropdown-item d-flex align-items-center active element-animation"
          data-bs-theme-value="auto" aria-pressed="true">
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
  <svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="aperture" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
      stroke-width="2" viewBox="0 0 24 24">
      <circle cx="12" cy="12" r="10"></circle>
      <path d="M14.31 8l5.74 9.94M9.69 8h11.48M7.38 12l5.74-9.94M9.69 16L3.95 6.06M14.31 16H2.83m13.79-4l-5.74 9.94">
      </path>
    </symbol>
    <symbol id="cart" viewBox="0 0 16 16">
      <path
        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
      </path>
    </symbol>
    <symbol id="chevron-right" viewBox="0 0 16 16">
      <path fill-rule="evenodd"
        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z">
      </path>
    </symbol>
  </svg>

  <nav class="navbar navbar-expand-md bg-dark sticky-top border-bottom" data-bs-theme="dark">
    <div class="container">
      <a class="navbar-brand d-md-none element-animation fw-bold" href="#body" target="_self" title="dashboard">
        CodeAcademyPro
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas"
        aria-controls="offcanvas" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title fw-bold" id="offcanvasLabel">Menu de navegación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav flex-grow-1 justify-content-between align-items-center">

            <li class="nav-item">
              <a class="nav-link fw-bold element-animation" href="" style="color: white !important;" target="_self"
                title="Mis cursos">
                <div style="width: 150px !important;"
                  class="d-md-flex flex-nowrap column-gap-1 align-items-center d-block">
                  <img class="image-responsive" src="../img/miscursos.png" alt="Mis cursos" style="width: 1.8rem;" />
                  Mis cursos
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold element-animation" href="" style="color: white !important;" target="_self"
                title="Más cursos">
                <div style="width: 150px !important;"
                  class="d-md-flex flex-nowrap column-gap-1 align-items-center d-block">
                  <img class="image-responsive me-md-2" src="../img/cursos.png" alt="Más cursos"
                    style="width: 1.8rem;" />
                  Cursos
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold element-animation" href="" style="color: white !important;" target="_self"
                title="Perfil">
                <div style="width: 150px !important;"
                  class="d-md-flex flex-nowrap column-gap-1 align-items-center d-block">
                  <img class="image-responsive" src="../img/perfil.png" alt="Mi perfil" style="width: 1.8rem;" />
                  @username
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold element-animation" href="" style="color: white !important;" target="_self"
                title="Contacto">
                <div style="width: 150px !important;"
                  class="d-md-flex flex-nowrap column-gap-1 align-items-center d-block">
                  <img class="image-responsive" src="../img/informacion.png" alt="Contacto" style="width: 1.8rem;" />
                  Contacto
                </div>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold element-animation" href="" style="color: white !important;" target="_self"
                title="Salir">
                <div style="width: 50px !important;"
                  class="d-md-flex flex-nowrap column-gap-1 align-items-center d-block">
                  <img class="image-responsive" src="../img/salida.png" alt="Salir" style="width: 1.8rem;" />
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
  </nav>

  <main>

    <div>
      <div class="position-relative overflow-hidden p-3 p-md-5 mb-md-3 text-center bg-body-tertiary text-white"
        style="background-image: url('../img/banner.gif'); background-size: cover">
        <div class="col-md-7 p-lg-5 mx-md-auto my-5 mx-1">
          <h1 class="display-4 fw-bold">Bienvenido @username, aquí puedes acceder a tus cursos. </h1>
          <h3 class="fw-normal text-muted mb-3" style="color: white !important;">
            Puedes visualizar el porcentaje de avance en cada curso.
          </h3>

          <div class="d-flex gap-3 justify-content-center lead fw-normal">
            <a class="icon-link element-animation" href="" target="_self" title="Más cursos">
              Más cursos
              <svg class="bi" aria-hidden="true">
                <use xlink:href="#chevron-right"></use>
              </svg>
            </a>
          </div>
        </div>
      </div>

      <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
        <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden"
          style="outline: 3px solid white;">
          <a class="my-3 py-3 element-animation text-body" href="" target="_self" title="Ir al curso">
            <h2 class="display-5 fw-bold">Curso: @coursename</h2>
            <p class="lead">@%</p>
          </a>

          <div class="bg-dark shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
            <a class="element-animation"
              style="height: 100% !important; width: 20rem !important; background: url('../img/js.png') no-repeat center / contain;"
              href="" target="_self" title="Ir al curso"></a>
          </div>
        </div>

        <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden"
          style="outline: 3px solid white;">
          <a class="my-3 py-3 element-animation text-body" href="" target="_self" title="Ir al curso">
            <h2 class="display-5 fw-bold">Curso: @coursename</h2>
            <p class="lead">@%</p>
          </a>

          <div class="bg-dark shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
            <a class="element-animation"
              style="height: 100% !important; width: 20rem !important; background: url('../img/c++.png') no-repeat center / contain;"
              href="" target="_self" title="Ir al curso"></a>
          </div>
        </div>
      </div>

      <div class="d-md-flex flex-md-equal w-100 my-md-3 ps-md-3">
        <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden"
          style="outline: 3px solid white;">
          <a class="my-3 py-3 element-animation text-body" href="" target="_self" title="Ir al curso">
            <h2 class="display-5 fw-bold">Curso: @coursename</h2>
            <p class="lead">@%</p>
          </a>

          <div class="bg-dark shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
            <a class="element-animation"
              style="height: 100% !important; width: 20rem !important; background: url('../img/python.png') no-repeat center / contain;"
              href="" target="_self" title="Ir al curso"></a>
          </div>
        </div>

        <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden"
          style="outline: 3px solid white;">
          <a class="mt-3 pt-3 element-animation text-body pb-0" href="" target="_self" title="Ir al curso">
            <h2 class="display-5 fw-bold">Curso: @coursename</h2>
            <p class="lead d-flex flex-row justify-content-center gap-1 my-1">
              <img class="image-responsive" src="../img/trofeo.png" alt="Completado:"
                style="width: 2rem; margin: 0 0 !important">100%
            </p>
          </a>

          <!-- @if Termino el curso -->
          <a class="element-animation d-block p-0 mb-3 btnCertificado" title="Generar certificado" onclick="generateCertificate('course_id')">Obtener certificado</a>
          <!-- @if Termino el curso -->

          <div class="bg-dark shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
            <a class="element-animation"
              style="height: 100% !important; width: 20rem !important; background: url('../img/java.webp') no-repeat center / contain;"
              href="" target="_self" title="Ir al curso"></a>
          </div>
        </div>
      </div>

    </div>

  </main>

  <hr class="mt-5 mb-2 mx-3" style="border: solid 1px white; opacity: 80%;">

  <footer class="mx-auto d-flex flex-wrap justify-content-between align-items-center py-5 mb-4 border-top row-gap-3"
    style="width: 95%; border-top: white solid 2px !important;">
    <div class="col-12 col-md-5 d-flex align-items-center text-center">
      <img class="image-responsive" src="../img/logo.png" alt="logotipo"
        style="width: 4rem; margin: 0 1rem !important;" />
      <span class="fw-bold">&copy; Copyright 2025 CodeAcademyPro.com.
        Todos los Derechos Reservados.</span>
    </div>
    <div class="col-12 col-md-4 d-flex align-items-center mt-1">
      <div class="fw-bold mx-3 ms-md-auto me-md-3 mx-auto">
        Contacto:
        <a class="element-animation" href="mailto:firebase.proyect.library@gmail.com" target="_self" title="Contact"
          style="font-size: 1.5rem;">
          <i class="bi bi-envelope-at-fill"></i>
        </a>
      </div>
    </div>
    <div class="col-12 d-flex flex-column align-items-center justify-content-center gap-2">
      <p class="fw-bold">Nos ubicamos en nuestro centro de desarrollo (visitanos):</p>
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3765.7829343771746!2d-99.00001985261142!3d19.29180355285376!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ce1cdb9988f43d%3A0x349f35ed189e88f2!2sInstituto%20Tecnol%C3%B3gico%20de%20Tl%C3%A1huac!5e0!3m2!1ses-419!2smx!4v1777843942256!5m2!1ses-419!2smx"
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </footer>
  
  <script src="../js/bootstrap.bundle.min.js" class="astro-vvvwv3sm"></script>

</body>

</html>