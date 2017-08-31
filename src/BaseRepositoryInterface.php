<?php

namespace Kodebyraaet\Pattern;

use Illuminate\Database\Eloquent\Collection;

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
     * Query wether or not the relationship is empty of now.
     *
     * @param        $relation
     * @param string $operator
     * @param int    $count
     *
     * @return $this
     */
    public function has($relation, $operator = '>=', $count = 1);

    /**
     * By default a soft-deleted model does not return trashed. Use this
     * method to also fetch soft-deleted entries.
     *
     * @return $this
     */
    public function withTrashed();

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
     *
     * @param  string $field
     * @param  array  $values
     * @param  bool   $order
     *
     * @return $this
     */
    public function whereIn($field, $values, $order);

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
     * Get an array with the values of a given column.
     *
     * @param      $column
     * @param null $key
     * @return \Illuminate\Support\Collection
     */
    public function lists($column, $key = null);

    /**
     * Pluck a field from the database
     *
     * @param  string $field
     * @return Collection
     *
     * @deprecated
     */
    public function pluck($field);

    /**
     * Pluck a field from the database
     *
     * @param  string $field
     * @return Collection
     *
     * @deprecated
     */
    public function value($field);

    /**
     * Create a new item
     *
     * @param array $data
     * @return mixed
     */
    public function create(array $data);

    /**
     * Find an item by given values, or create it if it doesn't exist
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreate(array $data);

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
    public function delete($id = null);

	/**
	 * Orders items by latest
	 *
	 * @return mixed
	 */
    public function latest();
}
