<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\View\Composers\UserComposer;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //

        // Use following code if you prefer to create a class
        // Based view composer otherwise use callback
        
        // View::composer('post.list', PostComposer::class);

        // Use following code if you want to use callback
        // Based view composer instead of class based view composer
        View::composer('pages.users', function ($view) {

            // following code will create $posts variable which we can use
            // in our post.list view you can also create more variables if needed
            $view->with('users', User::orderByDesc('created_at')->paginate()); } );
    }
}
