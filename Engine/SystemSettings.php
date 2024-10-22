<?php

class SystemSettings 
{

    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function getSettings()
    {
        $sql = "SELECT `setting_name`, `setting_value` FROM `system_settings`";
        $stmt = $this->db->query($sql);
        if ($stmt->execute()) {
            $settings = $stmt->fetchAll(\PDO::FETCH_ASSOC);

            // Transform the settings array into a key-value pair array
            $settings_assoc = [];
            foreach ($settings as $setting) {
                $settings_assoc[$setting['setting_name']] = $setting['setting_value'];
            }
            return $settings_assoc;
        }
        return false;
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

}