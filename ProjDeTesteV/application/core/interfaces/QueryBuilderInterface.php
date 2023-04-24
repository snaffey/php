<?php

/**
 * Interface QueryBuilderInterface
 * @author Rafael Velosa
 */
interface QueryBuilderInterface{

    /**
     * select field, field
     * @param array $fields
     * @return mixed
     */
    public function select(array $fields);

    /**
     * insert into table
     * @param string $table
     * @return mixed
     */
    public function insert(string $table);

    /**
     * update table
     * @param string $table
     * @return mixed
     */
    public function update(string $table);

    /**
     * delete from table
     * @param string $table
     * @return mixed
     */
    public function delete(string $table);

    /**
     * retorna a query
     * @return string
     */
    public function getQuery();
}