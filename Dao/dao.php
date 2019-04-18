<?php

class dao
{
    private $host = "us-cdbr-iron-east-03.cleardb.net";
    private $db = "heroku_9f71f0110bdd97b";
    private $user = "b8ad916f9f2a13";
    private $pass = "8e0397c7";

    public function getConnection()
    {
        return new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
    }
}
