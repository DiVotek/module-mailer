<?php

namespace Modules\MailSender\Providers;

use App;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MailSenderServiceProvider extends ServiceProvider
{
    protected string $moduleName = 'MailSender';

    public function boot(): void
    {
        $this->mergeConfigFrom(
            module_path('MailSender', 'config/settings.php'),
            'settings'
        );
        $this->loadMigrations();
        View::addNamespace('mail-sender', base_path('Modules/MailSender/Resources/views'));
    }

    public function register(): void
    {
    }

    private function loadMigrations(): void
    {
        $this->loadMigrationsFrom(module_path($this->moduleName, 'Migrations'));
    }
}
