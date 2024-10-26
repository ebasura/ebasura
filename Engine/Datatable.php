<?php

class Datatable {

    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function wasteLogs()
    {
        $draw = $_POST['draw'];
        $row = $_POST['start'];
        $rowperpage = $_POST['length']; // Rows display per page
        $columnIndex = $_POST['order'][0]['column']; // Column index
        $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
        $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
        $searchValue = $_POST['search']['value']; // Search value

        $searchArray = array();

        // Search
        $searchQuery = " ";
        if($searchValue != ''){
            $searchQuery = " AND (
           `name` LIKE :name ) ";
            $searchArray = array(
                'name'=>"%$searchValue%",
            );
        }

        // Total number of records without filtering
        $stmt = $this->db->prepare("SELECT COUNT(*) AS allcount FROM `waste_data` WHERE 1");
        $stmt->execute();
        $records = $stmt->fetch();
        $totalRecords = $records['allcount'];

        // Total number of records with filtering
        $stmt = $this->db->prepare("SELECT COUNT(*) AS allcount FROM waste_data 
                 INNER JOIN waste_type ON waste_type.waste_type_id = waste_data.waste_type_id 
                INNER JOIN waste_bins ON waste_bins.bin_id = waste_data.bin_id WHERE 1 ".$searchQuery);
        $stmt->execute($searchArray);
        $records = $stmt->fetch();
        $totalRecordwithFilter = $records['allcount'];

        // Fetch records
        $stmt = $this->db->prepare("SELECT * FROM waste_data
        INNER JOIN waste_type ON waste_type.waste_type_id = waste_data.waste_type_id
        INNER JOIN waste_bins ON waste_bins.bin_id = waste_data.bin_id 
        WHERE 1 ".$searchQuery." ORDER BY timestamp DESC  LIMIT :limit,:offset");

        // Bind values
        foreach ($searchArray as $key=>$search) {
            $stmt->bindValue(':'.$key, $search,PDO::PARAM_STR);
        }

        $stmt->bindValue(':limit', (int)$row, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$rowperpage, PDO::PARAM_INT);
        $stmt->execute();
        $empRecords = $stmt->fetchAll();

        $data = array();


        foreach ($empRecords as $row) {

            $data[] = array(
                "waste_id"=>$row['waste_data_id'],
                "waste_image" => '<img src="'. $row['image_url'] .'" class="img-thumbnail w-50" data-bs-toggle="modal" data-bs-target="#imageModal" onclick="showImage(\'' . $row['image_url'] . '\')">',
                "bin_name"=> $row['bin_name'],
                "waste_type"=> ($row['name'] == 'Recyclable') ? '<div class="badge bg-primary rounded-pill">' . $row['name'] . '</div>' : '<div class="badge bg-secondary rounded-pill">' . $row['name'] . '</div>',
                "confidence" => empty($row['confidence']) ? 'No data' : number_format($row['confidence'] * 100, 2) . '%',
                "date_created"=> $row['timestamp'],
                "actions"=> '<div class="btn-group"><button data-id="'. $row['waste_data_id'] .'" class="btn btn-datatable btn-icon btn-transparent-dark delete-log"><i class="fa-regular fa-trash-can"></i></button></div>'
            );
        }

        // Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $data
        );

        echo json_encode($response);
    }

}