<?php

namespace Users\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use App\Interfaces\RepositoryStore;
use App\Repositories\BaseRepositoryStore;
use Illuminate\Http\Request;
use Users\Models\Country;

/**
 * Class Repository
 * @package App\Repositories
 * @version December 11, 2019, 2:33 pm UTC
 */
class CountryRepositoryStore extends BaseRepositoryStore implements RepositoryStore, BaseRepositoryInterface
{

    /**
     * @var array
     */
    protected $fieldSearchable = [
        'provider_id'
    ];


    /**
     * Use save data into Model
     *
     * @param Request $request
     * @return Boolean
     */
    public function save($data)
    {
        // check weather is there id or not
        $type = $this->create($data);
        return $type;
    }

    /**
     * Use save data into Model
     *
     * @param Request $request
     * @param Int $id
     * @return Boolean
     */
//    public function update($id, $data, $filter = null)
//    {
//        $type = $this->model->WHERE('id', $id);
//        if ($filter)
//            $type = $type->WHERE($filter);
//        $type = $type->update($data);
//        if (isset($type) && isset($request->selected)) {
//            $type->syncPermissions($request->selected);
//        }
//        return $type;
//    }


    /**
     * Remove data from the Repository
     *
     * @param Request $request
     * @param Int $id
     * @return Boolean
     */
//    public function delete($id, $request)
//    {
//        $delete = $this->model->newQuery();
//        if ($request)
//            $delete = $delete->where($request);
//        if ($delete->findOrFail($id)->delete())
//            return true;
//        return false;
//    }

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Country::class;
    }
}
