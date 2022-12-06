<?php

namespace App\Services\Response;

use App\Exceptions\ServiceException;
use App\Repositories\BaseEloquentRepository;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Container\BindingResolutionException;
use Prettus\Repository\Eloquent\BaseRepository;

abstract class BaseService
{
    protected BaseEloquentRepository $repository;

    private Application $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->makeRepository();
        $this->boot();
    }

    public function boot(): void
    {
        //
    }

    public function getRepository(): BaseRepository
    {
        return $this->repository;
    }

    public function resetRepository(): void
    {
        $this->makeRepository();
    }

    abstract public function repository(): string;

    /**
     * @throws ServiceException
     * @throws BindingResolutionException
     */
    public function makeRepository(): void
    {
        $repository = $this->app->make($this->repository());

        if (!$repository instanceof BaseEloquentRepository) {
            throw new ServiceException("Class {$this->repository()} must be an instance of "
                . BaseEloquentRepository::class);
        }

        $this->repository = $repository;
    }
}
