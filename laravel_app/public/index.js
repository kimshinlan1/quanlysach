$(document).ready(function () {
    $(".myEdit").click(function () {
        var data = $(this).data("options");
        // var dataobj = JSON.parse(data);
        console.log(data['id']);
        console.log(data);
        $("#deviceID").val(data['id']);
        $("#brandName").val(data['brandName']);
        // $("#deviceName").val(data['deviceName']);
        $("#myModal").modal("show");
    });
});