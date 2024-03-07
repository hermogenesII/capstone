<?php

class Register extends Dbh
{

    protected function setUser($fname, $mname, $lname, $dob, $contact, $gender, $barangay, $terms, $username, $email, $password, $validID, $tmpName)
    {
        $sql = "INSERT INTO user (fname, mname, lname, dob, contact, gender, address, term, username, email, password) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $this->connect()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $password = password_hash($password, PASSWORD_DEFAULT);
        if (!$stmt->execute([$fname, $mname, $lname, $dob, $contact, $gender, $barangay, $terms, $username, $email, $password])) {
            $stmt = null;

            header("Location: /../OOP/pages/registration.php?error=stmtfailed");
            // exit();
        }
        $stmt = null;

        // $imageCount = count($validID);
        // for ($i = 0; $i < $imageCount; $i++) {
        //     $validID2 = $validID[$i];
        //     $tmpName2 = $tmpName[$i];
        //     $imageExtension = explode('.', $validID2);
        //     $imageExtension = strtolower(end($imageExtension));
        //     $newValidID = $username . "-ID" . $i;
        //     $newValidID .= '.' . $imageExtension;
        //     $folder = 'C:\xampp\htdocs\OOP\images\validID\\';
        //     move_uploaded_file($tmpName2, $folder . $newValidID);

        //     $sql = "INSERT INTO images (user_id, image_filename, date_upload, image_type) VALUES ('$user_id', '$newValidID', CURRENT_DATE(), 'validID')";
        //     $stmt = $this->connect()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        //     $stmt->execute();
        //     // $stmt = null;
        // }

        $stmt = null;
    }

    protected function setID($id, $username, $validID, $tmpName)
    {
        $imageCount = count($validID);
        for ($i = 0; $i < $imageCount; $i++) {
            $validID2 = $validID[$i];
            $tmpName2 = $tmpName[$i];
            $imageExtension = explode('.', $validID2);
            $imageExtension = strtolower(end($imageExtension));
            $newValidID = $username . "-ID" . $i;
            $newValidID .= '.' . $imageExtension;
            $folder = 'C:\xampp\htdocs\OOP\images\validID\\';
            move_uploaded_file($tmpName2, $folder . $newValidID);

            $sql = "INSERT INTO images (user_id, image_filename, date_upload, image_type) VALUES ('$id', '$newValidID', CURRENT_DATE(), 'validID')";
            $stmt = $this->connect()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
            $stmt->execute();
            // $stmt = null;
        }
    }

    protected function checkUser($username, $email)
    {
        $sql = "SELECT user_id, password FROM user WHERE username = ? OR email =?";
        $stmt = $this->connect()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        if (!$stmt->execute([$username, $email])) {
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

    protected function getID($username, $email)
    {
        $sql = "SELECT user_id FROM user WHERE username = ? OR email =?";
        $stmt = $this->connect()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        if (!$stmt->execute([$username, $email])) {
            $stmt = null;
            header("Location: /../OOP/pages/registration.php?error=stmtfailed");
            exit();
        }
        // $userId = "";
        $id = $stmt->fetch(PDO::FETCH_ASSOC);
        $userId = $id["user_id"];
        return $userId;
    }
}
