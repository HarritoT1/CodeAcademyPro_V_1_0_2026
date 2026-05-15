@extends('userpages.layout')
@section('content')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById("op2").style.color = "rgba(185, 4, 217, 1)";
        });
    </script>

    <section class="p-5 text-center" style="width: 95% !important; margin: 0 auto !important;">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-bold">Descubre nuevos cursos aquí e inscribete </h1>
                <p class="lead text-body-secondary">
                    Busca el curso que necesites:
                </p>
                <input type="text" id="buscar" placeholder="Nombre del curso" class="form-control">

                @if($errors->any())
                    @foreach ($errors->all() as $error)
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert" style="text-align: center">
                        {{ $error }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close me-2"></button>
                    </div>
                    @endforeach
                @endif

                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert" style="text-align: center">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close me-2"></button>
                    </div>
                @endif

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
                @empty($newcourses)
                    <p class="w-100 text-center fs-2 fw-bold lh-base text-warning">¡Ups no hay cursos nuevos por el momento!</p>
                @else
                    @foreach ($newcourses as $course)
                        @if ($course->is_visible && $course->topics()->count() > 0)
                            <div class="col curso">
                                <div class="card shadow-sm h-100">
                                    <img src="{{ asset('storage/' . $course->image_url) }}" class="card-img-top" height="225px"
                                        alt="{{ $course->course_name }}">

                                    <div class="card-body" style="text-align: justify;">

                                        <h3 class="fw-bold fs-4 text-center my-2">{{ $course->course_name }}</h3>

                                        <p class="card-text">
                                            {{ $course->description }}
                                        </p>

                                    </div>

                                    <div class="d-flex justify-content-between align-items-center p-4">
                                        <form action="{{ route('newcourses.inscription', ['course' => $course->id]) }}"
                                            method="post" class="w-50">
                                            @csrf
                                            <button class="btn w-100 py-2 element-animation" type="submit">
                                                Inscribirme
                                            </button>
                                        </form>
                                        <small class="text-body-secondary fs-5">{{ $course->duration }} hrs</small>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @endempty
            </div>
        </div>
    </div>
@endsection
