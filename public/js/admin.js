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
            img.className =
                "card-image img-fluid me-2 mb-3 rounded mt-3 shadow";
            img.style.maxHeight = "9rem";
            document.querySelector("#preview").appendChild(img);
        };
        ambilData.readAsDataURL(image.files[i]);
    }

    const btnDelete = document.querySelector(".btn-delete-img");
    if (btnDelete) {
    } else {
        const span = document.createElement("span");
        span.innerHTML = `<i class="bi bi-trash"></i> Hapus Semua`;
        span.className = "btn-delete-img btn text-danger shadow";
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

function showSalesTransactionDetailPopUp(transactionId) {
    $.ajax({
        type: "get",
        url:
            "/karuniamotor/dashboard/transaction-list/detail/pop-up/" +
            transactionId,
        success: function (data) {
            $("#transactionDetailModal").html(data);
            $("#popUpModal").modal("show");
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function showAdminProductEdit(productId) {
    $.ajax({
        type: "get",
        url: "/karuniamotor/dashboard/product/" + productId + "/edit",
        success: function (data) {
            $("#editProductModal").html(data);
            $("#popUpEditProductModal").modal("show");
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function showBidModal(productId) {
    $.ajax({
        type: "get",
        url: "/karuniamotor/dashboard/offer/bid/pop-up/" + productId,
        success: function (data) {
            $("#bidModal").html(data);
            $("#popUpModal").modal("show");
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function showOfferDetailPopUp(productId) {
    $.ajax({
        type: "get",
        url: "/karuniamotor/dashboard/offer/detail/pop-up/" + productId,
        success: function (data) {
            $("#offerDetailModal").html(data);
            $("#popUpModal").modal("show");
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function payCashTempo(cashTempoId) {
    $.ajax({
        type: "get",
        url: "/karuniamotor/dashboard/cash-tempo/pop-up/" + cashTempoId,
        success: function (data) {
            $("#payPopUpModal").html(data);
            $("#paymentModal").modal("show");
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function showSupplierDetail(supplierId) {
    $.ajax({
        type: "get",
        url: "/karuniamotor/dashboard/supplier/detail/" + supplierId,
        success: function (data) {
            $("#supplierDetailModal").html(data);
            $("#popUpModal").modal("show");
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function manageDashboardSearch(keywords) {
    $.ajax({
        type: "get",
        url: "/karuniamotor/dashboard/supplier/search",
        data: {
            keyword: keywords,
        },
        success: function (data) {
            $(".supplier-list").html(data);
        },
        error: function (xhr, error) {
            console.log(xhr);
        },
    });
}
