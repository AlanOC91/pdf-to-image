<?php
/*
 * This endpoint converts an Image to a PDF.
 */

//Autoloader
require '../vendor/autoload.php';

use Gotenberg\Gotenberg;
use Gotenberg\Stream;

//Make sure the PDF, Page Number and Image Type are set
if (!isset($_FILES['file'])) {
    http_response_code(400);
    header('Content-Type: application/json');
    echo json_encode(array("error" => "Missing required parameters."));
    exit();
}

//Grab the image file
$file = $_FILES['file'];

//Save file temporarily
move_uploaded_file($file['tmp_name'], "temp/" . $file['name']);

//Get File Path
$file = pathinfo($file['name']);

// Create a request to convert Image to PDF
$response = Gotenberg::send(
    Gotenberg::libreOffice('http://apps:3000')
        ->merge()
        ->convert(
            Stream::path("temp/" . $file['filename'] . "." . $file['extension'])
        )
);

//Delete the temp file
unlink("temp/" . $file['filename'] . "." . $file['extension']);

//Get the PDF as a base64 string
$dataUri = "data:application/pdf;base64," . base64_encode($response->getBody());

//Return image as base64 to the browser
header('Content-Type: application/json');
echo json_encode(["dataUri" => $dataUri]);