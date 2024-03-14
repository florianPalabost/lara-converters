<?php

declare(strict_types=1);

namespace App\Providers;

use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Dedoc\Scramble\Support\Generator\SecuritySchemes\OAuthFlow;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // throw exception when :
        // - Lazy loading relationship
        // - Assigning non-fillable attributes
        // - Accessing attributes that don’t exist (or weren’t retrieved).
        Model::shouldBeStrict(! app()->isProduction());

        Health::checks([
            UsedDiskSpaceCheck::new(),
            DatabaseCheck::new(),
            EnvironmentCheck::new(),
        ]);

        Scramble::extendOpenApi(function (OpenApi $openApi) {
            $openApi->secure(
                SecurityScheme::oauth2()
                    ->flow('implicit', function (OAuthFlow $flow) {
                        $flow
                            ->authorizationUrl(route('google.redirect'))
                            ->addScope('convert', 'convert files')
                            ->addScope('write:files', 'modify files');
                    })
            );
        });

    }
}
