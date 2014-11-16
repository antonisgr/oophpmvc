<?php namespace Oophpmvc\Database;

class Model implements \Antonis\Crudable
{
    protected $connection;
    protected $table;
    protected $id = null;

    public function __construct()
    {
        // model's table is by convention its name in plural
        $this->table = strtolower(get_class($this)) . 's';
        $this->connection = new Database(DB_DSN, DB_USER, DB_PASS);
    }

    public function all()
    {
        return $this->connection->selectAll($this->table);
    }

    public function find($id, $columns = [])
    {
        $this->id = $id;
        return $this->connection->select($this->table, $columns, $id);
    }

    public function create($data)
    {
        return $this->connection->insert($this->table, $data);
    }

    public function delete($id)
    {
        return $this->connection->delete($this->table, $id);
    }

    public function update($data, $id = null)
    {
        if (isset($this->id)) $id = $this->id;
        return $this->connection->update($this->table, $data, $id);
    }
}
