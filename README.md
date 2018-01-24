A Laravel front-end scaffolding preset for [Vuetify](https://vuetifyjs.com/) - a Material Component Framework.

Here's the latest documentation on Laravel 5.5:

https://laravel.com/docs/master/

This is where your description should go. Add a little code example so build can understand real quick how the package can be used. Try and limit it to a paragraph or two.

## Contents

- [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

To install this preset on your laravel application, simply run:

``` bash
composer require laravel-frontend-presets/vuetify
```


## Usage
1. Fresh install Laravel 5.5.x and `cd` to your app.
2. Install this preset via `composer require laravel-frontend-presets/vuetify`. Laravel 5.5.x will automatically discover this package. No need to register the service provider.
3. Use `php artisan preset vuetify` for basic Vuetify preset. **OR** Use `php artisan preset vuetify-auth` for basic preset, Auth route entry and Vuetify Auth views in one go. (**NOTE**: If you run this command several times, be sure to clean up the duplicate Auth entries in `routes/web.php`)
4. `npm install`
5. `npm run dev`
6. Configure your favorite database (mysql, sqlite etc.)
7. `php artisan migrate` to create basic user tables.
8. `php artisan serve` (or equivalent) to run server and test preset.

## Screenshots
![Vuetify login screen](/screenshots/vuetify_login_screen.jpg)

## Contributing

Please check our contributing rules in [our website](https://laravel-frontend-presets.github.io) for details.

## Credits

- Sergi Tur Badenas(https://github.com/acacha)
- [All Contributors](../../contributors)

## License

The MIT License (MIT).
