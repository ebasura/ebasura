<?php
include 'init.php';

require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->SetFillColor(128, 0, 0); // Maroon color for header background
        $this->SetTextColor(255, 255, 255);
        $this->Cell(0, 12, 'Waste Data Report', 0, 1, 'C', true);
        $this->Ln(5);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    function WasteTable($header, $data)
    {
        $this->SetFillColor(128, 0, 0); // Maroon color for header background
        $this->SetTextColor(255, 255, 255);
        $this->SetDrawColor(128, 0, 0); // Maroon color for border
        $this->SetLineWidth(.3);
        $this->SetFont('Arial', 'B', 12);

        $widths = array(45, 45, 45, 55); 
        $rowHeight = 20;

        foreach ($header as $col) {
            $this->Cell($widths[array_search($col, $header)], 10, $col, 1, 0, 'C', true);
        }
        $this->Ln();

        $this->SetFillColor(240, 240, 240);
        $this->SetTextColor(0);
        $this->SetFont('Arial', '', 12);

        $fill = false;
        foreach ($data as $index => $row) {
            $this->Cell($widths[0], $rowHeight, $row['bin_name'], 1, 0, 'C', $fill);
            $this->Cell($widths[1], $rowHeight, $row['name'], 1, 0, 'C', $fill);

            if (!empty($row['image_url'])) {
                $imageFile = $this->decodeBase64Image($row['image_url'], 'tmp/temp_image_' . $index . '.jpg');
                $x = $this->GetX();
                $y = $this->GetY();
                $this->Cell($widths[2], $rowHeight, '', 1, 0, 'C', $fill);
                $this->Image($imageFile, $x + ($widths[2] / 2) - 5, $y + ($rowHeight / 2) - 5, 10, 10);
                unlink($imageFile);
            } else {
                $this->Cell($widths[2], $rowHeight, 'No image', 1, 0, 'C', $fill);
            }

            $this->Cell($widths[3], $rowHeight, $row['timestamp'], 1, 0, 'C', $fill);
            $this->Ln();
            $fill = !$fill;
        }
    }

    function decodeBase64Image($base64String, $outputFile)
    {
        $fileData = explode(',', $base64String);
        if (count($fileData) == 2 && base64_decode($fileData[1], true)) {
            $fileContent = base64_decode($fileData[1]);
            file_put_contents($outputFile, $fileContent);
            return $outputFile;
        }
        return false;
    }
}

function getWasteData($db)
{
    try {
        $sql = "SELECT waste_data.*, waste_bins.bin_name, waste_type.name, waste_data.image_url, waste_data.timestamp 
                FROM waste_data 
                INNER JOIN waste_type ON waste_type.waste_type_id = waste_data.waste_type_id 
                INNER JOIN waste_bins ON waste_bins.bin_id = waste_data.bin_id";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage());
        return false;
    }
}

$data = getWasteData($db);

if ($data !== false) {
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);
    $header = array('Bin Name', 'Waste Type', 'Image', 'Timestamp');
    $pdf->WasteTable($header, $data);
    $pdf->Output();
} else {
    echo "No data found!";
}
?>
