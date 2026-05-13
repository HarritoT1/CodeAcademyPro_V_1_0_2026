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

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/checkout/" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <script src="{{ asset('js/color-modes.js') }}"></script>
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" />
    <meta name="theme-color" content="#712cf9" />
    <link href="{{ asset('css/checkout.css') }}" rel="stylesheet" />
    <link rel="shortcut icon" type="image/ico" href="{{ asset('img/logo.ico') }}" />
    <link href="{{ asset('css/globalstyles.css') }}" rel="stylesheet" />

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

<body class="bg-body-tertiary px-5" id="body">
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
        <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center element-animation"
            id="bd-theme" type="button" aria-expanded="false" data-bs-toggle="dropdown"
            aria-label="Toggle theme (auto)">
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

    <div class="container">
        <main>
            <div class="pt-5 pb-4 text-center">
                <img class="mb-4 image-responsive" src="{{ asset('img/logo.png') }}" alt="logotipo"
                    style="width: 6rem;" />
                <h1 class="h1 fw-bold my-3">Formulario de registro</h1>
                <p class="fs-5 fw-lighter lh-sm">
                    El siguiente formulario te solicitará información personal, al crear tu cuenta,
                    estas aceptando los términos y condiciones de <a class="element-animation"
                        title="Terms and conditions" data-bs-toggle="modal" data-bs-target="#conditions">
                        CodeAcademyPro
                    </a>.
                </p>
            </div>

            <a class="element-animation" href="{{ route('login') }}" target="_self" title="Login"
                style="position: fixed; top: 20px; right: 1.8rem;">Regresar al login</a>

            <!-- Modal terms and conditions -->
            <div class="modal fade" id="conditions" tabindex="-1">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title h3">Terminos y condiciones de CodeAcademyPro.</h5>
                            <button type="button" class="btn-close pe-4" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <h3 class="h4 my-0">CodeAcademyPro:</h3>
                            <div class="p-3 text-justify" style="overflow-x: hidden;">

                                <b class="text-uppercase" style="font-size: 1.1rem;">1. Aceptación de los
                                    términos:</b>
                                <p class="fw-lighter" style="text-align: justify;">
                                    Al registrarse o utilizar la plataforma CodeAcademyPro, el usuario acepta cumplir
                                    con los presentes
                                    Términos y Condiciones. Si no está de acuerdo con ellos, deberá abstenerse de
                                    utilizar la plataforma.
                                </p>

                                <b class="text-uppercase" style="font-size: 1.1rem;">2. Descripción del servicio:</b>
                                <p class="fw-lighter" style="text-align: justify;">
                                    CodeAcademyPro es una plataforma educativa en línea orientada al aprendizaje de
                                    programación mediante
                                    cursos estructurados en temas y subtemas. Los usuarios pueden acceder al contenido,
                                    inscribirse en
                                    cursos y realizar seguimiento de su progreso dentro de la plataforma.
                                </p>

                                <b class="text-uppercase" style="font-size: 1.1rem;">3. Registro de usuario:</b>
                                <p class="fw-lighter" style="text-align: justify;">
                                    Para utilizar ciertas funcionalidades, el usuario deberá crear una cuenta
                                    proporcionando información
                                    válida. El usuario es responsable de mantener la confidencialidad de sus
                                    credenciales y del uso que se
                                    haga de su cuenta.
                                </p>

                                <b class="text-uppercase" style="font-size: 1.1rem;">4. Uso adecuado de la
                                    plataforma:</b>
                                <p class="fw-lighter" style="text-align: justify;">
                                    El usuario se compromete a utilizar la plataforma únicamente con fines educativos y
                                    conforme a la ley.
                                    Queda prohibido intentar acceder de manera no autorizada al sistema, interferir con
                                    su funcionamiento
                                    o utilizar el contenido con fines distintos al aprendizaje personal.
                                </p>

                                <b class="text-uppercase" style="font-size: 1.1rem;">5. Propiedad intelectual:</b>
                                <p class="fw-lighter" style="text-align: justify;">
                                    Todo el contenido disponible en la plataforma, incluyendo cursos, materiales, textos
                                    e imágenes,
                                    pertenece a CodeAcademyPro o a sus respectivos autores y está protegido por las
                                    leyes de propiedad
                                    intelectual. Su uso está limitado al aprendizaje dentro de la plataforma.
                                </p>

                                <b class="text-uppercase" style="font-size: 1.1rem;">6. Inscripción a cursos:</b>
                                <p class="fw-lighter" style="text-align: justify;">
                                    Los usuarios pueden inscribirse en los cursos disponibles en la plataforma para
                                    acceder a su contenido
                                    y realizar seguimiento de su progreso.
                                </p>

                                <b class="text-uppercase" style="font-size: 1.1rem;">7. Seguimiento de progreso:</b>
                                <p class="fw-lighter" style="text-align: justify;">
                                    La plataforma registra el avance del usuario en los cursos mediante el seguimiento
                                    de los temas y
                                    subtemas completados, con el objetivo de mostrar su progreso dentro del curso
                                    correspondiente.
                                </p>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn element-animation py-2 px-3"
                                data-bs-dismiss="modal">Aceptar</button>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Modal terms and conditions -->

            @if ($user !== null && $user->email_verified_at === null)
                <div class="modal fade" id="mail_confirm" tabindex="-1">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h3 class="modal-title h3 fs-4">Confirmación de correo:</h3>
                                <button type="button" class="btn-close pe-4" data-bs-dismiss="modal"></button>
                            </div>

                            <div class="modal-body">
                                <h5 class="h5 my-0 text-justify fs-6 lh-base">Te hemos enviado un correo con un enlace
                                    a
                                    {{ $user->email }}, por
                                    favor da clic para confirmar
                                    tu correo y ser redirigido.</h5>
                            </div>

                            <div class="modal-footer">
                                <form action="{{ route('verification.send') }}" method="post" class="border-end">
                                    @csrf
                                    <input type="submit" class="btn element-animation py-2 px-3" value="Reenviar correo de verificación de email">
                                </form>
                                <a class="element-animation" onclick="cancelRegistration()" title="Cancel">Cancelar
                                    registro de cuenta</a>
                            </div>

                            @if (session('message'))
                                <div class="alert alert-success alert-dismissible fade show mt-3 mx-auto" role="alert" style="text-align: center; width: 95%">
                                  {{ session('message') }}
                                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close me-2"></button>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            @endif

            <div>
                <h4 class="mb-3 h4">Información personal:</h4>
                <form id="create_user" action="{{ route('usernew.store') }}" method="post"
                    enctype="multipart/form-data" class="needs-validation" autocomplete="on" novalidate>
                    <div class="row g-3">

                        <div class="col-sm-6">
                            <label for="fullname" class="form-label">Nombre completo</label>
                            <input type="text" required maxlength="255" class="form-control" id="fullname"
                                name="fullname" placeholder="" value="{{ old('fullname') }}" />
                            <div class="invalid-feedback">
                                Ingrese su nombre completo.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="name" class="form-label">Nombre de usuario</label>
                            <input type="text" required maxlength="255" class="form-control" id="name"
                                name="name" placeholder="" value="{{ old('name') }}" />
                            <div class="invalid-feedback">
                                Ingrese un nombre de usuario.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="text" required min="8" maxlength="255" class="form-control"
                                id="password" name="password" placeholder="" value="" />
                            <div class="invalid-feedback" id="password_invalid_feedback">
                                Ingresa una contraseña válida.
                            </div>
                            <div class="valid-feedback">
                                Las contraseñas coinciden.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="confirm_password" class="form-label">Confirma la contraseña</label>
                            <input type="text" required min="8" maxlength="255" class="form-control"
                                id="confirm_password" name="confirm_password" placeholder="" value="" />
                            <div class="invalid-feedback" id="confirm_password_invalid_feedback">
                                Ingresa una confirmación de contraseña válida.
                            </div>
                            <div class="valid-feedback">
                                Las contraseñas coinciden.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email <span
                                    class="text-danger fw-lighter">(debera confirmarse para
                                    crear la cuenta)</span></label>
                            <div class="input-group">
                                <span class="input-group-text">@</span>
                                <input type="email" maxlength="255" required class="form-control" id="email"
                                    name="email" placeholder="@dominio" value="{{ old('email') }}">
                                <div class="invalid-feedback">
                                    Proporciona un correo electrónico válido.
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="rol_id" class="form-label">Rol del usuario</label>
                            <select class="form-control form-select" id="rol_id" name="rol_id"
                                aria-label="Default select example" required>
                                @forelse ($roles as $rol)
                                    <option value="{{ $rol->id }}" @selected(old('rol_id') == $rol->id)>
                                        {{ $rol->role_name }}</option>
                                @empty
                                    <option value="" selected>Ninguno</option>
                                @endforelse
                            </select>

                            <div class="invalid-feedback">
                                Selecciona un rol de usuario por favor.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="phone_number" class="form-label">Número de telefono</label>
                            <input type="tel" maxlength="20" required pattern="^[0-9]{2}-[0-9]{4}-[0-9]{4}$"
                                class="form-control" id="phone_number" name="phone_number"
                                placeholder="55-8837-4683" value="{{ old('phone_number') }}" />
                            <div class="invalid-feedback">
                                Por favor, ingresa un número de teléfono válido.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="home_address" class="form-label">Domicilio</label>
                            <input type="text" required class="form-control" id="home_address"
                                name="home_address" placeholder="Calle Flores Jardines de Chalco EDOMEX C.P. 56607"
                                value="{{ old('home_address') }}" />
                            <div class="invalid-feedback">
                                Por favor, ingresa tu dirección.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="description" class="form-label">Añade una descripción de ti mismo (para tu
                                perfil)</label>
                            <textarea rows="6" required class="form-control" id="description" name="description"
                                placeholder="Escribe algo sobre ti..." aria-label="Notas" style="resize: none; overflow-y: auto;">{{ old('description') }}</textarea>

                            <div class="invalid-feedback">
                                Por favor, ingresa una descripción personal.
                            </div>
                        </div>

                        <div class="col-12 text-center mt-4">
                            <label for="avatar_url" class="form-label">Añade una foto de perfil <span
                                    class="text-warning">(opcional)</span></label>
                            <img id="preview" src="{{ asset('img/default-avatar.png') }}" alt="Profile preview"
                                style="border-radius: 100%; width: 200px !important; height: 200px !important;"
                                class="image-responsive my-2" title="Foto de perfil" />
                            <br>
                            <input type="file" id="avatar_url" name="avatar_url"
                                accept="image/png, image/jpeg, image/webp, image/gif" class="form-control"
                                onchange="previewImage(event, 'preview')" />
                            <div class="invalid-feedback">
                                Ingresa un archivo válido.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4" />

                    <button id="submit" class="btn my-2 w-100 py-2 element-animation" type="button"
                        onclick="ask_before_submit_new('create_user')" disabled>
                        Crear mi cuenta
                    </button>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert"
                                style="text-align: center">
                                {{ $error }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close me-2"></button>
                            </div>
                        @endforeach
                    @endif

                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert"
                            style="text-align: center">
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close me-2"></button>
                        </div>
                    @endif
                </form>
            </div>

        </main>

    </div>

    <hr class="mt-3 mb-2">

    <footer class="mx-auto d-flex flex-wrap justify-content-between align-items-center py-3 mb-4 border-top"
        style="width: 95%;">
        <div class="col-12 col-md-5 d-flex align-items-center text-center">
            <img class="image-responsive" src="{{ asset('img/logo.png') }}" alt="logotipo"
                style="width: 4rem; margin: 0 1rem !important;" />
            <span class="text-body-secondary">&copy; Copyright 2025 CodeAcademyPro.com.
                Todos los Derechos Reservados.</span>
        </div>
        <div class="col-12 col-md-4 d-flex align-items-center mt-1">
            <div class="text-body-secondary mx-3 ms-md-auto me-md-3 mx-auto">
                Contacto:
                <a class="element-animation" href="mailto:firebase.proyect.library@gmail.com" target="_self"
                    title="Contact" style="font-size: 1.5rem;">
                    <i class="bi bi-envelope-at-fill"></i>
                </a>
            </div>
        </div>
    </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('password')?.addEventListener('input', matchPasswords);
            document.getElementById('confirm_password')?.addEventListener('input', matchPasswords);

            @if ($user !== null && $user->email_verified_at === null)
              const modal = new bootstrap.Modal(document.getElementById('mail_confirm'));
              modal.show();
            @endif
        });
    </script>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/globalscripts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/checkout.js') }}" class="astro-vvvwv3sm"></script>

</body>

</html>
