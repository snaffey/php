<?php
namespace Phppot;

class Validate
{

    private $dbConn;

    function __construct()
    {
        require_once __DIR__ . '/DataSource.php';
        $db = new DataSource();
        $this->dbConn = $db->getConnection();
    }

    public function validateUser($username, $password)
    {
        $isValid = false;
        $query = "SELECT * FROM users WHERE username = ? AND password = ?";
        $paramType = "ss";
        $paramArray = array(
            $username,
            $password
        );
        $userRecord = $this->select($query, $paramType, $paramArray);
        if (! empty($userRecord)) {
            $isValid = true;
        }
        return $isValid;
    }

    public function select($query, $paramType, $paramArray)
    {
        $stmt = $this->dbConn->prepare($query);
        $this->bindQueryParams($stmt, $paramType, $paramArray);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row;
    }

    private function bindQueryParams($stmt, $paramType, $paramArray = array())
    {
        $paramValueReference[] = & $paramType;
        for ($i = 0; $i < count($paramArray); $i ++) {
            $paramValueReference[] = & $paramArray[$i];
        }
        call_user_func_array(array(
            $stmt,
            'bind_param'
        ), $paramValueReference);
    }
}