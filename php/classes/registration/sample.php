<?php
session_start();
// include './autoloader.inc.php';

$fname = $_POST['firstname'];
$mname = $_POST['middlename'];
$lname = $_POST['lastname'];
$dob = $_POST['dateob'];
$contact = $_POST['contact'];
$gender = $_POST['gender'];
$country = $_POST['country'];
$province = $_POST['province'];
$municipality = $_POST['municipality'];
$barangay = $_POST['barangay'];
$terms = $_POST['terms'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$passwordRepeat = $_POST['confirm-password'];

class Dbh
{
    public function connect()
    {
        try {
            $dbUser = 'root';
            $dbPass = '';
            $dbh = new PDO('mysql:host=localhost:3307;dbname=xsample', $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED]);
            return $dbh;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}

class Register extends Dbh
{
    protected function setUser($fname, $mname, $lname, $dob, $contact, $gender, $barangay, $terms, $username, $email, $password)
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
}

class RegistrationCntrl extends Register
{
    public function __construct($fname, $mname, $lname, $dob, $contact, $gender, $country, $province, $municipality, $barangay, $terms, $username, $email, $password, $passwordRepeat)
    {
        $this->fname = $fname;
        $this->mname = $mname;
        $this->lname = $lname;
        $this->dob = $dob;
        $this->contact = $contact;
        $this->gender = $gender;
        $this->country = $country;
        $this->province = $province;
        $this->municipality = $municipality;
        $this->barangay = $barangay;
        $this->terms = $terms;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
    }

    public function registerUser()
    {
        if ($this->emptyInput() == false) {
            $_SESSION['error'] = "Empty Field";
            $_SESSION['require'] = "Required field";
            $_SESSION['fname'] = $this->fname;
            $_SESSION['mname'] = $this->mname;
            $_SESSION['lname'] = $this->lname;
            $_SESSION['dob'] = $this->dob;
            $_SESSION['contact'] = $this->contact;
            $_SESSION['gender'] = $this->gender;
            $_SESSION['country'] = $this->country;
            $_SESSION['province'] = $this->province;
            $_SESSION['municipality'] = $this->municipality;
            $_SESSION['barangay'] = $this->barangay;
            $_SESSION['terms'] = $this->terms;
            $_SESSION['username'] = $this->username;
            $_SESSION['email'] = $this->email;
            header("Location: /../OOP/pages/registration.php");
            exit();
        }

        if ($this->invalidUsername() == false) {
            $_SESSION['error'] = "Empty Field";
            $_SESSION['require'] = "Required field";
            $_SESSION['fname'] = $this->fname;
            $_SESSION['mname'] = $this->mname;
            $_SESSION['lname'] = $this->lname;
            $_SESSION['dob'] = $this->dob;
            $_SESSION['contact'] = $this->contact;
            $_SESSION['gender'] = $this->gender;
            $_SESSION['country'] = $this->country;
            $_SESSION['province'] = $this->province;
            $_SESSION['municipality'] = $this->municipality;
            $_SESSION['barangay'] = $this->barangay;
            $_SESSION['terms'] = $this->terms;
            $_SESSION['username'] = $this->username;
            $_SESSION['email'] = $this->email;
            header("Location: /../OOP/pages/registration.php?error=Username");
            exit();
        }

        if ($this->invalidEmail() == false) {
            $_SESSION['error'] = "Empty Field";
            $_SESSION['require'] = "Required field";
            $_SESSION['fname'] = $this->fname;
            $_SESSION['mname'] = $this->mname;
            $_SESSION['lname'] = $this->lname;
            $_SESSION['dob'] = $this->dob;
            $_SESSION['contact'] = $this->contact;
            $_SESSION['gender'] = $this->gender;
            $_SESSION['country'] = $this->country;
            $_SESSION['province'] = $this->province;
            $_SESSION['municipality'] = $this->municipality;
            $_SESSION['barangay'] = $this->barangay;
            $_SESSION['terms'] = $this->terms;
            $_SESSION['username'] = $this->username;
            $_SESSION['email'] = $this->email;
            header("Location: /../OOP/pages/registration.php?error=Email");
            exit();
        }

        if ($this->passwordMatch() == false) {
            $_SESSION['error'] = "Empty Field";
            $_SESSION['require'] = "Required field";
            $_SESSION['fname'] = $this->fname;
            $_SESSION['mname'] = $this->mname;
            $_SESSION['lname'] = $this->lname;
            $_SESSION['dob'] = $this->dob;
            $_SESSION['contact'] = $this->contact;
            $_SESSION['gender'] = $this->gender;
            $_SESSION['country'] = $this->country;
            $_SESSION['province'] = $this->province;
            $_SESSION['municipality'] = $this->municipality;
            $_SESSION['barangay'] = $this->barangay;
            $_SESSION['terms'] = $this->terms;
            $_SESSION['username'] = $this->username;
            $_SESSION['email'] = $this->email;
            header("Location: /../OOP/pages/registration.php?error=Password");
            exit();
        }

        if ($this->usernameTaken() == false) {
            $_SESSION['error'] = "UsernameorEmailTaken";
            $_SESSION['require'] = "Required field";
            $_SESSION['fname'] = $this->fname;
            $_SESSION['mname'] = $this->mname;
            $_SESSION['lname'] = $this->lname;
            $_SESSION['dob'] = $this->dob;
            $_SESSION['contact'] = $this->contact;
            $_SESSION['gender'] = $this->gender;
            $_SESSION['country'] = $this->country;
            $_SESSION['province'] = $this->province;
            $_SESSION['municipality'] = $this->municipality;
            $_SESSION['barangay'] = $this->barangay;
            $_SESSION['terms'] = $this->terms;
            $_SESSION['username'] = $this->username;
            $_SESSION['email'] = $this->email;
            header("Location: /../OOP/pages/registration.php?error=");
            exit();
        }

        $this->setuser($this->fname, $this->mname, $this->lname, $this->dob, $this->contact, $this->gender, $this->barangay, $this->terms, $this->username, $this->email, $this->password);
    }

    private function emptyInput()
    {
        $result = true;
        if (
            empty($this->fname) ||
            empty($this->mname) ||
            empty($this->lname) ||
            empty($this->dob) ||
            empty($this->contact) ||
            empty($this->gender) ||
            empty($this->country) ||
            empty($this->province) ||
            empty($this->municipality) ||
            empty($this->barangay) ||
            empty($this->terms) ||
            empty($this->username) ||
            empty($this->email) ||
            empty($this->password)
        ) {
            $result = false;
        }
        return $result;
    }

    private function invalidUsername()
    {
        $result = true;
        if (!preg_match("/^[a-zA-Z0-9]*$/", $this->username)) {
            $result = false;
        }
        return $result;
    }

    private function invalidEmail()
    {
        $result = true;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        }
        return $result;
    }

    private function passwordMatch()
    {
        $result = true;
        if ($this->password !== $this->passwordRepeat) {
            $result = false;
        }
        return $result;
    }

    private function usernameTaken()
    {
        $result = true;
        if (!$this->checkUser($this->username, $this->email)) {
            $result = false;
        }
        return $result;
    }
}

$register = new RegistrationCntrl($fname, $mname, $lname, $dob, $contact, $gender, $country, $province, $municipality, $barangay, $terms, $username, $email, $password, $passwordRepeat);

$register->registerUser();
header("Location: /../OOP/pages/login.php");
