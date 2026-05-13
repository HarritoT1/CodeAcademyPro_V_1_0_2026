var old_values = {};

function asig_listeners_of_submit_forms() {
    'use strict'

    const forms = document.querySelectorAll('.needs-validation')

    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }
            form.classList.add('was-validated');
        }, false)
    })
}

function togglePassword() {
    const password_field = document.getElementById("password");
    const type = password_field.type === "password" ? "text" : "password";
    password_field.type = type;

    const eye_icon = type === "password" ? "http://127.0.0.1:8000/img/eyeclosed.png" : "http://127.0.0.1:8000/img/eyeopened.png";

    document.querySelector("span[onclick='togglePassword()'] > img").src = eye_icon;
}

function matchPasswords() {
    const value_password = document.getElementById('password')?.value?.trim();
    const value_confirm_password = document.getElementById('confirm_password')?.value?.trim();

    const password_feedback = document.getElementById('password_invalid_feedback');
    const confirm_password_feedback = document.getElementById('confirm_password_invalid_feedback');

    //Si ninguna de las contraseñas tiene valor, no mostrar mensaje de error.
    if (!value_password && !value_confirm_password) {
        password_feedback.textContent = 'Ingresa una contraseña válida.';
        confirm_password_feedback.textContent = 'Ingresa una confirmación de contraseña válida.';
        document.getElementById('password')?.classList?.remove('is-invalid');
        document.getElementById('confirm_password')?.classList?.remove('is-invalid');
        document.getElementById('password')?.classList?.remove('is-valid');
        document.getElementById('confirm_password')?.classList?.remove('is-valid');

        document.getElementById('submit')?.setAttribute('disabled', '');
        return;
    }

    if (!(value_password === value_confirm_password)) {
        password_feedback.textContent = 'Las contraseñas no coinciden.';
        confirm_password_feedback.textContent = 'Las contraseñas no coinciden.';

        document.getElementById('password')?.classList?.add('is-invalid');
        document.getElementById('confirm_password')?.classList?.add('is-invalid');

        document.getElementById('password')?.classList?.remove('is-valid');
        document.getElementById('confirm_password')?.classList?.remove('is-valid');

        document.getElementById('submit')?.setAttribute('disabled', '');
        return;
    } else {
        password_feedback.textContent = 'Ingresa una contraseña válida.';
        confirm_password_feedback.textContent = 'Ingresa una confirmación de contraseña válida.';

        document.getElementById('password')?.classList?.remove('is-invalid');
        document.getElementById('confirm_password')?.classList?.remove('is-invalid');

        document.getElementById('password')?.classList?.add('is-valid');
        document.getElementById('confirm_password')?.classList?.add('is-valid');

        document.getElementById('submit')?.removeAttribute('disabled');
        return;
    }
}

async function request_code() {
    const email = document.getElementById('email')?.value?.trim();
    //Validar email no vacio.
    if (!email) {
        alert('Por favor, ingrese un correo electrónico.');
        return;
    }

    try {
        /*const response = await fetch('/userpassword/recovery', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({ 'email': email })
        });*/

        // Simulación de respuesta exitosa.
        const response = {
            ok: true,
            json: async () => ({ message: 'Código de restablecimiento enviado a su correo electrónico.', attemps: 1 }),
        };

        // Simulación de respuesta fallida. Ej: que el email no exista.
        /*const response = {
            ok: false,
            json: async () => ({ message: 'El correo electrónico no está registrado.' })
        };*/

        const data = await response.json();

        if (response.ok) {
            alert(data.message);
            document.getElementById('code_hash')?.removeAttribute('disabled');
            document.getElementById('code_button')?.removeAttribute('disabled');
            document.getElementById('code_request_button')?.setAttribute('disabled', '');
            document.getElementById('email')?.setAttribute('disabled', '');

            document.getElementById('attempts').textContent = `${data.attemps}`;
            return;
        } else {
            alert(data.message);
            window.location.reload();
            return;
        }

    } catch (error) {
        console.error('Error al solicitar el código de restablecimiento:', error);
        alert('Ocurrió un error al solicitar el código. Por favor, inténtelo de nuevo más tarde.');
    }
}

async function validate_response_code() {
    const code_hash = document.getElementById('code_hash')?.value?.trim();

    const html_replace_string = `
        <form id="reset_password" action="{{ route('') }}" method="post" enctype="application/x-www-form-urlencoded"
          class="needs-validation" autocomplete="off" novalidate>
          <!-- Agrega el token CSRF @csrf -->
          <!-- Cambiar metodo HTTP @method('PUT') -->
          <h3 class="text-body-emphasis my-3 fw-bold text-justify" style="font-size: 0.8rem;">Tu usuario es @username, restablece tu contraseña</h3>

          <div class="form-floating my-2">
            <input type="text" maxlength="255" required class="form-control" id="password" name="password"
              placeholder="" value="" />
            <label for="password">Contraseña</label>
            <div class="invalid-feedback" id="password_invalid_feedback">
              Ingresa una contraseña válida.
            </div>
            <div class="valid-feedback">
              Las contraseñas coinciden.
            </div>
          </div>

          <div class="form-floating mb-2">
            <input type="text" maxlength="255" required class="form-control" id="confirm_password"
              name="confirm_password" placeholder="" value="" />
            <label for="confirm_password">Confirmación de contraseña</label>
            <div class="invalid-feedback" id="confirm_password_invalid_feedback">
              Ingresa una confirmación de contraseña válida.
            </div>
            <div class="valid-feedback">
              Las contraseñas coinciden.
            </div>
          </div>

          <div class="d-flex justify-between flex-row align-items-center my-1 gap-3">
            <div class="w-50">
              <hr class="border border-2 opacity-75" style="border-color: var(--extra-color-1) !important;">
            </div>
            <div class="w-50">
              <hr class="border border-2 opacity-75" style="border-color: var(--extra-color-1) !important;">
            </div>
          </div>

          <button id="submit" class="btn my-2 w-100 py-2 element-animation" type="button" onclick="ask_before_submit_new('reset_password')" disabled>
            Actualizar contraseña
          </button>

          <br><br><br><br><br>
        </form>
    `;

    if (!code_hash) {
        alert('Por favor, ingrese un código para validar.');
        return;
    }

    if (code_hash.length !== 6) {
        //Mostrar validacion de Bootstrap.
        document.getElementById('code_hash')?.classList?.add('is-invalid');
        return;
    }

    try {
        document.getElementById('loader_circle')?.classList?.remove('d-none');

        /*const response = await fetch('/userpassword/validate', {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            body: JSON.stringify({ 'code_hash': code_hash.toUpperCase(); })
        });*/

        // Simulación de respuesta exitosa.
        const response = {
            ok: true,
            json: async () => ({ message: 'El código es correcto.', html_replace: html_replace_string }),
        };

        // Simulación de respuesta fallida. Ej: código incorrecto.
        /*const response = {
            ok: false,
            json: async () => ({ message: 'El código es incorrecto.', attemps: 1 })
        };*/

        const data = await response.json();

        if (response.ok) {
            alert(data.message);
            document.getElementById('send_mail')?.remove();
            document.getElementById('change_password')?.insertAdjacentHTML('afterbegin', data.html_replace);
            document.getElementById('change_password')?.classList?.remove('d-none');
            document.getElementById('loader_circle')?.classList?.add('d-none');
            asig_listeners_of_submit_forms();
            document.getElementById('password')?.addEventListener('input', matchPasswords);
            document.getElementById('confirm_password')?.addEventListener('input', matchPasswords);
            return;
        } else {
            alert(data.message);
            if (data.attemps > 0) {
                document.getElementById('attempts').textContent = `${data.attemps}`;
                document.getElementById('code_hash').value = '';
                document.getElementById('loader_circle')?.classList?.add('d-none');
                document.getElementById('code_hash')?.classList?.remove('is-invalid');
                return;
            } else window.location.reload();
        }

    } catch (error) {
        console.error('Error al validar el código de restablecimiento:', error);
        alert('Ocurrió un error al validar el código. Por favor, inténtelo de nuevo más tarde.');
        window.location.reload();
    }
}

function ask_before_submit_new(id_form) {
    if (confirm('¿Estás seguro de esta acción?')) {
        const form = document.getElementById(id_form);
        form.requestSubmit();
    } else return;
}

function previewImage(event, id_img, id_form = "") {
    const fileinput = event.target;
    const preview_img = document.getElementById(id_img);

    if (fileinput.files?.length > 0 && fileinput.files[0] && preview_img) {
        const file = fileinput.files[0];

        if (!file.type?.startsWith("image/")) {
            alert("El archivo seleccionado no es una imagen.");
            fileinput.value = ""; //Vaciamos el FileList para que el usuario pueda seleccionar otro archivo válido.
            if (id_form == "update") window.location.reload();
            else preview_img.src = "http://127.0.0.1:8000/img/default-avatar.png";
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {
            preview_img.src = e.target.result;
        }

        reader.onerror = function (e) {
            console.error('Error al leer el archivo:', e);
            alert('Ocurrió un error al cargar la imagen. Por favor, inténtelo de nuevo.');
            fileinput.value = ""; //Vaciamos el FileList para que el usuario pueda seleccionar otro archivo válido.
            if (id_form == "update") window.location.reload();
            else preview_img.src = "http://127.0.0.1:8000/img/default-avatar.png";
        }

        reader.readAsDataURL(file);
    }

    else {
        if (id_form == "update") window.location.reload();
        else preview_img.src = "http://127.0.0.1:8000/img/default-avatar.png";
    }
}

async function cancelRegistration() {
    if (confirm('¿Estás seguro de cancelar el registro de tu cuenta? Se perderán los datos ingresados.')) {

        console.log('Registro de cuenta cancelado por el usuario.');

        try {
            const response = await fetch('/usernew/cancel', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
            });

            // Simulación de respuesta exitosa.
            /*const response = {
                ok: true,
                json: async () => ({ message: 'Registro cancelado exitosamente.' }),
            };*/

            // Simulación de respuesta fallida.
            /*const response = {
                ok: false,
                json: async () => ({ message: 'No se pudo cancelar el registro. Por favor, inténtelo de nuevo.' }),
            };*/

            const data = await response.json();

            if (response.ok) {
                alert(data.message);
                window.location.href = 'http://codeacademypro.edu:8000/';
                return;
            }
            else {
                alert(`${data.message} Necesitas estar autenticado para cancelar el registro.`);
                return;
            }
        } catch (error) {
            console.error('Error al cancelar el registro:', error);
            alert('Ocurrió un error al cancelar el registro. Por favor, inténtelo de nuevo más tarde.');
            return;
        }

    } else return;
}

function saveValuesofUpdateForm() {
    const inputs = document.querySelectorAll(".form-control");

    old_values = {};

    Array.from(inputs).forEach(input => {
        if (input.type !== "file") old_values[input.name] = input.value.trim();
    });

    const imgs = document.querySelectorAll(".preview-img");

    Array.from(imgs).forEach(img => {
        old_values[img.id] = img.src.trim();
    });

    console.log(window.old_values);

    return;
}

function editForm() {
    document.querySelectorAll(".form-control").forEach(function (input) {
        input.removeAttribute("disabled");
    });

    if (!document.getElementById("preview").src.trim().endsWith("default-avatar.png")) document.getElementById("delete_photo").removeAttribute("disabled");

    document.getElementById("edit").remove();

    document.getElementById("update").insertAdjacentHTML('afterend', `<div class="d-flex flex-row flex-wrap justify-content-end column-gap-2" id="mecanism_of_edition">
                            <button id="cancel" class="btn d-block my-2 px-4 py-2 element-animation" style="background-image: none !important; background-color: rgba(255, 0, 0, 0.863); border: solid black 5px !important; width: 150px;" type="button" onclick="cancelEditForm()">
                                Cancelar
                            </button>                    
                            <button id="save" class="btn d-block my-2 px-4 py-2 element-animation" style="background-image: none !important; background-color: rgba(0, 81, 255, 0.863); border: solid black 5px !important; width: 150px;" type="button" onclick="ask_before_submit('update')">
                                Actualizar
                            </button>
                        </div>`);
}

function cancelEditForm() {
    if (confirm('¿Estás seguro de cancelar la edición de tu perfil? Se perderán los cambios realizados.')) {
        window.location.reload();
        return;
    }

    else return;
}

function ask_before_submit(id_form) {
    //Validar que al menos un campo tenga un valor diferente al original.
    const inputs = document.querySelectorAll(".form-control");

    let has_changes = Array.from(inputs).some(input => {
        if (input.type !== "file" && input.value.trim() !== old_values[input.name]) return true;
        return false;
    });

    const imgs = document.querySelectorAll(".preview-img");

    has_changes = has_changes || Array.from(imgs).some(img => {
        if (img.src.trim() !== old_values[img.id]) return true;
        return false; 
    });

    if (!has_changes) {
        alert('No se han realizado cambios en el formulario.');
        return;
    }

    console.log('Cambios detectados en el formulario. Solicitando confirmación para enviar.');

    if (confirm('¿Estás seguro de actualizar tu perfil?')) {
        const form = document.getElementById(id_form);
        form.requestSubmit();
    } else return;
}


function deletePhoto(event, id_img) {
    if (confirm('¿Estás seguro de eliminar tu foto de perfil?')) {
        const path = document.getElementById(id_img).src.trim();

        if (!path || path.endsWith("default-avatar.png")) {
            alert('No hay una foto de perfil para eliminar.');
            return;
        }

        document.getElementById(id_img).src = "http://127.0.0.1:8000/img/default-avatar.png";

        event.target.setAttribute("disabled", "");

        document.getElementById('update')?.insertAdjacentHTML('afterend', `<input type="hidden" name="${id_img}" value="${path}">`);

        return;
    } else return;
}


async function registerAdvance(event, id, type) {
    if (confirm("¿Estas seguro de esta acción?")) {
        try {
            /*const response = await fetch('/register/advance', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                },
                body: JSON.stringify({ 'id': id, 'type': type })
            });*/

            // Simulación de respuesta exitosa.
            const response = {
                ok: true
            };

            // Simulación de respuesta fallida.
            /*const response = {
                ok: false,
            };*/

            if (response.ok) {
                const div_success = document.getElementById('succes_div');
                div_success.style.visibility = 'visible';
                div_success.style.opacity = '1';

                setTimeout(() => {
                    if (div_success) {
                        div_success.style.opacity = '0';
                        div_success.style.visibility = 'hidden';
                    }
                }, 3000);

                event.target.remove();

                return;
            } else {
                const error_div = document.getElementById('error_div');
                error_div.style.visibility = 'visible';
                error_div.style.opacity = '1';

                setTimeout(() => {
                    if (error_div) {
                        error_div.style.opacity = '0';
                        error_div.style.visibility = 'hidden';
                    }
                }, 3000);
                return;
            }

        } catch (error) {
            console.error('Error al registrar el avance:', error);
            alert('Ocurrió un error al registrar el avance. Por favor, inténtelo de nuevo más tarde.');
            return;
        }
    } else return;
}
