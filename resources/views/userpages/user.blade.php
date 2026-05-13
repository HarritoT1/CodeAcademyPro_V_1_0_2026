@extends('userpages.layout')
@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById("op3").style.color = "rgba(185, 4, 217, 1)";
        });
    </script>

    <div class="container px-5">
        <h1 class="m-5 text-center fw-bold display-5">Este es tu perfil {{ $user->name }}</h1>

        <div class="row g-5 justify-content-between" id="update_form">
            <div class="col-md-5 order-md-last">
                @php
                    $current_user_avatar_url = '';
                    if (str_starts_with($user->avatar_url, 'https://lh3.googleusercontent.com/')) {
                        $current_user_avatar_url = $user->avatar_url;
                    } else {
                        $current_user_avatar_url = asset('storage/' . $user->avatar_url);
                    }
                @endphp
                <img id="preview" src="{{ $current_user_avatar_url }}" alt="Profile preview"
                    style="border-radius: 100%; width: 200px !important; height: 200px !important;"
                    class="image-responsive my-2 preview-img" title="Foto de perfil" />
                <br>

                @if ($editable)
                    <input form="update" type="file" id="avatar_url" name="avatar_url"
                        accept="image/png, image/jpeg, image/webp, image/gif" class="form-control btn btn-warning w-100"
                        onchange="previewImage(event, 'preview', 'update')" disabled />
                    <div class="invalid-feedback">
                        Ingresa un archivo válido.
                    </div>

                    <hr class="hr">

                    <button id="delete_photo" class="btn w-100 py-2 element-animation"
                        style="background-image: none !important; border: solid rgb(206, 128, 128) 3px !important; background-color: red !important;"
                        type="button" onclick="deletePhoto(event, 'preview')" disabled>
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                @endif
            </div>

            <div class="col-md-7">
                <h4 class="mb-3 fw-bold">Información personal:</h4>

                <form id="update" action="" method="post" enctype="multipart/form-data" class="needs-validation"
                    autocomplete="on" novalidate>
                    @method('PUT')
                    @csrf

                    <div class="row g-3">

                        <!-- required if user don´t have a google_id  -->
                        <div class="col-sm-6">
                            <label for="fullname" class="form-label">Nombre completo</label>
                            <input type="text" maxlength="255" class="form-control" id="fullname" name="fullname"
                                placeholder="" value="{{ $user->fullname }}" disabled @required($user->google_id === null) />
                            <div class="invalid-feedback">
                                Ingrese su nombre completo.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="name" class="form-label">Nombre de usuario</label>
                            <input type="text" required maxlength="255" class="form-control" id="name"
                                name="name" placeholder="" value="{{ $user->name }}" disabled />
                            <div class="invalid-feedback">
                                Ingrese un nombre de usuario.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">@</span>
                                <input type="email" maxlength="255" required class="form-control" id="email"
                                    name="email" placeholder="" value="{{ $user->email }}" disabled>
                                <div class="invalid-feedback">
                                    Proporciona un correo electrónico válido.
                                </div>
                            </div>
                        </div>

                        <!-- required if user don´t have a google_id  -->

                        <div class="col-sm-6">
                            <label for="rol_id" class="form-label">Rol del usuario</label>
                            <select class="form-control form-select" id="rol_id" name="rol_id"
                                aria-label="Default select example" disabled @required($user->google_id === null)>
                                @if ($user->google_id !== null)
                                    <option value="" @selected($user->rol_id === null)>Ninguno</option>
                                @endif

                                @forelse ($roles as $rol)
                                    <option value="{{ $rol->id }}" @selected($user->rol_id == $rol->id)>{{ $rol->role_name }}
                                    </option>
                                @empty
                                    <option value="" selected>Ninguno</option>
                                @endforelse
                            </select>

                            <div class="invalid-feedback">
                                Selecciona un rol de usuario por favor.
                            </div>
                        </div>

                        <!-- required if user don´t have a google_id  -->

                        <div class="col-sm-6">
                            <label for="phone_number" class="form-label">Número de telefono</label>
                            <input type="tel" maxlength="20" pattern="^[0-9]{2}-[0-9]{4}-[0-9]{4}$" class="form-control"
                                id="phone_number" name="phone_number" placeholder="" value="{{ $user->phone_number }}"
                                disabled @required($user->google_id === null) />
                            <div class="invalid-feedback">
                                Por favor, ingresa un número de teléfono válido.
                            </div>
                        </div>

                        <!-- required if user don´t have a google_id  -->

                        <div class="col-12">
                            <label for="home_address" class="form-label">Domicilio</label>
                            <input type="text" class="form-control" id="home_address" name="home_address" placeholder=""
                                value="{{ $user->home_address }}" disabled @required($user->google_id === null) />
                            <div class="invalid-feedback">
                                Por favor, ingresa tu dirección.
                            </div>
                        </div>

                        <!-- required if user don´t have a google_id  -->

                        <div class="col-12">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea rows="6" class="form-control" id="description" name="description" placeholder=""
                                aria-label="Notas" style="resize: none; overflow-y: auto;" disabled @required($user->google_id === null)>{{ $user->description }}</textarea>

                            <div class="invalid-feedback">
                                Por favor, ingresa una descripción personal.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4" />

                    @if ($editable)
                        <div>
                            <button id="edit" class="btn d-block my-2 ms-auto px-4 w-20 py-2 element-animation"
                                type="button" onclick="editForm()">
                                Editar perfil
                            </button>
                        </div>
                    @endif
                </form>
            </div>
        </div>

        <div class="p-5 mt-5 rounded"
            style="background-image: var(--body-background); outline: solid 2px white !important;">
            <h3 class="h4 fw-bold mb-3">Perfil académico:</h3>
            <div class="table-container">
                <table class="table table-sm table-hover table-responsive-md text-center align-middle">

                    <thead class="thead-dark sticky-top">
                        <tr>
                            <th>Curso</th>
                            <th>Avance</th>
                            <th>Estado</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($user_courses as $course)
                            <tr>
                                <td>
                                    <div class="course-cell">
                                        {{ $course->course_name }}
                                    </div>
                                </td>

                                <td>{{ $course->progress }}%</td>

                                <td>
                                    @if ($course->progress === 100)
                                        <img src="{{ asset('img/trofeo.png') }}" alt="Completed course" width="30"
                                            height="30" title="Completado">
                                    @elseif ($course->progress > 0 && $course->progress < 100)
                                        <img src="{{ asset('img/progreso.png') }}" alt="Course progress" width="30"
                                            height="30" title="En progreso">
                                    @else
                                        <img src="{{ asset('img/start.png') }}" alt="Start course" width="30"
                                            height="30" title="Iniciado">
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No estás inscrito en ningún curso.</td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            asig_listeners_of_submit_forms();
            saveValuesofUpdateForm();
        });
    </script>
@endsection
