$(function () {
    // insert
    $("#insert-form").submit(function (e) {
        e.preventDefault();

        if (!validate_form($(this), e)) {
            return;
        }

        let formData = new FormData(document.getElementById("insert-form"));
        $.ajax({
            url: "/book/storeAjax",
            type: "POST",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: formData,
            cache: false,
            contentType: false,
            processData: false, // Add processData option to prevent jQuery from processing the form data
            success: function (response) {
                
                // Log the error message
                if(response.errors){
                    let list = $('<ul class = "d-flex flex-wrap"></ul>')
                    console.log(response.errors);
                    $.each(response.errors, function(key, error){
                        list.append($('<li class="text-danger p-2">'+ error +'</li>'))
                    });

                    $('#error-list').append(list);

                }
                
                if (response.success) {
                    alert("Thêm thành công");
                    window.location.href = response.redirect;
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                alert("Error: " + error);
            },
        });
    });

    // delete row
    $(".btn-delete").click((e) => {
        e.preventDefault();
        let id = $(e.target).data("id");
        let row = $(e.target).closest("tr");
        let token = $("meta[name = 'csrf-token']").attr("content");
        if (confirm("Bạn có chắc chắn muốn xóa dòng này không ?")) {
            $.ajax({
                url: "/delete/" + id,
                type: "DELETE",
                data: {
                    _token: token,
                },
                success: function (response) {
                    console.log(response);
                    if (response.success) {
                        row.remove();
                        alert("Xóa thành công");
                    } else {
                        alert("Không thể xóa dữ liệu");
                    }
                },
                error: function (error) {
                    alert("Error: " + error);
                },
            });
        }
    });

    // Search data
    let searchResults = $("#search-result");
    searchResults.hide();
    $("#search-input").on("input", (e) => {
        e.preventDefault();
        let searchTimeout;
        clearTimeout(searchTimeout);

        // Set a timeout to delay the AJAX request
        searchTimeout = setTimeout(function () {
            var search_value = $(e.currentTarget).val();
            $.ajax({
                url: "/search",
                method: "GET",
                data: {
                    search_value: search_value,
                },
                success: function (response) {
                    searchResults.empty();
                    searchResults.fadeIn(500);
                    if (response.length < 0) {
                        searchResults.append(
                            $("<div>Không tìm thấy kết quả</div>")
                        );
                    } else if (response.length == 0) {
                        searchResults.hide();
                    } else {
                        let list = $('<ul class="search_results_table"></ul>');
                        for (let i = 0; i < response.length; i++) {
                            let item = $("<li></li>");
                            // use the URL in your JavaScript code
                            let imageUrl = imagesPath + "/" + response[i].hinh;
                            // Create image element
                            let img = $("<img>").attr({
                                src: imageUrl,
                                alt: "Hình",
                            });
                            // Create image element
                            let span = $("<span></span>").text(response[i].ten);
                            item.append(img);
                            item.append(span);
                            list.append(item);
                        }
                        searchResults.append(list);
                    }
                },
                error: function (error) {
                    alert("Error:" + error);
                },
            });
        }, 500);
    });

    // when user click import csv
    $("#uploadModal").on("show.bs.modal", function () {
        $("#csv_file").focus();
    });

    $("#upload-csv-form").submit(function (e) {
        e.preventDefault();
        let formData = new FormData(document.getElementById("upload-csv-form"));
        $.ajax({
            method: "POST",
            url: "/import",
            data: formData,
            cache: false,
            contentType: false,
            processData: false, // Add processData option to prevent jQuery from processing the form data
            success: function (response) {
                if (response.success) {
                    alert(response.success);
                    window.location.href = response.redirect;
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr.responseText);
                alert("Error: " + error);
            },
        });
    });

    function validate_form(form, event) {
        if (form[0].checkValidity() === false) {
            event.preventDefault();
            event.stopPropagation();
            form.addClass("was-validated");
            return false;
        }
        // Add bootstrap 4 was-validated classes to trigger validation messages
        form.addClass("was-validated");
    }
});
