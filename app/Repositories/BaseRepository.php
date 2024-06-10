<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Container\Container as Application;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

abstract class BaseRepository
{
    /**
     * @var Model
     */
    protected $model;

    protected $paginationLimit = 10;
    protected $connect_user;

    /**
     * @throws \Exception
     * @author CodeCampers/boukhar Soufiane
    */

    public function __construct()
    {
        $this->makeModel();
    }

    /**
     * Get searchable fields array
     * @author CodeCampers/boukhar Soufiane
    */

    abstract public function getFieldsSearchable(): array;

    /**
     * Configure the Model
     * @author CodeCampers/boukhar Soufiane
    */

    abstract public function model(): string;

    /**
     * Make Model instance
     *
     * @throws \Exception
     * @return Model
     * @author CodeCampers/boukhar Soufiane
    */

    public function makeModel()
    {
        $model = app($this->model());

        if (!$model instanceof Model) {
            throw new \Exception("Class {$this->model()} must be an instance of Illuminate\\Database\\Eloquent\\Model");
        }

        return $this->model = $model;
    }

    /**
     * Paginate records for scaffold.
     * @author CodeCampers/boukhar Soufiane
    */

    public function paginate($search = [], $perPage = null, array $columns = ['*']): LengthAwarePaginator
    {
        $query = $this->allQuery($search);

        if (is_null($perPage)) {
            $perPage = $this->paginationLimit;
        }
        return $query->paginate($perPage, $columns);
    }

    /**
     * Build a query for retrieving all records.
     * @author CodeCampers/boukhar Soufiane
    */
    public function allQuery($search = [], int $skip = null, int $limit = null): Builder
    {
        $query = $this->model->newQuery();

        if (is_array($search)) {
            if (count($search)) {
                foreach ($search as $key => $value) {
                    if (in_array($key, $this->getFieldsSearchable())) {
                        if (!is_null($value)) {
                            $query->where($key, $value);
                        }
                    }
                }
            }
        } else {
            if (!is_null($search)) {
                foreach ($this->getFieldsSearchable() as $searchKey) {
                    $query->orWhere($searchKey, 'LIKE', '%' . $search . '%');
                }
            }
        }

        if (!is_null($skip)) {
            $query->skip($skip);
        }

        if (!is_null($limit)) {
            $query->limit($limit);
        }

        return $query;
    }

    /**
     * Retrieve all records with given filter criteria
     * @author CodeCampers/boukhar Soufiane
    */

    public function all(array $search = [], int $skip = null, int $limit = null, array $columns = ['*']): Collection
    {
        $query = $this->allQuery($search, $skip, $limit);

        return $query->get($columns);
    }

    /**
     * Create model record
     * @author CodeCampers/boukhar Soufiane
    */

    public function create(array $input): Model
    {
        $model = $this->model->newInstance($input);

        $model->save();

        return $model;
    }

    /**
     * Find model record for given id
     *
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     * @author CodeCampers/boukhar Soufiane
    */

    public function find(int $id, array $columns = ['*'])
    {
        $query = $this->model->newQuery();

        return $query->find($id, $columns);
    }

    /**
     * Update model record for given id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model
     * @author CodeCampers/boukhar Soufiane
    */

    public function update(array $input, int $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        $model->fill($input);

        $model->save();

        return $model;
    }

    /**
     * @throws \Exception
     * @return bool|mixed|null
     * @author CodeCampers/boukhar Soufiane
    */

    public function delete(int $id)
    {
        $query = $this->model->newQuery();

        $model = $query->findOrFail($id);

        return $model->delete();
    }

    public function where($model,$key,$row){
       $model=  new $model;
       $query= $model->newQuery();
       return $query->where($key,$row);
    }
}
