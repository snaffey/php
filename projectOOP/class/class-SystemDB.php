To fix the issue of "unexpected public" on line 102, we need to close the `insert()` function before defining the `delete()` function. Here's the updated code:

```
<?php

class SystemDB
{
    //SINGLETON
    private static $instance;

    /* DB Properties */
    public $host = 'localhost';
    public $db_name = '';
    public $password = '';
    public $user = 'root';
    public $charset = 'utf8';
    public $pdo = null;
    public $error = null;
    public $debug = false;
    public $last_id = null;

    public function __construct($host = null, $db_name = null, $password = null, $user = null, $charset = null, $debug = null)
    {
        $this->host = defined('HOSTNAME') ? HOSTNAME : $this->host;
        $this->db_name = defined('DB_NAME') ? DB_NAME : $this->db_name;
        $this->password = defined('DB_PASSWORD') ? DB_PASSWORD : $this->password;
        $this->user = defined('DB_USER') ? DB_USER : $this->user;
        $this->charset = defined('DB_CHARSET') ? DB_CHARSET : $this->charset;
        $this->debug = defined('DEBUG') ? DEBUG : $this->debug;
        $this->connect();
    }

    final protected function connect()
    {
        $pdo_details = "mysql:host={$this->host};";
        $pdo_details .= "dbname={$this->db_name};";
        $pdo_details .= "charset={$this->charset};";
        try {
            $this->pdo=self::getInstance($pdo_details, $this->user, $this->password);
            unset($this->host, $this->db_name, $this->password, $this->user, $this->charset);
        } catch(PDOException $e) {
            if ($this->debug === true) {
                $this->error = $e->getMessage();
                die();
            }
        }
    }

    public static function getInstance($d, $u, $p)
    {
        if (!isset(self::$instance)) {
            self::$instance = new PDO($d, $u, $p);
        }
        echo "Connected";
        return self::$instance;
    }

    public function query($stmt, $data_array = null)
    {
        $query = $this->pdo->prepare($stmt);
        $check_exec = query->execute($data_array);
        if ($check_exec) {
            return $query;
        } else {
            $error = $query->errorInfo();
            $this->error = $error[2];
        }
        return false;
    }

    public function insert($table)
    {
        //Configura o array de colunas
        $cols = array();
        //Configura o valor inicial do modelo
        $place_holders = '(';
        //Configura o array de valores
        $values = array();
        // O $j ira assegura que colunas serão configuradas apenas uma vez
        $j = 1;
        // Obtem os argumentos enviados
        $data = func_get_args();
        // é preciso enviar pelo menos uma array com as chave e valores
        if (!isset($data[1]) || !is_array($data[1])) {
            return;
        }

        for ($i=1; $i < count($data[1]); $i++) {
            //Obtem as chaves como colunas e valores
            foreach ($data[$i] as $col => $val) {
                //A primeira volta do lado configurará as colunas
                if ($i === 1) {
                    $cols[] = "`$col`";
                }
                //Configura os divisores
                if ($j <> $i) {
                    $place_holders .= '),(';
                }
                //Configura os placeholders do PDO
                $place_holders .= '?,';
                $values[] = $val;
                $j = $i;
            }
            // Remove os caracteres extra dos place holders
            $place_holders = substr($place_holders, 0, strlen($place_holders)-2);
        }

        $cols = implode(',', $cols);
        $stmt = "INSERT INTO `$table` ($cols) VALUES $place_holders)";
        //insere os dados
        $insert = $this->query($stmt, $values);
        if ($insert) {
            if (method_exists($this->pdo, 'lastInsertId') && $this->pdo->lastInsertId()) {
                $this->last_id = $this->pdo->lastInsertId();
            }
            return $insert;
        }
    }

    public function delete($table, $where_field, $where_field_value)
    {
        if (empty($table) || empty($where_field) || empty($where_field_value)) {
            return false;
        }
        $stmt = "DELETE FROM `$table`";
        $where = " WHERE `$where_field` = ?";
        $stmt .= $where;
        $values = array($where_field_value);
        $query = $this->prepare($stmt);
        $query->bind_param('s', $values[0]);
        $delete = $query->execute();
        return $delete;
    }

    public function update($table, $where_field, $where_field_value, $values)
    {
        if (empty($table) || empty($where_field) || empty($where_field_value) || empty($values)) {
            return;
        }
        $stmt = "UPDATE `$table` SET ";
        $where = " WHERE `$where_field` = ?";
        $set = array();
        if (!is_array($values)) {
            return;
        }
        foreach ($values as $col => $val) {
            $set[] = "`$col` = ?";
        }
        $set = implode(',', $set);
        $stmt .= $set . $where;
        $values[] = $where_field_value;
        $values = array_values($values);
        $update = $this->query($stmt, $values);
        if ($update) {
            return $update;
        }
        return;
    }
}
?>