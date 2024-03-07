<?php

class Profile extends Dbh
{

    protected function checkProfile($username, $email)
    {
        $sql = "SELECT user.*, images.* FROM user INNER JOIN images ON user.user_id=images.user_id WHERE username = ':username'";
        $stmt = $this->connect()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        if (!$stmt->execute([$_SESSION['username']])) {
            $stmt = null;
            header("Location: /../OOP/pages/registration.php?error=stmtfailed");
            exit();
        }

        $resultCheck = true;
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        }
        return $resultCheck;
    }

    // protected function setUser($fname, $mname, $lname, $dob, $contact, $gender, $barangay, $terms, $username, $email, $password)
    // {
    //     $sql = "INSERT INTO user (fname, mname, lname, dob, contact, gender, address, term, username, email, password) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
    //     $stmt = $this->connect()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
    //     $password = password_hash($password, PASSWORD_DEFAULT);

    //     if (!$stmt->execute([$fname, $mname, $lname, $dob, $contact, $gender, $barangay, $terms, $username, $email, $password])) {
    //         $stmt = null;
    //         header("Location: /../OOP/pages/registration.php?error=stmtfailed");
    //         // exit();
    //     }
    //     $stmt = null;
    // }
}
