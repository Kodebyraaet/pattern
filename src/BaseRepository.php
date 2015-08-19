<?php namespace Kodebyraaet\Pattern;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * The query builder object
     * @var Builder
     */
    protected $builder;

    /**
     * The Model object
     * @var Model
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
    public function whereIn($field, array $values)
    {
        $this->builder = $this->builder->whereIn($field, array $values);

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
     * Pluck a field from the database
     *
     * @param  string $field
     * @return Collection
     */
    public function pluck($field)
    {
        $results = $this->builder->pluck($field);

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
     * Deletes an item
     *
     * @param  integer $id
     * @return bool
     */
    public function delete($id)
    {
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