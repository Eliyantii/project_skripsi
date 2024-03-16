function previewImage() {
    const image = document.querySelector("#image");
    const imgPreview = document.querySelector(".imgPreview");

    imgPreview.style.display = "block";

    const ambilData = new FileReader();
    ambilData.readAsDataURL(image.files[0]);

    ambilData.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
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

function previewMultiImage() {
    const image = document.querySelector("#files");
    const preview = document.querySelector("#preview");
    let x = image.files.length;

    for (i = 0; i < x; i++) {
        const ambilData = new FileReader();
        ambilData.onload = () => {
            const img = document.createElement("img");
            img.src = ambilData.result;
            img.id = "card-image";
            img.className = "card-image img-fluid me-2 rounded mt-2";
            img.style.maxHeight = "5rem";
            document.querySelector("#preview").appendChild(img);
        };
        ambilData.readAsDataURL(image.files[i]);
    }

    const btnDelete = document.querySelector(".btn-delete-img");
    if (btnDelete) {
    } else {
        const span = document.createElement("span");
        span.innerHTML = `<i class="bi bi-trash3"></i>`;
        span.className = "btn-delete-img text-white btn bg-danger";
        span.addEventListener("click", function deleteImg() {
            const img = preview.getElementsByTagName("img");
            for (i = img.length - 1; i >= 0; i--) {
                img[i].parentNode.removeChild(img[i]);
            }
            image.value = "";
            span.remove();
        });

        document.querySelector("#preview #close").append(span);
    }
}
