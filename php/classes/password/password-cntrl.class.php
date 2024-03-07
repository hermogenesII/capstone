<?php
// session_start();

class PasswordCntrl extends Password
{
    public function __construct($user, $oldPass, $newPass, $confirmPass)
    {
        $this->user = $user;
        $this->oldPass = $oldPass;
        $this->newPass = $newPass;
        $this->confirmPass = $confirmPass;
    }

    public function changePassword()
    {
        if ($this->emptyInput() == false) {
            $_SESSION['error'] = "emptyfield";
            // $_SESSION['require'] = "Required field";
            header("Location: /../OOP/practice/user-account/includes/password.php");
            exit();
        }

        if ($this->unmatchPassword() == false) {
            $_SESSION['error'] = "Unmatch Password";
            // $_SESSION["username"] = $this->username;
            // $_SESSION['require'] = "Required field";
            echo "<script>
            window.setTimeout(function(){
            window.location.href = '/../OOP/practice/user-account/includes/password.php';
            });
            </script>";
            // echo "<script> alert('Invalid Image Extension');</script>";
            exit();
        }

        $this->updatePassword($this->user, $this->oldPass, $this->newPass);
    }

    private function emptyInput()
    {
        $result = true;
        if (empty($this->oldPass) || empty($this->newPass || empty($this->confirmPass))) {
            $result = false;
        }
        return $result;
    }

    private function unmatchPassword()
    {
        $result = true;
        if ($this->newPass !== $this->confirmPass) {
            $result = false;
        }
        return $result;
    }
}
