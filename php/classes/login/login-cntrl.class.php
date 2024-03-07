<?php
session_start();

class LoginCntrl extends Login
{
    // private $username;
    // private $password;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    public function loginUser()
    {
        if ($this->emptyInput() == false) {
            $_SESSION['error'] = "emptyfield";
            $_SESSION['require'] = "Required field";
            header("Location: /../OOP/pages/login.php");
            exit();
        }

        if ($this->emptyUsername() == false) {
            $_SESSION['error'] = "Username Required";
            $_SESSION['require'] = "Required field";
            header("Location: /../OOP/pages/login.php");
            exit();
        }

        if ($this->emptyPassword() == false) {
            $_SESSION['error'] = "Password  is required";
            $_SESSION["username"] = $this->username;
            $_SESSION['require'] = "Required field";
            header("Location: /../OOP/pages/login.php");
            exit();
        }

        $this->getUser($this->username, $this->password);
    }

    private function emptyInput()
    {
        $result = true;
        if (empty($this->username) && empty($this->password)) {
            $result = false;
        }
        return $result;
    }

    private function emptyUsername()
    {
        $result = true;
        if (empty($this->username)) {
            $result = false;
        }
        return $result;
    }

    private function emptyPassword()
    {
        $result = true;
        if (empty($this->password)) {
            $result = false;
        }
        return $result;
    }
}
