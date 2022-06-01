<?php

namespace Dealskoo\Search\Providers;

use Dealskoo\Admin\Facades\AdminMenu;
use Dealskoo\Admin\Facades\PermissionManager;
use Dealskoo\Admin\Permission;
use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');

            $this->publishes([
                __DIR__ . '/../../resources/lang' => resource_path('lang/vendor/search')
            ], 'lang');
        }

        $this->loadRoutesFrom(__DIR__ . '/../../routes/admin.php');

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'search');

        $this->loadTranslationsFrom(__DIR__ . '/../../resources/lang', 'search');

        AdminMenu::whereTitle('admin::admin.settings', function ($menu) {
            $menu->route('admin.searches.index', 'search::search.searches', [], ['permission' => 'searches.index']);
        });

        PermissionManager::add(new Permission('searches.index', 'Search Lists'));
        PermissionManager::add(new Permission('searches.show', 'View Search'), 'searches.index');
        PermissionManager::add(new Permission('searches.create', 'Create Search'), 'searches.index');
        PermissionManager::add(new Permission('searches.edit', 'Edit Search'), 'searches.index');
        PermissionManager::add(new Permission('searches.destroy', 'Destroy Search'), 'searches.index');
    }
}
