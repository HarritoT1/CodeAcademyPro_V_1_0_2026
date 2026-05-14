@extends('userpages.layout')
@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.body.style.backgroundImage = "var(--body-background)";
            document.getElementById("op1").style.color = "rgba(185, 4, 217, 1)";
        });
    </script>

    <div>
        <div class="position-relative overflow-hidden p-3 p-md-5 mb-md-3 text-center bg-body-tertiary text-white"
            style="background-image: url('{{ asset('img/banner.gif') }}'); background-size: cover">
            <div class="col-md-7 p-lg-5 mx-md-auto my-5 mx-1">
                <h1 class="display-4 fw-bold">Bienvenido {{ $user->name }}, aquí puedes acceder a tus cursos. </h1>
                <h3 class="fw-normal text-muted mb-3" style="color: white !important;">
                    Puedes visualizar el porcentaje de avance en cada curso.
                </h3>

                <div class="d-flex gap-3 justify-content-center lead fw-normal">
                    <a class="icon-link element-animation" href="{{ route('newcourses') }}" target="_self" title="Más cursos">
                        Más cursos
                        <svg class="bi" aria-hidden="true">
                            <use xlink:href="#chevron-right"></use>
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="row w-100 my-md-3 justify-content-center gap-5 pt-5 mx-auto">

            @forelse ($user_courses as $course)
                <div class="col-md-5 col-11 bg-body-tertiary pt-3 px-3 pt-md-5 px-md-5 d-flex flex-column text-center overflow-hidden"
                    style="outline: 3px solid white;">
                    <a class="my-3 py-3 element-animation text-body" href="{{ route('course', ['course' => $course->id]) }}" target="_self" title="Ir al curso">
                        <h2 class="display-5 fw-bold">Curso: {{ $course->course_name }}</h2>
                        <p class="lead d-flex align-items-center justify-content-center gap-2">
                            @if ($course->progress == 100)
                                <img class="image-responsive" src="{{ asset('img/trofeo.png') }}" alt="Completado:"
                                    style="width: 2rem; margin: 0 0 !important">
                            @else
                                <img class="image-responsive" src="{{ asset('img/progreso.png') }}" alt="Progreso:"
                                    style="width: 2rem; margin: 0 0 !important">
                            @endif{{ $course->progress }}%
                        </p>
                    </a>

                    @if ($course->progress == 100)
                        <a class="element-animation d-block p-0 mb-3 btnCertificado" title="Generar certificado"
                            onclick="generateCertificate('{{ $course->id }}')">Obtener certificado</a>
                    @else
                        <div class="element-animation d-block p-0 mb-3 text-warning fw-bold">- - - Tu puedes ya casi lo logras - - -</div>
                    @endif

                    <div class="bg-dark shadow-sm mx-auto" style="width: 80%; height: 300px; border-radius: 21px 21px 0 0;">
                        <a class="element-animation"
                            style="height: 100% !important; width: 20rem !important; background: url('{{ asset($course->image_url) }}') no-repeat center / contain;"
                            href="{{ route('course', ['course' => $course->id]) }}" target="_self" title="Ir al curso"></a>
                    </div>
                </div>
            @empty
                <p class="text-center fs-2 fw-bold lh-base text-warning">No tienes cursos asignados. Por favor, inscribete a
                    uno de nuestros cursos.</p>
            @endforelse

        </div>

    </div>
@endsection
