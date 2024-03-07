<?php
session_start();

class RegistrationCntrl extends Register
{
    public function __construct($fname, $mname, $lname, $dob, $contact, $gender, $country, $province, $municipality, $barangay, $terms, $username, $email, $password, $passwordRepeat, $imageName, $tmpName, $imageSize)
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
        $this->validID = $imageName;
        $this->tmpName = $tmpName;
        $this->imageSize = $imageSize;
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
            $_SESSION['error'] = "Invalid Username";
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
            $_SESSION['error'] = "<script> alert ('Invalid Email Input')</script>";
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
            $_SESSION['error'] = "Password doesn't match";
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

        if ($this->passwordShort() == false) {
            $_SESSION['error'] = "Password too short";
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

        if ($this->passwordWeak() == false) {
            $_SESSION['error'] = "Password should contain atleast ONE UPPERCASE, one lowercase 1 number and one special character";
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
            $_SESSION['error'] = "Username or Email Taken";
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

        if ($this->invalidID() == false) {
            $_SESSION['error'] = "Invalid Image Extension";
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

        if ($this->manyID() == false) {
            $_SESSION['error'] = "Too many image";
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

        if ($this->fewID() == false) {
            $_SESSION['error'] = "Please attach both front and back ID";
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

        if ($this->invalidDate() == false) {
            $_SESSION['error'] = "Invalid Date of Birth";
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

        $this->setuser($this->fname, $this->mname, $this->lname, $this->dob, $this->contact, $this->gender, $this->barangay, $this->terms, $this->username, $this->email, $this->password, $this->validID, $this->tmpName);
    }

    public function insertID()
    {
        $id = $this->getID($this->username, $this->email);
        $this->setID($id, $this->username, $this->validID, $this->tmpName);
    }

    private function emptyInput()
    {
        $result = true;
        if (empty($this->fname) ||
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
            empty($this->password) ||
            ($this->imageSize == 0)) {
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

    private function passwordShort()
    {
        $result = true;
        if (strlen($this->password) < 8) {
            $result = false;
        }
        return $result;
    }

    private function passwordWeak()
    {
        $result = true;
        if (!preg_match("@[A-Z]@", $this->password) || !preg_match("@[a-z]@", $this->password) || !preg_match("@[0-9]@", $this->password) || !preg_match("@[^\w]@", $this->password)) {
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

    private function invalidID()
    {
        $result = true;
        $imageCount = count($this->validID);
        for ($i = 0; $i < $imageCount; $i++) {

            $validID = $this->validID[$i];
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = explode('.', $validID);
            $imageExtension = strtolower(end($imageExtension));
            if (!in_array($imageExtension, $validImageExtension)) {
                $result = false;
            }}
        return $result;
    }

    private function manyID()
    {
        $result = true;
        $imageCount = count($this->validID);
        if ($imageCount > 2) {
            $result = false;
        }
        return $result;
    }

    private function fewID()
    {
        $result = true;
        $imageCount = count($this->validID);
        if ($imageCount == 1) {
            $result = false;
        }
        return $result;
    }

    private function invalidDate()
    {
        $result = true;
        if ($this->dob >= date('Y/m/d')) {
            $result = false;
        }
        return $result;
    }

    private function invalidContact()
    {
        $contact = (int) $this->contact;
        $result = true;
        if ((preg_match('/^[0-9]{10}+$/', $contact)) or (filter_var($this->contact, FILTER_VALIDATE_INT) === false) or (strncmp($this->contact, "09", 2) === 0)) {
            $result = false;
        }
        return $result;
    }
}
