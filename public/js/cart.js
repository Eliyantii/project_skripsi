function updateProductUnit(csrf_token, cartId, productId, unit) {
    if (unit <= 0) {
        if (
            confirm("Apakah Anda yakin ingin menghapus produk ini ?") == false
        ) {
            return;
        }
    }

    $(".alert").hide();

    $.ajax({
        type: "put",
        url: "/karuniamotor/cart",
        data: {
            unit: unit,
            _token: csrf_token,
            cartId: cartId,
            productId: productId,
        },
        success: function (result) {
            if (result.cartDetail) {
                let priceElement = $("#product_subtotal_" + cartId + productId);
                let subtotal = result.subtotal.toLocaleString("id", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });
                let totalPriceElement = $("#total_price" + cartId);
                let total = result.total.toLocaleString("id", {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2,
                });

                priceElement.html("Rp" + subtotal);
                totalPriceElement.html("Rp" + total);
                return;
            }

            if (result.message == "Produk di keranjang berhasil dihapus.") {
                $("#cart_detail_" + cartId + productId).remove();
                alert(result.message);
            } else {
                $("#cart_row_" + cartId).remove();
                alert(result.message);

                if (result.useTotalCart == 0) {
                    window.location.href = "/karuniamotor/cart";
                }
            }
        },
        error: function (error) {
            console.log(error);
        },
    });
}
