<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\App\Repositories\BookRepository::class, \App\Repositories\BookRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\CategoryRepository::class, \App\Repositories\CategoryRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AuthorRepository::class, \App\Repositories\AuthorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BookAuthorRepository::class, \App\Repositories\BookAuthorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PublisherRepository::class, \App\Repositories\PublisherRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BookImageRepository::class, \App\Repositories\BookImageRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BookAuthorRepository::class, \App\Repositories\BookAuthorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BookRepository::class, \App\Repositories\BookRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AuthorRepository::class, \App\Repositories\AuthorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BookAuthorRepository::class, \App\Repositories\BookAuthorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\BookImageRepository::class, \App\Repositories\BookImageRepositoryEloquent::class);
        //:end-bindings:
    }
}
