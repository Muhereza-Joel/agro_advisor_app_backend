<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

// Add your models and policies
use TomatoPHP\FilamentMediaManager\Models\Media;
use App\Policies\MediaPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Media::class => MediaPolicy::class,
        // You can register more here
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // Optional: register gates here too
        // Gate::define('something', function (User $user) { return true; });
    }
}
