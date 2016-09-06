<?php

namespace Kodebyraaet\Pattern;

use Illuminate\Database\Eloquent\Collection;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * The query builder object
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;

    /**
     * The Model object
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->newBuilder();

        return $this;
    }

    /**
     * Eager load relations
     *
     * @param  array $relations
     * @return $this
     */
    public function with(array $relations)
    {
        $this->builder = $this->builder->with($relations);

        return $this;
    }

    /**
     * By default a soft-deleted model does not return trashed. Use this
     * method to also fetch soft-deleted entries.
     *
     * @return $this
     */
    public function withTrashed()
    {
        $this->builder = $this->builder->withTrashed();

        return $this;
    }


    /**
     * Add a where to the query
     * @param  string $field
     * @param  string $operator
     * @param  string $value
     * @return $this
     */
    public function where($field, $operator = null, $value = null)
    {
        // If there is only two arguments, the second one is the value
        if (func_num_args() == 2) {
            $value = $operator;
            $operator = '=';
        }

        $this->builder = $this->builder->where($field, $operator, $value);

        return $this;
    }

    /**
     * Add a whereIn to the query
     * @param  string $field
     * @param  array $values
     * @return $this
     */
    public function whereIn($field, $values)
    {
        $this->builder = $this->builder->whereIn($field, $values);

        return $this;
    }

    /**
     * Add a whereNull to the query
     *
     * @param $field
     * @return mixed
     */
    public function whereNull($field)
    {
        $this->builder = $this->builder->whereNull($field);

        return $this;
    }

    /**
     * Add a whereNotNull to the query
     *
     * @param $field
     * @return mixed
     */
    public function whereNotNull($field)
    {
        $this->builder = $this->builder->whereNotNull($field);

        return $this;
    }

    /**
     * Limit the number of rows returned
     *
     * @param  integer $limit
     * @return $this
     */
    public function limit($limit)
    {
        $this->builder = $this->builder->limit($limit);

        return $this;
    }

    /**
     * Skip a certain amount of rows
     *
     * @param  integer $skip
     * @return $this
     */
    public function skip($skip)
    {
        $this->builder = $this->builder->skip($skip);

        return $this;
    }

    /**
     * Add order by to the query
     *
     * @param  string $column
     * @param  string $direction
     * @return $this
     */
    public function orderBy($column, $direction = 'ASC')
    {
        $this->builder = $this->builder->orderBy($column, $direction);

        return $this;
    }

    /**
     * Will get entries from a specified page
     *
     * @param  integer  $page
     * @param  integer  $perPage
     * @return $this
     */
    public function page($page, $perPage = 15)
    {
        $offset = ($page * $perPage) - $perPage;

        $this->builder = $this->builder->take($perPage)->skip($offset);

        return $this;
    }

    /**
     * Count rows
     *
     * @return Integer
     */
    public function count()
    {
        // Save the results from the builder
        $result = $this->builder->count();

        // Reset the builder, just in case we are going to use this repository more then once
        $this->newBuilder();

        return $result;
    }

    /**
     * Return the first element
     *
     * @return Collection
     */
    public function first()
    {
        // Save the results from the builder
        $result = $this->builder->first();

        // Reset the builder, just in case we are going to use this repository more then once
        $this->newBuilder();

        return $result;
    }

    /**
     * Return an element of a given ID
     *
     * @param integer $id
     * @return Collection
     */
    public function find($id)
    {
        // Save the results from the builder
        $results = $this->builder->find($id);

        // Reset the builder, just in case we are going to use this repository more then once
        $this->newBuilder();

        // Return stuff
        return $results;
    }

    /**
     * Return the elements
     *
     * @return Collection
     */
    public function get()
    {
        // Save the results from the builder
        $results = $this->builder->get();

        // Reset the builder, just in case we are going to use this repository more then once
        $this->newBuilder();

        // Return stuff
        return $results;
    }

    /**
     * Get an array with the values of a given column.
     *
     * @param      $column
     * @param null $key
     * @return \Illuminate\Support\Collection
     */
    public function lists($column, $key = null)
    {
        // Save the results from the builder
        $results = $this->builder->lists($column, $key);

        // Reset the builder, just in case we are going to use this repository more then once
        $this->newBuilder();

        // Return stuff
        return $results;
    }

    /**
     * Pluck a field from the database
     *
     * @param  string $field
     * @return Collection
     *
     * @deprecated
     */
    public function pluck($field)
    {
        return $this->value($field);
    }

    /**
     * Pluck a field from the database
     *
     * @param  string $field
     * @return Collection
     */
    public function value($field)
    {
        $results = $this->builder->value($field);

        $this->newBuilder();

        return $results;
    }

    /**
     * Create a new item
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data)
    {
        $item = $this->builder->create($data);

        // Reset the query builder
        $this->newBuilder();

        return $item;
    }

    /**
     * Find an item by given values, or create it if it doesn't exist
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreate(array $data)
    {
        $item = $this->builder->firstOrCreate($data);

        // Reset the query builder
        $this->newBuilder();

        return $item;
    }

    /**
     * Update an item
     *
     * @param integer $id
     * @param array   $data
     * @return mixed
     */
    public function update($id, array $data)
    {
        $item = $this->builder->find($id);
        $item->update($data);

        // Reset the query builder
        $this->newBuilder();

        return $item;
    }

    /**
     * Deletes an item if an id is specified, deletes all queried entries otherwise
     *
     * @param  integer $id
     * @return bool
     */
    public function delete($id = null)
    {
        if ($id === null) {
            $delete = $this->builder->delete();
            $this->newBuilder();
            return $delete;
        }

        return $this->builder->destroy($id);
    }

    /**
     * Create a new / reset the query builder object
     *
     * @return Void
     */
    protected function newBuilder()
    {
        $class = get_class($this->model);

        $this->builder = new $class;
    }
}
