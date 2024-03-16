function previewImageKTP() {
    const image = document.querySelector("#imageKTP");
    const imgPreview = document.querySelector(".imgPreviewKTP");

    imgPreview.style.display = "block";

    const ambilData = new FileReader();
    ambilData.readAsDataURL(image.files[0]);

    ambilData.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}

function previewImageKK() {
    const image = document.querySelector("#imageKK");
    const imgPreview = document.querySelector(".imgPreviewKK");

    imgPreview.style.display = "block";

    const ambilData = new FileReader();
    ambilData.readAsDataURL(image.files[0]);

    ambilData.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}

$(document).ready(function () {
    // Listen for the change event on the product_id dropdown
    $("#product_id").change(function () {
        // Get the selected product's data
        var selectedProduct = $(this).find(":selected");
        var plateNumber = selectedProduct.data("plate-number");
        var machineNumber = selectedProduct.data("machine-number");
        var frameNumber = selectedProduct.data("frame-number");

        // Set the values to the corresponding input fields
        $("#plate_number").val(plateNumber);
        $("#machine_number").val(machineNumber);
        $("#frame_number").val(frameNumber);
    });
});
