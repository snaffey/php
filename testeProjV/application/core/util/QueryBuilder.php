<?php


/**
 * Class QueryBuilder
 * @author Rafael Velosa
 */
class QueryBuilder implements QueryBuilderInterface{

    /**
     * Guarda a query
     * @var string $query
     */
    protected string $query="";

    /**
     * select
     * @param array|string[] $fields
     * @return $this|mixed
     */
    public function select(array $fields=['*']){
        $this->query = "select " . implode(", ", $fields);
        return $this;
    }

    /**
     * from
     * @param string $table
     * @return $this
     */
    public function from(string $table){
        $this->query .= " from $table";
        return $this;
    }

    /**
     * where
     * @param string $exp
     * @return $this
     */
    public function where(string $exp){
        $this->query .= " where $exp";
        return $this;
    }

    public function on(string $exp){
        $this->query .= " on $exp";
        return $this;
    }

    /**
     * order by
     * @param string $field
     * @param string $direction
     * @return $this
     */
    public function orderBy(string $field, string $direction){
        $this->query .= " order by $field $direction";
        return $this;
    }

    /**
     * limit
     * @param $limit
     * @return $this
     */
    public function limit($limit){
        $this->query .= " limit $limit";
        return $this;
    }

    /**
     * insert
     * @param string $table
     * @return $this|mixed
     */
    public function insert(string $table){
        $this->query = "insert into $table";
        return $this;
    }

    /**
     * values
     * @param array $values
     * @param array $colums
     * @return $this
     */
    public function values(array $values, array $colums=[]){
        if (!empty($colums))
            $this->query .= " (".implode(', ', $colums).")";
        $this->query .= " values (".implode(', ', $values).")";
        return $this;
    }

    /**
     * update
     * @param string $table
     * @return $this|mixed
     */
    public function update(string $table){
        $this->query = "update $table";
        return $this;
    }

    /**
     * set
     * @param array $columValues
     * @return $this
     */
    public function set(array $columValues){
        $this->query .= " set ".implode(', ', $columValues);
        return $this;
    }

    /**
     * delete
     * @param string $table
     * @return $this|mixed
     */
    public function delete(string $table){
        $this->query = "delete from $table";
        return $this;
    }

    /**
     * Retorna a query
     * @return string
     */
    public function getQuery(){
        $query = $this->query.';';
        $this->query = "";
        return $query;
    }

    /**
     * reseta a query
     * @return $this
     */
    public function resetQuery(){
        $this->query = "";
        return $this;
    }
}