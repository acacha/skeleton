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
        (new Filesystem)->delete(public_path('js/app.js'));
        (new Filesystem)->delete(public_path('css/app.css'));
    }

    /**
     * Update the bootstrapping files.
     *
     * @return void
     */
    protected static function updateBootstrapping()
    {
        copy(__DIR__.'/vuetify-stubs/webpack.mix.js', base_path('webpack.mix.js'));
        copy(__DIR__.'/vuetify-stubs/app.js', resource_path('assets/js/app.js'));
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
        copy(__DIR__.'/stubs-stubs/Controllers/HomeController.php', app_path('Http/Controllers/HomeController.php'));

        // Add Auth routes in 'routes/web.php'
        $auth_route_entry = "Auth::routes();\n\nRoute::get('/home', 'HomeController@index')->name('home');\n\n";
        file_put_contents('./routes/web.php', $auth_route_entry, FILE_APPEND);

        // Copy vuetify auth views from the stubs folder
        (new Filesystem)->copyDirectory(__DIR__.'/foundation-stubs/views', resource_path('views'));
    }
}
