<?php

class Basura
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Get the trash data
     * @return array|false
     */
    public function get()
    {
        $sql = "SELECT * FROM waste_data 
                INNER JOIN waste_type ON waste_type.waste_type_id = waste_data.waste_type_id 
                INNER JOIN waste_bins ON waste_bins.bin_id = waste_data.bin_id LIMIT 10";

        $stmt = $this->db->prepare($sql);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
        }
        return false;
    }

}