<?php

namespace LaravelFrontendPresets\VuetifyPreset;

use Artisan;
use Illuminate\Support\Arr;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;

/**
 * Class VuetifyPreset.
 *
 * @package LaravelFrontendPresets\VuetifyPreset
 */
class VuetifyPreset extends Preset
{
    /**
     * Install the preset.
     *
     * @return void
     */
    public static function install($withAuth = false)
    {
        static::updatePackages();
        static::updateStyles();
        static::updateBootstrapping();

        if($withAuth)
        {
            static::addAuthTemplates(); // optional
        }
        else
        {
            static::updateWelcomePage(); //optional
        }

        static::removeNodeModules();
    }

    /**
     * Update the given package array.
     *
     * @param  array  $packages
     * @return array
     */
    protected static function updatePackageArray(array $packages)
    {
        $packagesToAdd = ['vuetify' => '^0.17.6'];
        $packagesToRemove = ['bootstrap-sass'];
        return $packagesToAdd + Arr::except($packages, $packagesToRemove);
    }

    /**
     * Update styles.
     *
     */
    protected static function updateStyles()
    {
        (new Filesystem)->deleteDirectory(resource_path('assets/sass'));
        if (! file_exists(resource_path('assets/css'))) {
            mkdir(resource_path('assets/css'));
        }
        copy(__DIR__.'/vuetify-stubs/resources/assets/css/app.css', resource_path('assets/css/app.css'));

        if (! file_exists(public_path('assets'))) {
            mkdir(public_path('assets'));
        }

        copy(__DIR__.'/assets/hero.jpeg', public_path('assets/hero.jpeg'));
        copy(__DIR__.'/assets/logo.png', public_path('assets/logo.png'));
        copy(__DIR__.'/assets/plane.jpg', public_path('assets/plane.jpg'));
        copy(__DIR__.'/assets/section.jpg', public_path('assets/section.jpg'));
        copy(__DIR__.'/assets/vuetify.png', public_path('assets/vuetify.png'));
    }

    /**
     * Update the bootstrapping files.
     *
     * @return void
     */
    protected static function updateBootstrapping()
    {
        copy(__DIR__.'/vuetify-stubs/webpack.mix.js', base_path('webpack.mix.js'));
        copy(__DIR__.'/vuetify-stubs/resources/assets/js/bootstrap.js', resource_path('assets/js/bootstrap.js'));
        copy(__DIR__.'/vuetify-stubs/resources/assets/js/app.js', resource_path('assets/js/app.js'));

        if (! file_exists(resource_path('assets/js/app.js'))) {
            mkdir(public_path('assets'));
        }
    }

    /**
     * Update the default welcome page file.
     *
     * @return void
     */
    protected static function updateWelcomePage()
    {
        // remove default welcome page
        (new Filesystem)->delete(
            resource_path('views/welcome.blade.php')
        );

        // copy new one from your stubs folder
        copy(__DIR__.'/vuetify-stubs/views/welcome.blade.php', resource_path('views/welcome.blade.php'));
    }

    /**
     * Copy Auth view templates.
     *
     * @return void
     */
    protected static function addAuthTemplates()
    {
        // Add Home controller
        copy(__DIR__.'/vuetify-stubs/Controllers/HomeController.php', app_path('Http/Controllers/HomeController.php'));

        // Add Auth routes in 'routes/web.php'
        $auth_route_entry = "Auth::routes();\n\nRoute::get('/home', 'HomeController@index')->name('home');\n\n";
        file_put_contents('./routes/web.php', $auth_route_entry, FILE_APPEND);

        // Copy vuetify auth views from the stubs folder
        (new Filesystem)->copyDirectory(__DIR__.'/vuetify-stubs/views', resource_path('views'));
    }
}
