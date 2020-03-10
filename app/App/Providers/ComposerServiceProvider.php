<?php

namespace CreatyDev\App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use CreatyDev\App\ViewComposers\CountriesComposer;
use CreatyDev\App\ViewComposers\PermissionsComposer;
use CreatyDev\App\ViewComposers\PlansComposer;
use CreatyDev\App\ViewComposers\RolesComposer;
use CreatyDev\App\ViewComposers\UserCompaniesComposer;
use CreatyDev\App\ViewComposers\UserFiltersComposer;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //plans
        View::composer([
            'subscriptions.index'
        ], PlansComposer::class);

        //countries
        View::composer([
            'account.twofactor.index'
        ], CountriesComposer::class);

//        //categories
//        View::composer([
//            'layouts.blog.partials._navigation',
//            'blog.partials._categories_filters_list'
//        ], CategoriesComposer::class);

        //user companies
        View::composer('*', UserCompaniesComposer::class);

        //user filters mappings
        View::composer([
            'admin.users.partials._filters'
        ], UserFiltersComposer::class);

        //roles list
        View::composer([
            'admin.users.roles.partials.forms._roles',
            'admin.users.user.roles.index'
        ], RolesComposer::class);

        //permissions list
        View::composer([
            'admin.users.roles.partials.forms._permissions',
        ], PermissionsComposer::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UserCompaniesComposer::class);
    }
}
