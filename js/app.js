let resizeform = document.getElementById("convert-pdf");

resizeform.addEventListener("submit", (e) => {
    e.preventDefault();

    //Hide any previous error messages
    let errorMsg = document.getElementById("error-msg");
    errorMsg.classList.add("d-none");

    //Initialize components
    let progressBar = document.getElementById("progressBar");
    let imagePreviewBox = document.getElementById("img-preview-box");
    let previewDiv = document.getElementById("img-preview-div");
    let downloadBtn = document.getElementById("download-image");
    let image_type = document.getElementById("imageType").value;
    let page_number = document.getElementById("pageNumber").value;
    let inputPDF = document.getElementById("inputPDF").files[0];

    //Build form data
    let formData = new FormData();
    formData.append("image_type", image_type);
    formData.append("page_number", page_number);
    formData.append("file", inputPDF);

    //url is based on convertType selection. pdfToImage is api/convert.php and imageToPdf is api/convert2.php
    let url = "api/convert.php";
    let type = 'image';
    if (document.getElementById("convertType").value === "imageToPdf") {
        url = "api/convert2.php";
        type = 'pdf';
        image_type = 'pdf';
    }

    //Simulate progress bar. We have no way of actually knowing the progress of the conversion so we are just making up a simulation to make it look like it is doing something.
    let progress = 0;
    let progressInterval = setInterval(() => {
        progress += 10; //Increment by 10%
        progressBar.style.width = progress + "%";

        if (progress >= 100) clearInterval(progressInterval);
    }, 1000); //1 second

    fetch(url, {
        method: "POST",
        body: formData
    })
        .then(response => {
            clearInterval(progressInterval); // Stop the progress bar simulation

            // If the response is not OK, attempt to parse its JSON to get the detailed error message
            if (!response.ok) {
                return response.json().then(err => {
                    throw new Error(err.error); // Throw an error with the detailed message
                });
            }
            return response.json(); // Otherwise, just return the parsed JSON as usual
        })
        .then(json => {

            if(type === 'image') {
                //Display the image in the preview box
                let imagePreview = document.createElement("img");
                imagePreview.src = json.dataUri;
                imagePreview.style.width = '100%';
                imagePreviewBox.appendChild(imagePreview);
                downloadBtn.innerHTML = "Download Image";
            }else{
                //Change download-image button text to Download PDF
                downloadBtn.innerHTML = "Download PDF";
            }

            //Unhide the preview div containing the image and download button
            previewDiv.classList.remove("d-none");

            //Reset progress bar
            progressBar.style.width = "0%";

            //Download Button
            downloadBtn.onclick = function() {
                let a = document.createElement("a");
                a.href = json.dataUri;
                a.download = "converted_image." + image_type;
                a.click();

                //Cleanup and reset
                imagePreviewBox.innerHTML = "";  //Clear the image preview
                previewDiv.classList.add("d-none");  //Hide the preview div again so we reset
            };
        })
        .catch(error => {
            clearInterval(progressInterval);  //Stop progress bar simulation
            progressBar.style.width = "0%";  //Reset progress bar
            console.error("Error:", error);
            let errorMsg = document.getElementById("error-msg");
            errorMsg.innerHTML = error.message;
            errorMsg.classList.remove("d-none");
        });

});

//If #imageToPdf is selected in #convertType then hide #image-return and #page-selection
let convertType = document.getElementById("convertType");
let imageReturn = document.getElementById("image-return");
let pageSelection = document.getElementById("page-selection");

convertType.addEventListener("change", (e) => {
    if (e.target.value === "imageToPdf") {
        imageReturn.classList.add("d-none");
        pageSelection.classList.add("d-none");
    } else {
        imageReturn.classList.remove("d-none");
        pageSelection.classList.remove("d-none");
    }
});