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

    /**
     * Returns all rows of the model's table.
     * @return array
     */
    public function all()
    {
        return $this->connection->selectAll($this->table);
    }

    /**
     * Returns a specific row found by id.
     * @param $id
     * @param array $columns
     * @return array
     */
    public function find($id, $columns = [])
    {
        $this->id = $id;
        return $this->connection->select($this->table, $columns, $id);
    }

    /**
     * Inserts a new row in the model's table.
     * @param $data
     */
    public function create($data)
    {
        return $this->connection->insert($this->table, $data);
    }

    /**
     * Deletes a row by id in the model's table.
     * @param $id
     */
    public function delete($id)
    {
        return $this->connection->delete($this->table, $id);
    }

    /**
     * Updates a row by id in the model's table.
     * @param $data
     * @param null $id
     * @throws \Exception
     */
    public function update($data, $id = null)
    {
        if (isset($this->id)) $id = $this->id;
        return $this->connection->update($this->table, $data, $id);
    }
}
