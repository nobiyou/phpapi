<?php
/**
 * contains properties and methods for "category" database queries.
 */
class Category
{
    //db conn and table
    private $conn;
    private $table_name = 'categories';

    //object properties
    public $id;
    public $name;
    public $description;
    public $created;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    //used by select drop-down list
    public function create()
    {
        //query insert
        $query = 'INSERT INTO
              '.$this->table_name.'
              SET
                name=:name, description=:description, pid=:pid, created=:created';

        //Prepare
        $stmt = $this->conn->prepare($query);

        //sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->pid = htmlspecialchars(strip_tags($this->pid));
        $this->created = htmlspecialchars(strip_tags($this->created));

        //Bind values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':pid', $this->pid);
        $stmt->bindParam(':created', $this->created);

        //execute
        //var_dump($stmt);
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    //update Category
    public function update()
    {
        //update query
        $query = 'UPDATE
                    '.$this->table_name.'
                    SET
                        name=:name,
                        description=:description,
                        pid=:pid,
                        modified=:modified
                    WHERE
                        id=:id';

        //prepare
        $stmt = $this->conn->prepare($query);

        //sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->pid = htmlspecialchars(strip_tags($this->pid));
        $this->modified = htmlspecialchars(strip_tags($this->modified));

        //bind new values
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':pid', $this->pid);
        $stmt->bindParam(':modified', $this->modified);

        //execute
        //var_dump($stmt->execute());
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    //Read Category
    public function read()
    {
        $query = 'SELECT
                    id, name, description
                 FROM '.$this->table_name.'
                 ORDER BY name';

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    //read single Category
    public function readOne()
    {
        $query = '
        SELECT
        id, name, description
        FROM
        '.$this->table_name.'
        WHERE
          id = ?
        LIMIT 1 OFFSET 0';
        //prepare
        $stmt = $this->conn->prepare($query);
        //bind id of Category
        $stmt->bindParam(1, $this->id);
        //execute
        $stmt->execute();
        //fetch row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        //set values to update
        $this->name = $row['name'];
        $this->description = $row['description'];
    }

    //delete Category
    public function delete()
    {
        //delete query
        $query = ' DELETE FROM '.$this->table_name.' WHERE id = ?';

        //prepare
        $stmt = $this->conn->prepare($query);
        //var_dump($stmt );

        //sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));

        //bind id
        $stmt->bindParam(1, $this->id);

        //var_dump($this->id);

        //execute
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
