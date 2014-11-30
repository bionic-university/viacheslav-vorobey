<?php
/**
 * MVC Framework Component
 *
 * @author vorobeyme
 * @package BionicUniversity\Eventmapia\Core\Db
 * @link https://github.com/bionic-university/viacheslav-vorobey/tree/master/project
 */

namespace BionicUniversity\Eventmapia\Core\Db;

/**
 * Class Database
 *
 */
class Database extends \PDO
{
    /** @var string $sql */
    private $sql;

    /** @var mixed $fetchType PDO fetch types */
    private $fetchType = \PDO::FETCH_ASSOC;

    /**
     * Constructor
     * Initialize a PDO connection
     *
     * @param array $db An associative array with DB settings
     */
    public function __construct(array $db)
    {
        $persistent = isset($db['persistent']) ? $db['persistent'] : false;
        parent::__construct("{$db['type']}:host={$db['host']};dbname={$db['name']}", $db['user'], $db['pass'], array(\PDO::ATTR_PERSISTENT => $persistent));
    }

    /**
     * Execute SQL query
     * $db->query('UPDATE user SET name = :name WHERE id = :id,
     *           [:name => 'Mike', ':id' => $id], [':name' => \PDO::PARAM_STR, ':id' => \PDO::PARAM_INT]');
     *
     * @param string $sql
     * @param array $params
     * @param array $types
     * @return integer The number of rows
     */
    public function query($sql, $params = [], $types = [])
    {
        $stmt = $this->prepare($sql);

        foreach ($params as $key => &$param) {
            $stmt->bindParam(':'.$key, $param, isset($types[$key]) ? $types[$key] : \PDO::PARAM_STR);

            //(is_int($param)
            //? $stmt->bindValue(':'.$key, $param, \PDO::PARAM_INT)
            //: $stmt->bindValue(':'.$key, $param, \PDO::PARAM_STR);
        }

        $stmt->execute($params);
        return $stmt->rowCount();
    }

    /**
     * Create a select query
     * @param string $query
     */
    public function select($query)
    {
        // @TODO:
    }

    /**
     * Create an insert query
     * @param string $table The table to insert into
     * @param array $data An associative array of data (['field' => 'value'])
     * @throws \Exception
     * @return int Last inserted ID
     */
    public function insert($table, $data = [])
    {
        $fields = implode('`, `', array_keys($data));
        $values = ':' . implode(', :', array_keys($data));

        $this->sql = 'INSERT INTO `' . $table . '` (`'.$fields.'`) VALUES('.$values.')';

        $stmt = $this->prepare($this->sql);

        foreach ($data as $key => $value) {
            (is_int($value))
            ? $stmt->bindValue(':'.$key, $value, \PDO::PARAM_INT)
            : $stmt->bindValue(':'.$key, $value, \PDO::PARAM_STR);
        }

        $result = $stmt->execute();
        if (!$result) {
            throw new \Exception(__FUNCTION__ . ' did not execute properly');
        }

        return $this->lastInsertId();
    }

    /**
     * Create an update query
     * @param string $table
     */
    public function update($table)
    {
        // @TODO:
    }

    /**
     * Create a delete query
     * @param string $table
     */
    public function delete($table)
    {
        // @TODO:
    }

    /**
     * Return an array with first row
     * $db->fetchRow('SELECT * FROM user WHERE id = :id AND email = :email', [':id' => $id, ':email' => $email]);
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function fetchRow($sql, $params = [])
    {
        $stmt = $this->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    /**
     * Return an array with all rows
     * $db->fetchAll('SELECT * FROM user WHERE id = :id', [':id' => $id]);
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function fetchAll($sql, $params = [])
    {
        $stmt = $this->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    /**
     * Return an array with one column
     * $db->fetchColumn('SELECT name FROM user WHERE id = :id', [':id' => $id])
     *
     * @param string $sql
     * @param array $params
     * @return array
     */
    public function fetchColumn($sql, $params = [])
    {
        $stmt = $this->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * Return first field from first element
     * $db->fetchOne('SELECT name FROM user WHERE id = :id', [':id' => $id]);
     *
     * @param string $sql
     * @param array $params
     * @return string
     */
    public function fetchOne($sql, $params = [])
    {
        $stmt = $this->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(\PDO::FETCH_COLUMN);
    }
}
