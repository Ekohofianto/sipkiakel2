const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .copy('node_modules/bootstrap/dist/css/bootstrap.css', 'public/css/bootstrap.css')
   .styles([
       'https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.7/datatables.min.css',
   ], 'public/css/datatables.css')
   .scripts([
       'https://code.jquery.com/jquery-3.6.0.min.js',
       'https://cdn.datatables.net/v/dt/jq-3.7.0/dt-2.0.7/datatables.min.js',
   ], 'public/js/datatables.js');

mix.version();
