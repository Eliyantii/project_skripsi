$(document).ready(function () {
    var total_bill_text = $("#totalBillText");
    var product_bill = $("#productBill").val();
    var x = parseInt(product_bill);

    var totalBill = 0;

    totalBill = x + 2000 + 3000;

    $("#totalBill").val(totalBill);
    total_bill_text.text(
        totalBill.toLocaleString("id", {
            minimumFractionDigits: 2,
            maximumSignificantDigits: 9,
        })
    );
});

function checkout(cart_id, csrf_token) {
    $(".btn-send").toggleClass("d-none");
    $(".btn-load").toggleClass("d-none");

    $.ajax({
        type: "post",
        url: "/karuniamotor/checkout/" + cart_id,
        data: {
            _token: csrf_token,
        },
        success: function (data) {
            $(".btn-send").toggleClass("d-done");
            $(".btn-load").toggleClass("d-done");
            makePayment(data);
        },
        error: function (xhr) {
            if (xhr.responseJSON.errors !== undefined) {
                window.scroll(0, 0);
            } else {
                alert("Sistem sedang sibuk, coba lagi nanti!");
            }
            $(".btn-send").toggleClass("d-done");
            $(".btn-load").toggleClass("d-done");
        },
    });
}

function makePayment(data) {
    window.snap.pay(data, {
        onSuccess: function (result) {
            sendSnapCallback(result);
        },
        onPending: function (result) {
            $("#snapToken").val(data);
            sendSnapCallback(result);
        },
        onError: function (result) {
            sendSnapCallback(result);
        },
        onClose: function (result) {
            alert("Anda menutup pembayaran tanpa menyelesaikan pembayaran!");
        },
        language: "id",
    });
}

function sendSnapCallback(result) {
    var redirectUrl = result.finish_redirect_url;
    $("#snapCallback").val(JSON.stringify(result));
    $("#snapCallbackForm").attr("action", redirectUrl);
    $("#snapCallbackForm").submit();
}
