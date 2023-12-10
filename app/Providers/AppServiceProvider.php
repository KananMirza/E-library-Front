<?php

namespace App\Providers;

use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\impl\AuthorRepositoryImpl;
use App\Repositories\impl\BookRepositoryImpl;
use App\Repositories\impl\CategoryRepositoryImpl;
use App\Repositories\impl\LeaseStatusRepositoryImpl;
use App\Repositories\impl\PenaltyTypeRepositoryImpl;
use App\Repositories\impl\PublisherRepositoryImpl;
use App\Repositories\impl\ShelfRepositoryImpl;
use App\Repositories\impl\UserRepositoryImpl;
use App\Repositories\LeaseStatusRepository;
use App\Repositories\PenaltyTypeRepository;
use App\Repositories\PublisherRepository;
use App\Repositories\ShelfRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthorRepository::class,AuthorRepositoryImpl::class);
        $this->app->bind(CategoryRepository::class,CategoryRepositoryImpl::class);
        $this->app->bind(PublisherRepository::class,PublisherRepositoryImpl::class);
        $this->app->bind(ShelfRepository::class,ShelfRepositoryImpl::class);
        $this->app->bind(LeaseStatusRepository::class,LeaseStatusRepositoryImpl::class);
        $this->app->bind(PenaltyTypeRepository::class,PenaltyTypeRepositoryImpl::class);
        $this->app->bind(UserRepository::class,UserRepositoryImpl::class);
        $this->app->bind(BookRepository::class,BookRepositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
