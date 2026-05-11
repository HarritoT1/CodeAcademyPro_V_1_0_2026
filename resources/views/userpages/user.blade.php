@extends('userpages.layout')
@section('content')
    <div class="container px-5">
        <h1 class="m-5 text-center fw-bold display-5">Este es tu perfil @username</h1>

        <div class="row g-5 justify-content-between" id="update_form">
            <div class="col-md-5 order-md-last">
                <img id="preview" src="{{ asset('img/ing1.png') }}" alt="Profile preview"
                    style="border-radius: 100%; width: 200px !important; height: 200px !important;"
                    class="image-responsive my-2 preview-img" title="Foto de perfil" />
                <br>

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
            </div>

            <div class="col-md-7">
                <h4 class="mb-3 fw-bold">Información personal:</h4>

                <form id="update" action="" method="post" enctype="multipart/form-data" class="needs-validation"
                    autocomplete="on" novalidate>
                    <!-- @method('PUT') -->

                    <div class="row g-3">

                        <!-- required if user don´t have a google_id  -->
                        <div class="col-sm-6">
                            <label for="fullname" class="form-label">Nombre completo</label>
                            <input type="text" required maxlength="255" class="form-control" id="fullname"
                                name="fullname" placeholder="" value="@fullname" disabled />
                            <div class="invalid-feedback">
                                Ingrese su nombre completo.
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <label for="name" class="form-label">Nombre de usuario</label>
                            <input type="text" required maxlength="255" class="form-control" id="name"
                                name="name" placeholder="" value="@username" disabled />
                            <div class="invalid-feedback">
                                Ingrese un nombre de usuario.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text">@</span>
                                <input type="email" maxlength="255" required class="form-control" id="email"
                                    name="email" placeholder="" value="@usermail" disabled>
                                <div class="invalid-feedback">
                                    Proporciona un correo electrónico válido.
                                </div>
                            </div>
                        </div>

                        <!-- required if user don´t have a google_id  -->

                        <div class="col-sm-6">
                            <label for="rol_id" class="form-label">Rol del usuario</label>
                            <select class="form-control form-select" id="rol_id" name="rol_id"
                                aria-label="Default select example" required disabled>
                                <option value="">Ninguno</option>
                                <option value="1" selected>Estudiante</option>
                                <option value="2">Profesor</option>
                            </select>

                            <div class="invalid-feedback">
                                Selecciona un rol de usuario por favor.
                            </div>
                        </div>

                        <!-- required if user don´t have a google_id  -->

                        <div class="col-sm-6">
                            <label for="phone_number" class="form-label">Número de telefono</label>
                            <input type="tel" maxlength="20" required pattern="^[0-9]{2}-[0-9]{4}-[0-9]{4}$"
                                class="form-control" id="phone_number" name="phone_number" placeholder=""
                                value="@55-8837-4683" disabled />
                            <div class="invalid-feedback">
                                Por favor, ingresa un número de teléfono válido.
                            </div>
                        </div>

                        <!-- required if user don´t have a google_id  -->

                        <div class="col-12">
                            <label for="home_address" class="form-label">Domicilio</label>
                            <input type="text" required class="form-control" id="home_address" name="home_address"
                                placeholder="" value="@Calle Flores Jardines de Chalco EDOMEX C.P. 56607" disabled />
                            <div class="invalid-feedback">
                                Por favor, ingresa tu dirección.
                            </div>
                        </div>

                        <!-- required if user don´t have a google_id  -->

                        <div class="col-12">
                            <label for="description" class="form-label">Descripción</label>
                            <textarea rows="6" required class="form-control" id="description" name="description" placeholder=""
                                aria-label="Notas" style="resize: none; overflow-y: auto;" disabled>@userdescription</textarea>

                            <div class="invalid-feedback">
                                Por favor, ingresa una descripción personal.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4" />

                    <div>
                        <button id="edit" class="btn d-block my-2 ms-auto px-4 w-20 py-2 element-animation"
                            type="button" onclick="editForm()">
                            Editar perfil
                        </button>
                    </div>
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

                        <tr>
                            <td>
                                <div class="course-cell">
                                    JavaScript moderno desde cero con proyectos prácticos
                                </div>
                            </td>

                            <td>15%</td>

                            <td>
                                <img src="{{ asset('img/start.png') }}" alt="Start course" width="30" height="30"
                                    title="Iniciado">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="course-cell">
                                    Laravel 12 creación de APIs REST profesionales
                                </div>
                            </td>

                            <td>48%</td>

                            <td>
                                <img src="{{ asset('img/progreso.png') }}" alt="Course progress" width="30"
                                    height="30" title="En progreso">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="course-cell">
                                    Python y Pandas análisis de datos empresariales
                                </div>
                            </td>

                            <td>100%</td>

                            <td>
                                <img src="{{ asset('img/trofeo.png') }}" alt="Completed course" width="30"
                                    height="30" title="Completado">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="course-cell">
                                    Fundamentos de redes y configuración Cisco CCNA
                                </div>
                            </td>

                            <td>62%</td>

                            <td>
                                <img src="{{ asset('img/progreso.png') }}" alt="Course progress" width="30"
                                    height="30" title="En progreso">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="course-cell">
                                    Desarrollo Full Stack con Node.js y MongoDB
                                </div>
                            </td>

                            <td>5%</td>

                            <td>
                                <img src="{{ asset('img/start.png') }}" alt="Start course" width="30" height="30"
                                    title="Iniciado">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="course-cell">
                                    Docker y Kubernetes despliegue de aplicaciones
                                </div>
                            </td>

                            <td>81%</td>

                            <td>
                                <img src="{{ asset('img/progreso.png') }}" alt="Course progress" width="30"
                                    height="30" title="En progreso">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="course-cell">
                                    Machine Learning básico con Scikit Learn
                                </div>
                            </td>

                            <td>100%</td>

                            <td>
                                <img src="{{ asset('img/trofeo.png') }}" alt="Completed course" width="30"
                                    height="30" title="Completado">
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="course-cell">
                                    SQL avanzado optimización y consultas complejas
                                </div>
                            </td>

                            <td>37%</td>

                            <td>
                                <img src="{{ asset('img/progreso.png') }}" alt="Course progress" width="30"
                                    height="30" title="En progreso">
                            </td>
                        </tr>

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
