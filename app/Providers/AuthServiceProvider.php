<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Docente;
use App\Models\Novedad;
use App\Models\Estudios;
use App\Policies\DocentePolicy;
use App\Policies\EstudiosPolicy;
use App\Policies\NovedadesPolicy;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Docente::class => DocentePolicy::class,
        Estudios::class => EstudiosPolicy::class,
        Novedad::class => NovedadesPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        VerifyEmail::toMailUsing(function($notifiable, $url) {
            return (new MailMessage)
                ->subject('Verificar Cuenta')
                ->line('Tu Cuenta ya esta casi lista, solo debes presionar el enlace a continuación')
                ->action('Confirmar Cuenta', $url)
                ->line('Si no creaste esta Cuenta, puedes ignorar este mensaje');
        });
    }
}
