<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\Passport;

/**
 * Class AuthServiceProvider.
 */
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // Remove reference to non-existent ModelPolicy to avoid ReflectionException during
        // boot when policies are registered. Add real mappings here as needed.
        // 'App\\Model' => 'App\\Policies\\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Only call Passport::routes() when the method exists to avoid errors
        // during composer scripts or environments where Passport isn't available
        if (class_exists(\Laravel\Passport\Passport::class) && method_exists(\Laravel\Passport\Passport::class, 'routes')) {
            Passport::routes();
        }
    }
}
