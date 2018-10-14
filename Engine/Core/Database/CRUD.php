<?php

namespace Engine\Core\Database;

trait CRUD
{
    protected $db;

    protected $table;

    /**
     * @param mixed $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    protected $queryBuilder;

    public function __construct()
    {
        global $di;

        $this->db = $di->get('db');
        $this->queryBuilder = new QueryBuilder();
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        $sql = $this->queryBuilder->select()
            ->from($this->table)
            ->sql();

        return $this->db->fetchAll($sql);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getOne($id)
    {
        $sql = $this->queryBuilder->select()
            ->from($this->table)
            ->where('id',$id)
            ->sql();

        return $this->db->fetch($sql,$id);
    }

    /**
     * @param array $fields
     * @return mixed
     */
    public function add($fields = [])
    {
        $sql = $this->queryBuilder->insert($this->table)
            ->set($fields)
            ->sql();

        return $this->db->execute($sql, $this->queryBuilder->values);
    }

    /**
     * @return mixed
     */
    public function getLastId()
    {
        return $this->db->getLastId();
    }

    /**
     * @param array $fields
     * @param       $column
     * @param       $value
     * @return mixed
     */
    public function update(array $fields = [], $column, $value)
    {
        $sql = $this->queryBuilder->update($this->table)
            ->set($fields)
            ->where($column, $value)
            ->sql();

        return $this->db->execute($sql, $this->queryBuilder->values);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id)
    {
        $sql = $this->queryBuilder->delete()
            ->from($this->table)
            ->where('id',$id)
            ->sql();

        return $this->db->execute($sql,[$id]);
    }

}