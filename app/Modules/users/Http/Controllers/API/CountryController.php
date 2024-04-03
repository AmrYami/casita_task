<?php

namespace Users\Http\Controllers\API;

use Illuminate\Http\Response;
use Users\Http\Requests\API\CreateCountryRequest;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use Users\Http\Requests\API\UpdateCountryRequest;
use Users\Http\Resources\CountryResource;
use Users\Services\CountryServiceShow;
use Users\Services\CountryServiceStore;

class CountryController extends BaseController
{

    /**
     * @var CountryServiceShow
     */
    private $serviceShow;
    /**
     * @var CountryServiceStore
     */
    private $typeServiceStore;

    public function __construct(CountryServiceShow $serviceShow, CountryServiceStore $typeServiceStore)
    {
        $this->serviceShow = $serviceShow;
        $this->typeServiceStore = $typeServiceStore;
    }

    /**
     * Display a listing of the Country.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $countries = $this->serviceShow->find_by($request);
        return ResponseHelper(200, 'success_create', true, CountryResource::collection($countries));
    }

    /**
     * Store a newly created Country in storage.
     *
     * @return Response
     */
    public function store(CreateCountryRequest $request)
    {
        try {
            $country = $this->typeServiceStore->save($request);
            return ResponseHelper(200, 'success_create', true, $country);
        } catch (Throwable $exception) {
            return ResponseHelper(code: 500, message: $exception->getMessage());
        }
    }

    /**
     * Display the specified Country.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {


    }

    /**
     * Update the specified Country in storage.
     *
     * @param int $id
     * @param UpdateChannelRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCountryRequest $request)
    {
        try {
            $country = $this->typeServiceStore->update($id, $request);
            return ResponseHelper(200, __('messages.Updated', ['thing' => 'User Country']), true, $country);
        } catch (Throwable $exception) {
            return ResponseHelper(code: 500, message: $exception->getMessage());
        }
    }

    /**
     * Remove the specified Country from storage.
     *
     * @param int $id
     *
     * @return Response
     * @throws \Exception
     *
     */
    public function destroy(Request $request, $id)
    {
        $delete = $this->typeServiceStore->delete($request, $id);
        if ($delete) {
            return redirect()->route('admins.types.index')->with('deleted', __('messages.Deleted', ['thing' => 'User Country']));
        } else {
            return redirect()->route('admins.types.index')->with('deleted', __('messages.You can\'t delete type that has users!!'));
        }
    }
}
