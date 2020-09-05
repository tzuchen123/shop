<?php

namespace App\Providers;


use App\ProductType;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('allProductTypes', ProductType::all());
         // Using class based composers...
         View::composer(
            'test', function($view){
                $view->with('test', ProductType::all());
            }
        );

        view()->composer(
            'test',
            \App\Http\View\Composers\TypeComposer::class
        );
    }
}
