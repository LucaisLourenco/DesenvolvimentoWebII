<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.datalist-eixo', 'datalist-eixo');
        Blade::component('components.datalist-curso', 'datalist-curso');
        Blade::component('components.datalist-disciplina', 'datalist-disciplina');
        Blade::component('components.datalist-professor', 'datalist-professor');
        Blade::component('components.datalist-disciplina-professor', 'datalist-disciplina-professor');

    }
}
