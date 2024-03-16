function showTransactionDetailPopUp(transactionId) {
    $.ajax({
        type: "get",
        url: "/karuniamotor/profile/transaction/detail/" + transactionId,
        success: function (data) {
            $("#transactionDetailModal").html(data);
            $("#popUpModal").modal("show");
        },
        error: function (data) {
            console.log(data);
        },
    });
}

function filterTransaction() {
    const status = $("select").val();

    $.ajax({
        type: "GET",
        url: "/karuniamotor/profile/transaction/snap/filter",
        data: {
            status: status,
        },
        success: function (result) {
            $(".purchase-list").html(result);
        },
        error: function (xhr, error) {
            console.log(xhr);
        },
    });
}
