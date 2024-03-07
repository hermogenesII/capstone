<?php

class Dbh
{

    public function connect()
    {
        try {
            $dbUser = 'root';
            $dbPass = '';
            $dbh = new PDO('mysql:host=localhost:3307;dbname=serviseek_db', $dbUser, $dbPass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED]);
            return $dbh;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }
}
