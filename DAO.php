<?php
require_once 'db.php';

class DAO {
    private $db;

    // SQL upiti
    private $SELECT_AUTO = "SELECT id, marka, cena FROM Auto WHERE marka = ? AND cena < ?";
    private $COUNT_AUTO = "SELECT COUNT(*) FROM Auto WHERE marka = ?";

    public function __construct() {
        $this->db = DB::createInstance();
    }

    public function lista($marka, $cena) {
        $statement = $this->db->prepare($this->SELECT_AUTO);
        $statement->bindValue(1, $marka);
        $statement->bindValue(2, $cena);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function postoji($marka) {
        $statement = $this->db->prepare($this->COUNT_AUTO);
        $statement->bindValue(1, $marka);
        $statement->execute();
        return $statement->fetchColumn() > 0;
    }
}
?>
