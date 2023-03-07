<?php
namespace Phppot;

class Member
{

    private $ds;

    function __construct()
    {   
        $upTwo = dirname(__DIR__, 2);
        require_once $upTwo . '/lib/DataSource.php';
        $this->ds = new DataSource();
    }

    public function isUsernameExists($username)
    {
        $query = 'SELECT * FROM `User` where username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $resultArray = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function isEmailExists($email)
    {
        $query = 'SELECT * FROM `User` where email = ?';
        $paramType = 's';
        $paramValue = array(
            $email
        );
        $resultArray = $this->ds->select($query, $paramType, $paramValue);
        $count = 0;
        if (is_array($resultArray)) {
            $count = count($resultArray);
        }
        if ($count > 0) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    public function registerMember()
    {

        $response = array();

    if (!empty($_POST["signup-btn"])) {
        $username = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
        $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
        $password = filter_var($_POST["signup-password"], FILTER_SANITIZE_STRING);
        $confirmPassword = filter_var($_POST["confirm-password"], FILTER_SANITIZE_STRING);

            // Check if password and confirm password match
            if ($password !== $confirmPassword) {
                $response["status"] = "error";
                $response["message"] = "Password and confirm password do not match.";
                return $response;
            }

            $query = "SELECT MAX(ID) as max_id FROM `User`";
            $result = $this->ds->select($query);
            if (! empty($result)) {
                $maxID = intval($result[0]["max_id"]);
                $_POST["ID"] = $maxID + 1;
            }

            $isUsernameExists = $this->isUsernameExists($_POST["username"]);
            $isEmailExists = $this->isEmailExists($_POST["email"]);
            if ($isUsernameExists) {
                $response = array(
                    "status" => "error",
                    "message" => "Username already exists."
                );
            } else if ($isEmailExists) {
                $response = array(
                    "status" => "error",
                    "message" => "Email already exists."
                );
            } else {
                if (! empty($_POST["signup-password"])) {
                    $hashedPassword = password_hash($_POST["signup-password"], PASSWORD_DEFAULT);
                }
                $query = 'INSERT INTO `User` (ID, username, password, email, Nivel) VALUES (?, ?, ?, ?, ?)';
                $paramType = 'isssi';
                $paramValue = array(
                    $_POST["ID"],
                    $_POST["username"],
                    $hashedPassword,
                    $_POST["email"],
                    1
                );
                $memberId = $this->ds->insert($query, $paramType, $paramValue);
                if (! empty($memberId)) {
                    $response = array(
                        "status" => "success",
                        "message" => "You have registered successfully."
                    );
                    header("Refresh: 3; url=./login.php");
                } else {
                    $response = array(
                        "status" => "error",
                        "message" => "Problem in registration. Try Again!"
                    );
                }
            }
            return $response;
        }
    }

    public function getMember($username)
    {
        $query = 'SELECT * FROM `User` where username = ?';
        $paramType = 's';
        $paramValue = array(
            $username
        );
        $memberRecord = $this->ds->select($query, $paramType, $paramValue);
        return $memberRecord;
    }

    public function loginMember()
    {
        $memberRecord = $this->getMember($_POST["username"]);
        $loginPassword = 0;
        if (! empty($memberRecord)) {
            if (! empty($_POST["login-password"])) {
                $password = $_POST["login-password"];
            }
            $hashedPassword = $memberRecord[0]["password"];
            $loginPassword = 0;
            if (password_verify($password, $hashedPassword)) {
                $loginPassword = 1;
            }
        } else {
            $loginPassword = 0;
        }
        if ($loginPassword == 1) {
            session_start();
            $_SESSION["username"] = $memberRecord[0]["username"];
            session_write_close();
            if ($memberRecord[0]["Nivel"] == 1) {
                $url = "../index.php";
            } else if ($memberRecord[0]["Nivel"] == 2) {
                $url = "./admin.php";
            } else if ($memberRecord[0]["Nivel"] == 3) {
                $url = "./dono.php";
            }
            header("Location: $url");
        } else if ($loginPassword == 0) {
            $loginStatus = "Invalid username or password.";
            return $loginStatus;
        }
    }

    public function getIdDono()
    {
        $paramValue = [isset($_SESSION['username']) ? $_SESSION['username'] : 'default value'];
    
        $query = 'SELECT Id FROM `User` where username = ?';
        $paramType = 's';
        
        $Id = $this->ds->select($query, $paramType, $paramValue);
        return $Id;
    }
    
    public function getIdDonoSession()
    {
       $Id = $this->getIdDono();
    
        if(!empty($Id)) 
        { 
            session_start();
            $_SESSION["Id"] = $Id[0]["Id"];
            session_write_close();
        } 
    }
}