<?php

class Password extends Dbh
{
    protected function updatePassword($user, $oldPass, $newPass)
    {
        $sql = "SELECT password FROM user WHERE user_id = :user";
        $stmt = $this->connect()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        if (!$stmt->execute([':user' => $user])) {
            $stmt = null;
            header("Location: /../OOP/practice/user-account/includes/password.php?error=stmtfailed");
            exit();
        }

        $psswrd = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPassword = password_verify($oldPass, $psswrd[0]['password']);

        if ($checkPassword == false) {
            $stmt = null;
            $_SESSION['error'] = "wrongpassword";
            header("Location: /../OOP/practice/user-account/includes/password.php");
            exit();
        } elseif ($checkPassword == true) {

            $sql = "UPDATE user SET password = :password WHERE user_id = :user";
            $stmt = $this->connect()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $password = password_hash($newPass, PASSWORD_DEFAULT);

            if (!$stmt->execute([':password' => $password, ':user' => $user])) {
                $stmt = null;
                header("Location: /../OOP/practice/user-account/includes/password.php?error=stmtfailed");
                exit();
            }

            // echo "<script> alert('Password updated successfully') </script>";
            $stmt = null;
        }
    }
}
