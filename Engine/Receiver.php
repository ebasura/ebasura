<?php


class Receiver
{

    private Database $db;

    public function __construct()
    {

        $this->db = Database::getInstance();

    }

}