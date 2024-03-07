<?php

class Login extends Dbh
{

    protected function getUser($username, $password)
    {
        $sql = "SELECT password FROM user WHERE username = ? OR email = ?;";
        $stmt = $this->connect()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

        if (!$stmt->execute([$username, $username])) {
            $stmt = null;
            $_SESSION['error'] = "stmtfailed";
            header("Location: /../OOP/pages/login.php");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $sql = "SELECT password FROM admin WHERE username = ?;";
            $stmt = $this->connect()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

            if (!$stmt->execute([$username])) {
                $stmt = null;
                $_SESSION['error'] = "stmtfailed";
                header("Location: /../OOP/pages/login.php");
                exit();
            }
            if ($stmt->rowCount() == 0) {
                $stmt = null;
                $_SESSION['error'] = "User Not Found!";
                $_SESSION["username"] = $username;
                header("Location: /../OOP/pages/login.php");
                exit();
            }
            $passwrd = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $checkpass = $passwrd[0]['password'];

            if ($checkpass != $password) {
                $stmt = null;
                // echo "<script>alert('$password')</script>";
                $_SESSION['error'] = "Wrong Password Admin!";
                $_SESSION["username"] = $username;
                header("Location: /../OOP/pages/login.php");
                exit();
            } elseif ($checkpass == $password) {
                session_start();
                $_SESSION["role"] = "admin";
                $stmt = null;
                // $stmt = null;
                // $_SESSION['error'] = "Wrong Password!";
                // $_SESSION["username"] = $username;
                // header("Location: /../OOP/pages/login.php");
                // exit();
            }
        } elseif ($stmt->rowCount() > 0) {
            $psswrd = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $checkPassword = password_verify($password, $psswrd[0]['password']);

            if ($checkPassword == false) {
                $stmt = null;
                $_SESSION['error'] = "Wrong Password!";
                $_SESSION["username"] = $username;
                header("Location: /../OOP/pages/login.php");
                exit();
            } elseif ($checkPassword == true) {
                $sql = "SELECT DATE_FORMAT(user.dob, '%M %d, %Y')  AS doB, user.*, country.country_name, province.province_name, municipality.municipality_name, barangay.barangay_name FROM user
            INNER JOIN barangay ON user.address=barangay.barangay_code
            INNER JOIN municipality ON barangay.municipality_code=municipality.municipality_code
            INNER JOIN province ON barangay.province_code=province.province_code
            INNER JOIN country ON barangay.country_code=country.country_code
            WHERE (user.username = ?  OR user.email = ?) AND user.reviewed = 1;";
                $stmt = $this->connect()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);

                if (!$stmt->execute([$username, $username])) {
                    $stmt = null;
                    $_SESSION['error'] = "stmtfailed";
                    header("Location: /../OOP/pages/login.php");
                    exit();
                }

                if ($stmt->rowCount() == 0) {
                    $stmt = null;
                    $_SESSION['error'] = "Information Under Review.";
                    $_SESSION["username"] = $username;
                    header("Location: /../OOP/pages/login.php");
                    exit();
                }

                // if ($stmt->rowCount() == 0) {
                //     $stmt = null;
                //     $_SESSION['error'] = "password";
                //     $_SESSION["username"] = $username;
                //     header("Location: /../OOP/pages/login.php");
                //     exit();
                // }

                $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

                session_start();
                $_SESSION["role"] = "user";
                $_SESSION["user_id"] = $user[0]["user_id"];
                $_SESSION["username"] = $user[0]["username"];
                $_SESSION["user_fname"] = $user[0]["fname"];
                $_SESSION["user_mname"] = $user[0]["mname"];
                $_SESSION["user_lname"] = $user[0]["lname"];
                $_SESSION["user_gender"] = $user[0]["gender"];
                $_SESSION["user_dob"] = $user[0]["doB"];
                $_SESSION["user_contact"] = $user[0]["contact"];
                $_SESSION["user_email"] = $user[0]["email"];
                $_SESSION["user_contact"] = $user[0]["contact"];
                $_SESSION["user_address"] = $user[0]["barangay_name"] . ", " . $user[0]["municipality_name"] . ", " . $user[0]["province_name"] . ", " . $user[0]["country_name"];
                $_SESSION["user_barangay"] = $user[0]["address"];
                $_SESSION["user_status"] = $user[0]["status"];

                $stmt = null;
                echo "<script>alert(" . $_SESSION['user_dob'] . ")</script>";

                $id = $_SESSION['user_id'];
                $sql = "UPDATE user SET status = 'Active Now' WHERE user_id = '$id'";
                $stmt = $this->connect()->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
                $stmt->execute();
                $stmt = null;
            }

            $stmt = null;
        }
    }
}
