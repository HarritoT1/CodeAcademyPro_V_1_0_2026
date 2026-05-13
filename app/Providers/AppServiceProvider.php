<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Verifica tu correo electrónico')
                ->greeting('¡Hola estimado usuario de CodeAcademyPro!')
                ->line('Gracias por registrarte en nuestra plataforma.')
                ->line('Por favor verifica tu correo electrónico haciendo clic en el botón de abajo.')
                ->action('Verificar correo electrónico', $url)
                ->line('Si no creaste una cuenta, puedes ignorar este mensaje.')
                ->salutation('Saludos, CodeAcademyPro');
        });
    }
}
