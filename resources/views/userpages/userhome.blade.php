@extends('userpages.layout')
@section('content')
    <div>
        <div class="position-relative overflow-hidden p-3 p-md-5 mb-md-3 text-center bg-body-tertiary text-white"
            style="background-image: url('{{ asset('img/banner.gif') }}'); background-size: cover">
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
                        style="height: 100% !important; width: 20rem !important; background: url('{{ asset('img/js.png') }}') no-repeat center / contain;"
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
                        style="height: 100% !important; width: 20rem !important; background: url('{{ asset('img/c.png') }}') no-repeat center / contain;"
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
                        style="height: 100% !important; width: 20rem !important; background: url('{{ asset('img/python.png') }}') no-repeat center / contain;"
                        href="" target="_self" title="Ir al curso"></a>
                </div>
            </div>

            <div class="bg-body-tertiary me-md-3 pt-3 px-3 pt-md-5 px-md-5 text-center overflow-hidden"
                style="outline: 3px solid white;">
                <a class="mt-3 pt-3 element-animation text-body pb-0" href="" target="_self" title="Ir al curso">
                    <h2 class="display-5 fw-bold">Curso: @coursename</h2>
                    <p class="lead d-flex flex-row justify-content-center gap-1 my-1">
                        <img class="image-responsive" src="{{ asset('img/trofeo.png') }}" alt="Completado:"
                            style="width: 2rem; margin: 0 0 !important">100%
                    </p>
                </a>

                <!-- if Termino el curso -->
                <a class="element-animation d-block p-0 mb-3 btnCertificado" title="Generar certificado"
                    onclick="generateCertificate('course_id')">Obtener certificado</a>
                <!-- if Termino el curso -->

                <div class="bg-dark shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
                    <a class="element-animation"
                        style="height: 100% !important; width: 20rem !important; background: url('{{ asset('img/java.webp') }}') no-repeat center / contain;"
                        href="" target="_self" title="Ir al curso"></a>
                </div>
            </div>
        </div>

    </div>
@endsection
