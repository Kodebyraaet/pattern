<?php namespace Kodebyraaet\Pattern;

interface BaseRepositoryInterface
{
    /**
     * Eager load relations
     *
     * @param  array $relations
     * @return $this
     */
    public function with(array $relations);

    /**
     * Add a where to the query
     * 
     * @param  string $field
     * @param  string $operator
     * @param  string $value
     * @return $this
     */
    public function where($field, $operator = null, $value = null);

    /**
     * Add a whereIn to the query
     * @param  string $field
     * @param  array $values
     * @return $this
     */
    public function whereIn($field, $values);

    /**
     * Add a whereNull to the query
     * @param $field
     * @return mixed
     */
    public function whereNull($field);

    /**
     * Add a whereNotNull to the query
     * @param $field
     * @return mixed
     */
    public function whereNotNull($field);

    /**
     * Limit the number of rows returned
     *
     * @param  integer $limit
     * @return $this
     */
    public function limit($limit);

    /**
     * Skip a certain amount of rows
     *
     * @param  integer $skip
     * @return $this
     */
    public function skip($skip);

    /**
     * Add order by to the query
     *
     * @param  string $column
     * @param  string $direction
     * @return $this
     */
    public function orderBy($column, $direction = 'ASC');

    /**
     * Will get entries from a specified page
     *
     * @param  integer  $page
     * @param  integer  $perPage
     * @return $this
     */
    public function page($page, $perPage = 15);

    /**
     * Count total rows
     *
     * @return Integer
     */
    public function count();

    /**
     * Return the first element
     *
     * @return Collection
     */
    public function first();

    /**
     * Return an element of a given ID
     *
     * @param integer $id
     * @return Collection
     */
    public function find($id);

    /**
     * Return the elements
     *
     * @return Collection
     */
    public function get();

    /**
     * Pluck a field from the database
     *
     * @param  string $field
     * @return Collection
     */
    public function pluck($field);

    /**
     * Create a new item
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Update an item
     *
     * @param integer $id
     * @param array   $data
     * @return mixed
     */
    public function update($id, array $data);

    /**
     * Deletes an item
     *
     * @param  integer $id
     * @return bool
     */
    public function delete($id);
}