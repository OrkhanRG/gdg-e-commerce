<?php

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\RateLimitServiceProvider::class,
    Spatie\Permission\PermissionServiceProvider::class,
    \UniSharp\LaravelFilemanager\LaravelFilemanagerServiceProvider::class,
    \Intervention\Image\Laravel\ServiceProvider::class,
];
