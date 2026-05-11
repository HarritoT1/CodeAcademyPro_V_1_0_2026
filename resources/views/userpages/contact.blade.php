@extends('userpages.layout')
@section('content')
    <div class="px-5 mb-5 pb-5">
        <h1 class="text-center mt-5 mb-5 fw-bold fs-2">
            CodeAcademyPro.com tiene el soporte <br> de los siguientes colaboradores:
        </h1>

        <div class="container marketing">
            <div class="row">
                <div class="col-lg-4">
                    <img src="{{ asset('img/ing1.png') }}" class="bd-placeholder-img rounded-circle image-responsive mb-3"
                        style="width: 140px; height: 140px;" alt="Ing. Harol Gael Cárdenas Trejo">

                    <h2 class="fw-normal">Ing. Harol</h2>

                    <p>
                        ¡Hola! Encargado del desarrollo Backend de CodeAcademyPro.com
                    </p>

                    <p>
                        <button class="btn my-2 px-4 py-2 element-animation"
                            onclick="window.location.href='mailto:firebase.proyect.library@gmail.com'">
                            Contacto
                        </button>
                    </p>
                </div>

                <div class="col-lg-4">
                    <img src="{{ asset('img/ing2.jpg') }}" class="bd-placeholder-img rounded-circle image-responsive mb-3"
                        style="width: 140px; height: 140px;" alt="Ing. Karina Sayuri Díaz Martínez">

                    <h2 class="fw-normal">Ing. Sayuri</h2>

                    <p>
                        ¡Holaaaaaa! ¿Que te parece el Frontend de CodeAcademy.com?
                    </p>

                    <p>
                        <button class="btn my-2 px-4 py-2 element-animation"
                            onclick="window.location.href='mailto:firebase.proyect.library@gmail.com'">
                            Contacto
                        </button>
                    </p>
                </div>

                <div class="col-lg-4">
                    <img src="{{ asset('img/ing3.jfif') }}" class="bd-placeholder-img rounded-circle image-responsive mb-3"
                        style="width: 140px; height: 140px;" alt="Ing. Japhet León Carmona">

                    <h2 class="fw-normal">Ing. Japhet</h2>

                    <p>
                        ¡Saludos! Negociaciones y gestión del proyecto CodeAcademyPro.com
                    </p>

                    <p>
                        <button class="btn my-2 px-4 py-2 element-animation"
                            onclick="window.location.href='mailto:firebase.proyect.library@gmail.com'">
                            Contacto
                        </button>
                    </p>
                </div>
            </div>

            <hr class="featurette-divider" />

            <div class="row featurette justify-content-between">
                <div class="col-md-6">
                    <h2 class="featurette-heading fw-bold lh-1 mb-4 fs-1">
                        ¿Qué es CodeAcademy.com?
                    </h2>
                    <p class="lead" style="text-align: justify;">
                        Plataforma educativa en línea sin fines de lucro que ofrece cursos de programación con
                        certificaciones
                        completamente gratuitas y sin necesidad de suscripción.
                    </p>
                </div>
                <div class="col-md-5">
                    <img src="{{ asset('img/logo.png') }}" class="featurette-image img-fluid mx-auto image-responsive"
                        width="500" height="500" alt="Logotipo CodeAcademyPro">
                </div>
            </div>

            <hr class="featurette-divider" />

            <div class="row featurette justify-content-between">
                <div class="col-md-6 order-md-2">
                    <h2 class="featurette-heading fw-bold lh-1 mb-4 fs-1 text-md-end mt-5">
                        ¿Qué obtienes en este sitio web?
                    </h2>

                    <p class="lead mb-5" style="text-align: justify;">
                        Obtienes certificaciones gratis y aprendizaje autónomo para
                        mejorar tus habilidades como desarrollador de software.
                    </p>
                </div>
                <div class="col-md-5 order-md-1">
                    <img src="{{ asset('img/certificado.png') }}"
                        class="featurette-image img-fluid mx-auto image-responsive" width="500" height="500"
                        alt="Certificado CodeAcademyPro">
                </div>
            </div>

            <hr class="featurette-divider" />

            <div class="row featurette justify-content-between">
                <div class="col-md-6">
                    <h2 class="featurette-heading fw-bold lh-1 mb-4 fs-1 mt-5">
                        ¿Te gustaría acudir al área de trabajo?
                    </h2>

                    <p class="lead mb-5" style="text-align: justify;">
                        Aquí te compartimos el croquis de Google Maps de nuestra ubicación.
                    </p>
                </div>
                <div class="col-md-5 text-center">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3765.800639725075!2d-99.00064212574249!3d19.291033945188573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ce1cdb9988f43d%3A0x349f35ed189e88f2!2sInstituto%20Tecnol%C3%B3gico%20de%20Tl%C3%A1huac!5e0!3m2!1ses-419!2smx!4v1777853982207!5m2!1ses-419!2smx"
                        allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>

        </div>
    </div>
@endsection
