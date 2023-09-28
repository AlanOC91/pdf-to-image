<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../../../favicon.ico">

    <title>PDF to Image - Convert a PDF file to an image file</title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/signin.css" rel="stylesheet">

</head>

<body class="text-center">
<form class="form-signin" id="convert-pdf" method="post" enctype="multipart/form-data">
    <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
         width="50px" height="50px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"
         fill="#000000">

    <g id="SVGRepo_bgCarrier" stroke-width="0"/>

        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/>

        <g id="SVGRepo_iconCarrier">
            <g>
                <path fill="#231F20"
                      d="M32,19.998c-6.627,0-12,5.373-12,12s5.373,12,12,12s12-5.373,12-12S38.627,19.998,32,19.998z M32,35.998 c-2.209,0-4-1.791-4-4s1.791-4,4-4s4,1.791,4,4S34.209,35.998,32,35.998z"/>
                <path fill="#231F20"
                      d="M60,23.998h-5.371c-0.283-0.803-0.605-1.587-0.97-2.348l3.798-3.797c1.561-1.562,1.559-4.096-0.002-5.658 l-5.658-5.656c-1.561-1.561-4.094-1.562-5.655,0l-3.798,3.798C41.584,9.974,40.801,9.652,40,9.369V3.996 c-0.001-2.209-1.793-3.999-4.002-4l-8,0.001c-2.208,0-4,1.79-4,3.999V9.37c-0.801,0.283-1.584,0.604-2.344,0.968l-3.797-3.797 C16.295,4.979,13.762,4.98,12.2,6.542l-5.657,5.657c-1.562,1.562-1.562,4.094,0,5.656l3.797,3.797 c-0.363,0.76-0.686,1.544-0.969,2.346H4c-2.209,0-4,1.791-4,4v8c0,2.209,1.791,4,4,4h5.371c0.283,0.803,0.605,1.587,0.97,2.348 l-3.798,3.797c-1.561,1.562-1.559,4.096,0.002,5.658l5.658,5.656c1.561,1.561,4.094,1.562,5.655,0l3.798-3.798 c0.76,0.363,1.543,0.685,2.344,0.968V60c0.001,2.209,1.793,3.999,4.002,4l8-0.001c2.208,0,4-1.79,4-3.999v-5.374 c0.801-0.283,1.584-0.604,2.344-0.968l3.797,3.797c1.562,1.562,4.096,1.561,5.657-0.001l5.657-5.657 c1.562-1.562,1.562-4.094,0-5.656l-3.797-3.797c0.363-0.76,0.686-1.544,0.969-2.346H60c2.209,0,4-1.791,4-4v-8 C64,25.789,62.209,23.998,60,23.998z M32,45.998c-7.732,0-14-6.268-14-14s6.268-14,14-14s14,6.268,14,14S39.732,45.998,32,45.998z"/>
                <circle fill="#231F20" cx="32" cy="31.998" r="2"/>
            </g>
        </g>

    </svg>
    <h1 class="h3 mb-3 font-weight-normal">PDF to Image</h1>

    <!-- Input for the image -->
    <div class="form-group">
        <label for="inputPDF" class="sr-only">PDF</label>
        <p>Choose a PDF file to convert to an image</p>

        <!-- Bootstrap hidden alert for displaying errors -->
        <div class="alert alert-danger d-none" role="alert" id="error-msg"></div>

        <input type="file" id="inputPDF" class="form-control" placeholder="Image" required autofocus>
    </div>

    <div class="form-group">
        <!-- Image Return Output (JPG, PNG, etc) -->
        <label for="imageType">Image Return</label>
        <select class="form-control h-100" id="imageType" required>
            <option value="jpg">JPG</option>
            <option value="png">PNG</option>
        </select>
    </div>

    <div class="form-group">
        <!-- Page Number to Convert (input number) -->
        <label for="pageNumber">Page Number</label>
        <input type="number" id="pageNumber" value="1" min="1" max="9999" step="1" class="form-control"
               placeholder="Enter page number" required>
    </div>


    <!-- Progress bar -->
    <div class="progress mb-2">
        <div id="progressBar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
             aria-valuenow="0"
             aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
    </div>

    <!-- Image Preview -->
    <div id="img-preview-div" class="form-group d-none">
        <div id="img-preview-box" class="mb-2">
            <!-- Preview of the Image is displayed here -->
        </div>
        <div id="img-download-button">
            <button class="btn btn-lg btn-primary btn-block" type="button" id="download-image">Download Image</button>
        </div>
    </div>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Convert PDF</button>

    <p class="mt-5 mb-3 text-muted">Alan O'Connor &copy; 2023</p>
</form>
<!-- JS file -->
<script type="text/javascript" src="./js/app.js" defer></script>
</body>
</html>
