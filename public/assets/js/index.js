/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**************************************!*\
  !*** ./resources/assets/js/index.js ***!
  \**************************************/
/******/(function () {
  // webpackBootstrap
  var __webpack_exports__ = {};
  /*!**************************************!*\
    !*** ./resources/assets/js/index.js ***!
    \**************************************/
  $(function () {
    // CKEDITOR.replace('summary-ckeditor');
    // Insert by Ajax
    $("#insert-form").submit(function (e) {
      e.preventDefault();
      if (!validate_form($(this), e)) {
        return;
      }
      var formData = new FormData(document.getElementById("insert-form"));
      $.ajax({
        url: "/book/storeAjax",
        type: "POST",
        headers: {
          "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        // Add processData option to prevent jQuery from processing the form data
        success: function success(response) {
          // Log the error message
          if (response.errors) {
            var _list = $('<ul class = "d-flex flex-wrap"></ul>');
            $.each(response.errors, function (key, error) {
              _list.append($('<li class="text-danger p-2">' + error + '</li>'));
            });
            $('#error-list').append(_list);
          }
          if (response.success) {
            alert("Thêm thành công");
            window.location.href = response.redirect;
          }
        },
        error: function error(xhr, status, _error) {
          alert("Error: " + _error);
        }
      });
    });

    // delete row
    $(".btn-delete").click(function (e) {
      e.preventDefault();
      var id = $(e.target).data("id");
      var row = $(e.target).closest("tr");
      var token = $("meta[name = 'csrf-token']").attr("content");
      if (confirm("Bạn có chắc chắn muốn xóa dòng này không ?")) {
        $.ajax({
          url: "/delete/" + id,
          type: "DELETE",
          data: {
            _token: token
          },
          success: function success(response) {
            if (response.success) {
              row.remove();
              alert("Xóa thành công");
            } else {
              alert("Không thể xóa dữ liệu");
            }
          },
          error: function error(_error2) {
            alert("Error: " + _error2);
          }
        });
      }
    });

    // Search data
    var table = $('#table-data');
    var tbody = table.find('tbody');
    $("#search-input").on("input", function (e) {
      e.preventDefault();
      tbody.empty();
      var searchTimeout;
      clearTimeout(searchTimeout);
      // Set a timeout to delay the AJAX request
      searchTimeout = setTimeout(function () {
        var search_value = $(e.currentTarget).val();
        $.ajax({
          url: "/search",
          method: "GET",
          data: {
            search_value: search_value
          },
          success: function success(response) {
            if (response.length < 0) {
              searchResults.append($("<div>Không tìm thấy kết quả</div>"));
            } else if (search_value == '') {
              return;
            } else {
              // Create a new tbody with the new tr elements
              for (var i = 0; i < response.length; i++) {
                var tr = $("<tr></tr>");
                tr.append($('<td>').append(response[i].id));
                tr.append($('<td>').append(response[i].ten));
                tr.append($('<td>').append(response[i].mota));
                tr.append($('<td>').append(response[i].soluong));
                tr.append($('<td>').append(response[i].tacgia));
                tr.append($('<td>').append(response[i].nhaxuatban));
                tr.append($('<td>').append(response[i].category.tendanhmuc) !== null ? response[i].category.tendanhmuc : '');

                // use the URL in your JavaScript code
                var imageUrl = imagesPath + "/" + response[i].hinh;
                // Create image element
                var img = $("<img>").attr({
                  src: imageUrl,
                  alt: "Hình"
                });

                // Append img and span elements to the tr element
                tr.append($('<td>').append(img));
                tr.append($('<td>').append(response[i].noidungsach));

                // Append edit and delete button to form
                // create the form element
                var form = $("<form></form>");
                // create the link element
                var link = $("<a></a>").addClass("btn btn-primary").attr("href", "{{ route('book.edit', $book->id) }}").text("Sửa");
                // create the csrf input field
                var csrfInput = $("<input>").attr({
                  type: "hidden",
                  name: "_token",
                  value: "{{ csrf_token() }}"
                });
                // create the delete button element
                var deleteButton = $("<button></button>").addClass("btn btn-danger btn-delete").attr({
                  type: "submit",
                  "data-id": response[i].id
                }).text("Xóa");
                // add the csrf input field and delete button to the form
                form.append(csrfInput, link, deleteButton);
                tr.append($('<td>').append(form));

                // Append the new tr element to the tbody
                tbody.append(tr);
              }

              // Replace the existing tbody content with the new tr elements
              var newContent = tbody.html();
              tbody.html(newContent);
            }
          },
          error: function error(_error3) {
            alert("Error:" + _error3);
          }
        });
      }, 500);
    });

    // when user click import csv
    $("#uploadModal").on("show.bs.modal", function () {
      $("#csv_file").focus();
    });
    $("#upload-csv-form").submit(function (e) {
      e.preventDefault();
      var formData = new FormData(document.getElementById("upload-csv-form"));
      $.ajax({
        method: "POST",
        url: "/import",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        // Add processData option to prevent jQuery from processing the form data
        success: function success(response) {
          if (response.success) {
            alert(response.success);
            window.location.href = response.redirect;
          }
        },
        error: function error(xhr, status, _error4) {
          alert("Error: " + _error4);
        }
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
      return true;
    }
  });
  /******/
})();
/******/ })()
;