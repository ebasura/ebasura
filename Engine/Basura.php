<?php

class Basura
{
    private Database $db;
    private int $INITIAL_DEPTH_CM = 75; 

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
                INNER JOIN waste_bins ON waste_bins.bin_id = waste_data.bin_id";

        $stmt = $this->db->prepare($sql);
        if ($stmt->execute()) {
            if ($stmt->rowCount() > 0) {
                return $stmt->fetchAll(\PDO::FETCH_ASSOC);
            }
        }
        return false;
    }

    public function deleteWasteData($id)
    {
        $sql = "DELETE FROM waste_data WHERE waste_data_id = :wdi";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":wdi", $id);
        if($stmt->execute()){
            return true;
        }
    }

    public function setCurrentTrashBin($binId)
    {

        try {

            $sql = "UPDATE system_settings SET setting_value = :bin_id WHERE setting_name = 'active_bin'";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(":bin_id", $binId);
            if($stmt->execute()){
                echo json_encode([
                    'success' => true, 
                    'message' => 'Settings updated successfully'
                ]);
            }
            
        } catch (Exception $e) {
            echo json_encode([
                'success' => false, 
                'message' => 'Error: ' . $e->getMessage()
            ]);
        }
       
    }

    /**
     * Get the median fill level for a specific bin and waste type.
     * @param int $bin_id
     * @param int $waste_type_id
     * @return float|false
     */
    public function getMedianFillLevel(int $bin_id, int $waste_type_id)
    {
        // SQL query to get the last 10 fill levels for the specific bin and waste type
        $sql = "SELECT fill_level FROM bin_fill_levels 
                WHERE bin_id = :bin_id AND waste_type = :waste_type_id 
                ORDER BY timestamp DESC LIMIT 10";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':bin_id', $bin_id, \PDO::PARAM_INT);
        $stmt->bindValue(':waste_type_id', $waste_type_id, \PDO::PARAM_INT);

        if ($stmt->execute()) {
            $fill_levels = $stmt->fetchAll(\PDO::FETCH_COLUMN);
            if (count($fill_levels) === 0) {
                return false; // No data found
            }

            // Sort the fill levels to calculate the median
            sort($fill_levels);
            $count = count($fill_levels);

            // Calculate the median
            if ($count % 2 == 0) {
                // If even, take the average of the two middle values
                $median = ($fill_levels[$count / 2 - 1] + $fill_levels[$count / 2]) / 2;
            } else {
                // If odd, take the middle value
                $median = $fill_levels[floor($count / 2)];
            }

            return $median;
        }

        return false; // Failed to execute query
    }

    /**
     * Calculate the percentage full based on the median fill level.
     * @param int $bin_id
     * @param int $waste_type_id
     * @return float|false
     */
    public function calculatePercentageFull(int $bin_id, int $waste_type_id)
    {
        $median_fill_level = $this->getMedianFillLevel($bin_id, $waste_type_id);

        if ($median_fill_level === false) {
            return false; // No data or an error occurred
        }

        // Ensure that the measured depth doesn't exceed the total bin height
        if ($median_fill_level > $this->INITIAL_DEPTH_CM) {
            $median_fill_level = $this->INITIAL_DEPTH_CM;
        }

        // Calculate the filled height of the bin
        $filled_height = $this->INITIAL_DEPTH_CM - $median_fill_level;

        // Calculate the percentage full
        $percentage_full = ($filled_height / $this->INITIAL_DEPTH_CM) * 100;

        return $percentage_full;
    }
}
