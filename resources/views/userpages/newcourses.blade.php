@extends('userpages.layout')
@section('content')
    <section class="p-5 text-center" style="width: 95% !important; margin: 0 auto !important;">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-bold">Descubre nuevos cursos aquí e inscribete </h1>
                <p class="lead text-body-secondary">
                    Busca el curso que necesites:
                </p>
                <input type="text" id="buscar" placeholder="Nombre del curso" class="form-control">

                <script>
                    document.getElementById("buscar").addEventListener("keyup", function() {
                        let filtro = this.value.toLowerCase();
                        let cursos = document.querySelectorAll(".curso");

                        cursos.forEach(curso => {
                            curso.style.display =
                                curso.textContent.toLowerCase().includes(filtro) ?
                                "block" : "none";
                        });
                    });
                </script>

            </div>
        </div>
    </section>

    <div class="album py-5" style="background-image: var(--body-background) !important;">
        <div class="px-3" style="width: 85% !important; margin: 0 auto !important;">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 align-items-stretch px-3 px-sm-0">

                <div class="col curso">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('img/javascript.png') }}" class="card-img-top" height="225px" alt="@coursename">

                        <div class="card-body" style="text-align: justify;">

                            <h3 class="fw-bold fs-4 text-center my-2">@JavaScript desde 0 paso a paso</h3>

                            <p class="card-text">
                                Lenguaje de programación que permite agregar interactividad animaciones y dinamismo a las
                                páginas web
                                modernas.
                            </p>

                        </div>

                        <div class="d-flex justify-content-between align-items-center p-4">
                            <button class="btn w-50 py-2 element-animation" type="button">
                                Inscribirme
                            </button>
                            <small class="text-body-secondary fs-5">@5 hrs</small>
                        </div>

                    </div>
                </div>

                <div class="col curso">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('img/c.jpg') }}" class="card-img-top" height="225px" alt="@coursename">

                        <div class="card-body" style="text-align: justify;">

                            <h3 class="fw-bold fs-4 text-center my-2">@C++ desde 0 paso a paso</h3>

                            <p class="card-text">
                                Lenguaje de programación que permite agregar interactividad animaciones y dinamismo a las
                                páginas web
                                modernas.
                            </p>

                        </div>

                        <div class="d-flex justify-content-between align-items-center p-4">
                            <button class="btn w-50 py-2 element-animation" type="button">
                                Inscribirme
                            </button>
                            <small class="text-body-secondary fs-5">@5 hrs</small>
                        </div>

                    </div>
                </div>

                <div class="col curso">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('img/php.jpg') }}" class="card-img-top" height="225px" alt="@coursename">

                        <div class="card-body" style="text-align: justify;">

                            <h3 class="fw-bold fs-4 text-center my-2">@PHP desde 0 paso a paso</h3>

                            <p class="card-text">
                                Lenguaje de programación que permite agregar interactividad animaciones y dinamismo a las
                                páginas web
                                modernas.
                            </p>

                        </div>

                        <div class="d-flex justify-content-between align-items-center p-4">
                            <button class="btn w-50 py-2 element-animation" type="button">
                                Inscribirme
                            </button>
                            <small class="text-body-secondary fs-5">@5 hrs</small>
                        </div>

                    </div>
                </div>

                <div class="col curso">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('img/python.png') }}" class="card-img-top" height="225px" alt="@coursename">

                        <div class="card-body" style="text-align: justify;">

                            <h3 class="fw-bold fs-4 text-center my-2">@Python desde 0 paso a paso</h3>

                            <p class="card-text">
                                Lenguaje de programación que permite agregar interactividad animaciones y dinamismo a las
                                páginas web
                                modernas.
                            </p>

                        </div>

                        <div class="d-flex justify-content-between align-items-center p-4">
                            <button class="btn w-50 py-2 element-animation" type="button">
                                Inscribirme
                            </button>
                            <small class="text-body-secondary fs-5">@5 hrs</small>
                        </div>

                    </div>
                </div>

                <div class="col curso">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('img/java.jpg') }}" class="card-img-top" height="225px" alt="@coursename">

                        <div class="card-body" style="text-align: justify;">

                            <h3 class="fw-bold fs-4 text-center my-2">@Java desde 0 paso a paso</h3>

                            <p class="card-text">
                                Lenguaje de programación que permite agregar interactividad animaciones y dinamismo a las
                                páginas web
                                modernas.
                            </p>

                        </div>

                        <div class="d-flex justify-content-between align-items-center p-4">
                            <button class="btn w-50 py-2 element-animation" type="button">
                                Inscribirme
                            </button>
                            <small class="text-body-secondary fs-5">@5 hrs</small>
                        </div>

                    </div>
                </div>

                <div class="col curso">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('img/css3.jpg') }}" class="card-img-top" height="225px" alt="@coursename">

                        <div class="card-body" style="text-align: justify;">

                            <h3 class="fw-bold fs-4 text-center my-2">@CSS desde 0 paso a paso</h3>

                            <p class="card-text">
                                Lenguaje de programación que permite agregar interactividad animaciones y dinamismo a las
                                páginas web
                                modernas.
                            </p>

                        </div>

                        <div class="d-flex justify-content-between align-items-center p-4">
                            <button class="btn w-50 py-2 element-animation" type="button">
                                Inscribirme
                            </button>
                            <small class="text-body-secondary fs-5">@5 hrs</small>
                        </div>

                    </div>
                </div>

                <div class="col curso">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('img/curso c.jpg') }}" class="card-img-top" height="225px" alt="@coursename">

                        <div class="card-body" style="text-align: justify;">

                            <h3 class="fw-bold fs-4 text-center my-2">@C# desde 0 paso a paso</h3>

                            <p class="card-text">
                                Lenguaje de programación que permite agregar interactividad animaciones y dinamismo a las
                                páginas web
                                modernas.
                            </p>

                        </div>

                        <div class="d-flex justify-content-between align-items-center p-4">
                            <button class="btn w-50 py-2 element-animation" type="button">
                                Inscribirme
                            </button>
                            <small class="text-body-secondary fs-5">@5 hrs</small>
                        </div>

                    </div>
                </div>

                <div class="col curso">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('img/sql.jfif') }}" class="card-img-top" height="225px" alt="@coursename">

                        <div class="card-body" style="text-align: justify;">

                            <h3 class="fw-bold fs-4 text-center my-2">@SQL desde 0 paso a paso</h3>

                            <p class="card-text">
                                Lenguaje de programación que permite agregar interactividad animaciones y dinamismo a las
                                páginas web
                                modernas.
                            </p>

                        </div>

                        <div class="d-flex justify-content-between align-items-center p-4">
                            <button class="btn w-50 py-2 element-animation" type="button">
                                Inscribirme
                            </button>
                            <small class="text-body-secondary fs-5">@5 hrs</small>
                        </div>

                    </div>
                </div>

                <div class="col curso">
                    <div class="card shadow-sm h-100">
                        <img src="{{ asset('img/html.jpg') }}" class="card-img-top" height="225px" alt="@coursename">

                        <div class="card-body" style="text-align: justify;">

                            <h3 class="fw-bold fs-4 text-center my-2">@HTML desde 0 paso a paso</h3>

                            <p class="card-text">
                                Lenguaje de programación que permite agregar interactividad animaciones y dinamismo a las
                                páginas web
                                modernas.
                            </p>

                        </div>

                        <div class="d-flex justify-content-between align-items-center p-4">
                            <button class="btn w-50 py-2 element-animation" type="button">
                                Inscribirme
                            </button>
                            <small class="text-body-secondary fs-5">@5 hrs</small>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
