<?php

namespace Users\Services;

use App\Helpers\MoreImplementation;
use App\Interfaces\ServiceShow;
use Illuminate\Http\Request;
use Users\Repositories\CountryRepositoryShow;

class CountryServiceShow implements ServiceShow
{
    public $repo;

    /**
     * Create a new Repository instance.
     *
     * @param TypeRepository $repository
     * @return void
     */
    public function __construct(CountryRepositoryShow $repository)
    {
        $this->repo = $repository;
    }

    /**
     * Use Search Criteria from request to find from Repository
     *
     * @param Request $request
     * @return Collection
     */

    public function find_by(Request $request): object
    {
        MoreImplementation::setWith(['activities']);
        $types = $this->repo->find_by($request->all());
        return $types;
    }

    /**
     * Use id to find from Repository
     *
     * @param Int $id
     */
    public function find($id, Request $request): object
    {
            $type = $this->repo->find($id);
            return $type;
    }


}
