<?php

/*
 * This endpoint converts a PDF to an image and returns the image to the browser
 */

//Autoloader
require '../vendor/autoload.php';


//Make sure the PDF, Page Number and Image Type are set
if (!isset($_FILES['file'], $_POST['image_type'], $_POST['page_number'])) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Missing required parameters."));
    exit();
}

//Ensure Page Number is an int and of a value between 1 and 9999
if (!is_numeric($_POST['page_number']) || intval($_POST['page_number']) < 1 || intval($_POST['page_number']) > 9999) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Invalid page number. Please use a number between 1 and 9999."));
    exit();
}

$file = $_FILES['file'];
$image_type = $_POST['image_type'];
$page_number = intval($_POST['page_number']);

// Ensure the uploaded file is a PDF
$file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
if (strtolower($file_extension) !== "pdf") {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Invalid file type. Please upload a PDF."));
    exit();
}

//Make sure the image type is valid (jpg or png)
if (strtolower($image_type) !== "jpg" && strtolower($image_type) !== "png") {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Invalid image type. Please use jpg or png."));
    exit();
}

// Define the path where you want to save the temp PDF
$pdf_output_path = "temp/" . uniqid() . ".pdf";
$image_output_path = "temp/" . uniqid() . "." . $image_type;

//Save PDF to temp directory
move_uploaded_file($file['tmp_name'], $pdf_output_path);

//check if file exists for $pdf_output_path
if (!file_exists($pdf_output_path)) {
    http_response_code(500);
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Failed to save PDF to temp directory."));
    exit();
}

//Convert PDF to Image
$pdf = new Spatie\PdfToImage\Pdf(realpath($pdf_output_path));

//Get Page Count
$count = $pdf->getNumberOfPages();

//Ensure the page number we want to convert is within the page count, if not, throw an error
if ($page_number > $count) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Invalid page number. Please use a number between 1 and $count."));
    exit();
}

$pdf->setOutputFormat($image_type)
    ->setPage($page_number)
    ->saveImage($image_output_path);

//Convert the image to base64 (for browser preview)
$imageData = base64_encode(file_get_contents($image_output_path));
$dataUri = "data:image/$image_type;base64," . $imageData;

//Return image as base64 to the browser
header('Content-Type: application/json');
echo json_encode(["dataUri" => $dataUri]);

//Delete the temp files - I'm commenting these out as you'd normally only delete what you just created
//unlink($image_output_path);
//unlink($pdf_output_path);

//But I am just wiping the contents of the temp directory for ease of use
$files = glob('temp/*');
foreach ($files as $file) {
    if (is_file($file))
        unlink($file);
}