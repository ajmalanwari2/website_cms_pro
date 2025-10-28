// show edit form
function toggleEdit(rowId, showEdit = true) {
    var row = $("#tr-" + rowId);
    var eSection = row.find(".e-section");
    var vSection = row.find(".v-section");

    if (showEdit) {
        // نمایش فرم و مخفی کردن نمایش معمولی
        eSection.removeClass("d-none");
        vSection.addClass("d-none");
    } else {
        // مخفی کردن فرم و نمایش بخش معمولی
        eSection.addClass("d-none");
        vSection.removeClass("d-none");
    }
}

function addEditModal(resourceRoute, resourcePath, modalRowID = 0) {
    $.ajax({
        url: resourceRoute, // Laravel route
        type: "GET",
        data: {
            _token: "{{ csrf_token() }}",
            resourcePath: resourcePath, // pass view path dynamically
            modalRowID: modalRowID,
        },
        success: function (response) {
            $("#modal-content").html(response);

            $(".multiple-select").select2({
                theme: "bootstrap4",
                width: $(this).data("width")
                    ? $(this).data("width")
                    : $(this).hasClass("w-100")
                    ? "100%"
                    : "style",
                placeholder: $(this).data("placeholder"),
                allowClear: Boolean($(this).data("allow-clear")),
            });

            var modalEl = document.getElementById("add-edit-modal");
            var modal = new bootstrap.Modal(modalEl, {
                backdrop: "static",
                keyboard: false,
            });
            modal.show();
            $('#isDriverPaired').trigger('change');
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                toastr.error(xhr.responseJSON.errors);
            }
        },
    });
}

function validateForm(formID) {
    let form = document.getElementById(formID);
    let formElements = form.querySelectorAll("input, select, textarea");

    for (let i = 0; i < formElements.length; i++) {
        let element = formElements[i];
        let inputType = element.getAttribute("type");
        let twoFirstLetter = element.name.substring(0, 2);
        let value = element.value;

        if (inputType === "file" && value !== "") {
            let fileOrPic = element.name.substring(element.name.length - 3);
            let inputFile = element.files[0];

            let fileName = (inputFile && inputFile.name) || "";
            let fileSize = inputFile ? inputFile.size : 0;

            let fileExtension = fileName.split(".").pop().toLowerCase();

            let allowedExtensions = [];
            if (fileOrPic === "pic") {
                allowedExtensions = ["jpg", "jpeg", "png"];
            } else if (fileOrPic === "att") {
                allowedExtensions = ["doc", "docx", "pdf", "pptx", "xlsx"];
            } else {
                allowedExtensions = [
                    "doc",
                    "docx",
                    "pdf",
                    "jpg",
                    "jpeg",
                    "png",
                    "pptx",
                    "xlsx",
                ];
            }

            let maxSize = 5 * 1024 * 1024; // 5 MB

            // Check if the file extension is valid (case-insensitive)
            if (
                !allowedExtensions
                    .map((ext) => ext.toLowerCase())
                    .includes(fileExtension)
            ) {
                $(element)
                    .siblings("span.hiddens")
                    .html(invalidExtension + allowedExtensions.join(", "));
                $(element).siblings("span.hiddens").show();
                element.value = ""; // Clear the file input
                return false;
            }

            // Check if the file size exceeds the maximum allowed size
            if (fileSize > maxSize) {
                $(element).siblings("span.hiddens").html(sizeExceed);
                element.value = ""; // Clear the file input
                return false;
            }
        }

        // Validation for required fields
        if (twoFirstLetter === "r_" && (value === "" || value == "0")) {
            $(element).css("border", "1px solid #F00");
            $(element)
                .next()
                .find("span.select2-selection")
                .css("border", "1px solid #F00");
            $(element).siblings("span.hiddens").html(required);
            $(element).siblings("span.hiddens").show();
            $(element).focus();
            return false; // Prevent form submission
        } else {
            $(element).css("border", "");
            $(element).siblings("span").css("border", "");
            $(element).siblings("span.hiddens").hide();
        }
    }

    return true;
}

function lastUrlSegment() {
    // Get the current URL
    var url = window.location.href;
    // Split the URL by '/'
    var segments = url.split("/");
    // Get the last segment
    return segments[segments.length - 1];
}

function capitalizeFirstChar(str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// Pagination function
$(document).on("click", ".pagination a", function (event) {
    event.preventDefault();
    let url = $(this).attr("href");
    if (url !== "#") {
        filterRecord(event, url);
    }
});

function filterRecord(e, url) {
    e.preventDefault();
    if (e.key === "Enter" || e.type === "click" || e.type === "change") {
        let form = document.getElementById("search-filter");
        let formElements = form.querySelectorAll("input, select");
        let params = {};

        formElements.forEach(function (element) {
            let inputName = element.name;
            let inputValue = element.value;
            params[inputName] = inputValue;
        });

        $.ajax({
            type: "GET",
            url: url,
            data: params,
            success: function (result) {
                $("#data_content").html(result);
                var count = $("#total-count-hidden").text();
                $("#total-count").text(count);
            },
            error: function (result) {
                // toaster error
                console.log(result);
            },
        });
    }
}

function validateInput(event) {
    var input = event.target;
    // input.value = input.value.replace(/e/gi, '');
    if (input.value < 0) {
        input.value = 0;
    } else {
        input.value = input.value.replace(/e/gi, "");
    }
}
