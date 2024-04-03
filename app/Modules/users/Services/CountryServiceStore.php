<?php

namespace Users\Services;

use App\Abstratctions\Service;
use App\Interfaces\ServiceStore;
use App\Suppliers\Sender;
use Illuminate\Http\Request;
use Users\Models\Country;
use Users\Repositories\CountryRepositoryShow;
use Users\Repositories\CountryRepositoryStore;

class CountryServiceStore extends Service implements ServiceStore
{
    public $repo;
    /**
     * @var CountryRepositoryStore
     */
    private $countryRepositoryStore;
    /**
     * @var CountryRepositoryShow
     */
    private $countryRepositoryShow;
    /**
     * @var Country
     */
    private $model;

    /**
     * Create a new Repository instance.
     *
     * @param CountryRepositoryStore $countryRepositoryStore
     * @param CountryRepositoryShow $countryRepositoryShow
     */
    public function __construct(CountryRepositoryStore $countryRepositoryStore, CountryRepositoryShow $countryRepositoryShow,
                                Country                $model)
    {
        $this->typeRepositoryStore = $countryRepositoryStore;
        $this->typeRepositoryShow = $countryRepositoryShow;
        $this->model = $model;
    }


    /**
     * Use save data into Repository
     *
     * @param Request $request
     * @return Boolean
     */
    public function save(Request $request)
    {
        $data = $request->only($this->model->getFillable());
        $country = $this->typeRepositoryStore->create($data);

        //send object to webhook receiver;
        $provider = new Sender();
        $provider->setData();
        @$provider->updateStatus($request, $country);
        //send object to webhook receiver;

        return $country;
    }

    /**
     * Use save data into Repository
     *
     * @param Request $request
     * @return Boolean
     */
    public function update($id, Request $request)
    {
        $data = $request->only($this->model->getFillable());
        $country = $this->typeRepositoryStore->update($id, $data);
//        if ($country)
//            $countryObject = $this->typeRepositoryShow->find($id);
//        $this->langServiceStore->update($country->id, $request, $this->model->table);
        return $country;
//
    }

    /**
     * Remove data from the Repository
     *
     * @param Request $request
     * @param Int $id
     * @return Boolean
     */
    public function delete(Request $request, $id = null)
    {
        $this->clean_request($request);
        $delete = $this->typeRepositoryStore->delete($id, $request->all());
//        if ($delete)
//            $this->langServiceStore->delete($request, $id, $this->model->table);
        return $delete;
    }

}

