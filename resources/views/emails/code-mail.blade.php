<x-mail::message>
# {{ $greeting }}

Hemos recibido una solicitud para restablecer la contraseña de tu cuenta.

Para continuar con el proceso, utiliza el siguiente código de verificación:

<x-mail::panel>
# {{ $code }}
</x-mail::panel>

Este código expirará a las {{ $time }}.

Intentos restantes disponibles: {{ $attempts }}.

Si no realizaste esta solicitud, puedes ignorar este mensaje de forma segura. Por seguridad, te recomendamos no compartir este código con nadie.

{{ $salutation }}
</x-mail::message>