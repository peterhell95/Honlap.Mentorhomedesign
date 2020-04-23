<?php
class connectionClass extends mysqli{
    
    private $host="mysql.rackhost.hu",$password="kampecaSS88",$username="c12500peterhell9",$dbName='c12500adatbazis';
    public $con;
    function __construct() {
        $this->con=  $this->connect($this->host, $this->username, $this->password, $this->dbName);
    }
}
