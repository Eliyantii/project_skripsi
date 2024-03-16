$(document).ready(function () {
    let endYear = new Date().getFullYear();
    let startYear = 1800;
    for (i = endYear; i > startYear; i--) {
        $("#yearpicker").append($("<option />").val(i).html(i));
    }
});

function handleFilter(salesChart) {
    const year = $("select").val();

    $.ajax({
        type: "GET",
        url: "owner-sales-information/filter",
        data: {
            year: year,
        },
        success: function (result) {
            $("#year").text(year);
            salesChart.config.data.datasets[0].data = result.data;
            salesChart.update(salesChart.config);
        },
        error: function (xhr, error) {
            console.log(xhr);
        },
    });
}
