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

     /**
     * Get the value of a specific setting by its name
     * @param string $setting_name
     * @return string|false
     */
    public function getSettingByName(string $setting_name)
    {
        $sql = "SELECT `setting_value` FROM `system_settings` WHERE `setting_name` = :setting_name";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':setting_name', $setting_name, \PDO::PARAM_STR);

        if ($stmt->execute()) {
            return $stmt->fetchColumn(); // Return the value of the setting
        }

        return false; // Return false if no setting is found or on failure
    }


}