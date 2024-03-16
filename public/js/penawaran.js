var subjectObject = [
    "Honda",
    "Yamaha",
    "Suzuki",
    "Kawasaki",
    "Vespa",
    "TVS",
    "Ducati",
    "Aprilia",
    "KTM",
    "Bajaj",
];

window.addEventListener("load", function (event) {
    var brandSel = document.getElementById("brand");

    for (var i = 0; i < subjectObject.length; i++) {
        brandSel.options[brandSel.options.length] = new Option(
            subjectObject[i],
            subjectObject[i]
        );
    }
});

window.addEventListener("load", function (event) {
    var yearSel = document.getElementById("yearpicker");
    var currentYear = new Date().getFullYear();

    for (var year = currentYear; year >= currentYear - 50; year--) {
        yearSel.options[yearSel.options.length] = new Option(year, year);
    }
});

function hanyaAngka(evt) {
    var charCode = evt.which ? evt.which : event.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    return true;
}

function showEditProductModal(productId) {
    $.ajax({
        type: "get",
        url: "/karuniamotor/profile/offer/edit/" + productId,
        success: function (data) {
            $("#editProductModal").html(data);
            $("#popUpModal").modal("show");
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function previewBpkbImage() {
    const image = document.querySelector("#imageBpkb");
    const imgPreview = document.querySelector(".imgBpkbPreview");

    imgPreview.style.display = "block";

    const ambilData = new FileReader();
    ambilData.readAsDataURL(image.files[0]);

    ambilData.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}

function previewStnkImage() {
    const image = document.querySelector("#imageStnk");
    const imgPreview = document.querySelector(".imgStnkPreview");

    imgPreview.style.display = "block";

    const ambilData = new FileReader();
    ambilData.readAsDataURL(image.files[0]);

    ambilData.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}
