<!doctype html>
<html lang="{{ app()->getLocale() == 'en' ? 'en' : 'fa' }}" dir="{{ app()->getLocale() == 'en' ? 'ltr' : 'rtl' }}">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- favicon -->
  <link rel="icon" href="{{asset('assets/images/icon.ico') }}" type="image/x-icon">

  <!-- plugins -->
  <link href="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
  <link href="{{asset('assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/select2/css/select2-bootstrap4.css')}}" rel="stylesheet" />
  <link href="{{asset('assets/plugins/metismenu/css/metisMenu.min.css')}}" rel="stylesheet" />

  {{-- font-awesome --}}
  {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css')}}" rel="stylesheet"> --}}

  <!-- loader -->
  <link href="{{asset('assets/css/pace.min.css')}}" rel="stylesheet" />
  <script src="{{asset('assets/js/pace.min.js')}}"></script>

  <!-- Bootstrap CSS -->
  @if(app()->getLocale() === 'fa' || app()->getLocale() === 'pa')
      <!-- RTL Styles -->
      <link href="{{asset('assets/css-rtl/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css-rtl/bootstrap-extended.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css-rtl/app.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css-rtl/icons.css')}}" rel="stylesheet">
  @else
      <!-- LTR Styles -->
      <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/bootstrap-extended.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/app.css')}}" rel="stylesheet">
      <link href="{{asset('assets/css/icons.css')}}" rel="stylesheet">
  @endif

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

  <!-- Theme Style CSS (مشترک) -->
  <link rel="stylesheet" href="{{asset('assets/css/dark-theme.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/css/semi-dark.css')}}" />
  <link rel="stylesheet" href="{{asset('assets/css/header-colors.css')}}" />

  <style>
    td .badge {
        background-color: #3498db;
    }

    /* Status badges */
    .badge.bg-active {
        background-color: #2ecc71 !important;
        color: white;
    }

    .badge.bg-inactive {
        background-color: #95a5a6 !important;
        color: white;
    }
    .pull-right{float:right !important}.pull-left{float:left !important}
 </style>
  @yield('title')

  @yield('css')

</head>


<body>
<div class="wrapper">

<!-- sidebar menu -->
@yield('sidebar')
<!-- /sidebar menu -->

<!-- top navigation -->
@yield('navbar')
<!-- /top navigation -->

<!-- page content -->
@yield('main-content')
<!-- /page content -->

{{-- add-edit modal --}}
<div class="modal fade show" id="add-edit-modal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-content"></div>
    </div>
</div>
{{-- add-edit modal --}}

<!-- Delete Confirm modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">{{ __('global.deleteItem', ['item' => $item]) }}</h5>
        <button type="button" class="btn-close confrim-m{{ app()->getLocale() == 'en' ? 'l' : 'r' }}" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">{{ __('global.are_you_sure_want_to_proceed') }}</div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('global.cancel') }}</button>
        <button type="button" class="btn btn-danger" id="confirmButton">{{ __('global.confirm') }}</button>
        </div>
    </div>
    </div>
</div>

<!--start overlay-->
<div class="overlay toggle-icon"></div>
<!--end overlay-->

<!-- setting content -->
@yield('setting')
<!-- setting content -->
</div>
</div>
<!-- Bootstrap JS -->
<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
<!--plugins-->
<script src="{{asset('assets/js/jquery.min.js')}}"></script>
<script src="{{asset('assets/plugins/simplebar/js/simplebar.min.js')}}"></script>
<script src="{{asset('assets/plugins/metismenu/js/metisMenu.min.js')}}"></script>
<script src="{{asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js')}}"></script>
<script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
<script src="{{asset('assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<script src="{{asset('assets/plugins/chartjs/js/Chart.min.js')}}"></script>
<script src="{{asset('assets/plugins/chartjs/js/Chart.extension.js')}}"></script>
<script src="{{asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--notification js -->
<script src="{{asset('assets/plugins/notifications/js/lobibox.min.js')}}"></script>
<script src="{{asset('assets/plugins/notifications/js/notifications.min.js')}}"></script>
<script src="{{asset('assets/plugins/notifications/js/notification-custom-script.js')}}"></script>
<!--app JS-->
<script src="{{asset('assets/js/app.js')}}"></script>
<!-- Toastr -->
<link rel="stylesheet" href="{{ asset('assets/plugins/toastr/toastr.min.css') }}">

<script src="{{ asset('assets/plugins/toastr/toastr.min.js') }}"></script>
<!-- End Toastr -->
{{-- custom js link --}}
<script src="{{asset('assets/js/core.js')}}"></script>
<link rel="stylesheet" href="{{ asset('assets/fonts/font-awesome/css/all.min.css') }}">

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var required = "{{ __('global.required') }}";
    var noAttachment = "{{ __('global.no_attachment') }}";
    var invalidExtension = "{{ __('global.invalid_file_extension') }}";
    var sizeExceed = "{{ __('global.file_size_exceed') }}";
    var recordNotFound = "{{ __('global.recordNotFound') }}";

    function setLanguage(lang)
    {
        window.location = "{{ url('/lang') }}/" + lang;
    }

    $(document).on("submit", '#search-filter', function(e) {// search function
        e.preventDefault();

        if (!validateForm('search-filter')) {
            return false;
        }

        // Use serialize() if you don't have file inputs
        var formData = $(this).serialize();

        $.ajax({
            url: $(this).attr('action'),
            type: "GET",  // Change to GET
            data: formData,
            // contentType: false,  // Not needed when using serialize
            cache: false,
            // processData: false,  // Not needed when using serialize
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"  // Ensure your token is set correctly
            },
            success: function(result) {
                $('#data_content').html(result);
                var count = $('#item-total-count-hidden').text();
                $('#item-total-count').text(count);
            },
            error: function(result) {
                var errors = result.responseJSON ? result.responseJSON : 'An error occurred'; // Handle errors safely
                $('#data_content').html(errors);
            }
        });
    });

    $(document).on("click", "#mark-all-read-all", function(){
        $.ajax({
            url: '{{ route('notifications.markAllRead') }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}' // Include CSRF token
            },
            success: function(response) {
                if (response.status == 'success') {
                    // Optionally, refresh the notifications list or update the UI
                    $('.unreadNotification').fadeOut(400, function() {
                        $(this).remove(); // Remove the element after fading out
                    });
                    $('#unreadNotificationCount').html(0);
                    $('#unreadNotificationArea').html('');
                } else {
                    console.log(response.message);
                }
            },
            error: function(xhr) {
                alert('An error occurred while marking notifications as read.');
            }
        });
    });

    $(document).on('click', '.confirmationModal', function() {
        let modalTitle = $(this).attr('data-title');
        let modalDescription = $(this).attr('data-description');
        let requestAction = $(this).attr('data-request-action');
        let actionType = $(this).attr('data-action-type') || 'POST'; // Use POST as default
        let item_id = $(this).attr('data-id');
        let operation_status = $(this).attr('data-status');
        let route = $(this).attr('data-lar');
        let type = $(this).attr('data-type');
        
        $('.confirmation_item_id').val(item_id);
        $('.operation_status').text(operation_status);
        $('.lar').text(route);

        // Pass actionType to showConfirmationModal
        showConfirmationModal(modalTitle, modalDescription, requestAction, actionType);
        
        $('#confirmationModal').modal('show');
    });

    function showConfirmationModal(modalTitle, modalDescription, requestAction, actionType) { // show confirmation modal and add dynamic content
        // Update the modal title
        document.getElementById('confirmationModalLabel').innerText = modalTitle;

        // Update the modal description
        document.getElementById('modalDescriptionText').innerText = modalDescription;

        // Update the request action on the button
        const approveButton = document.querySelector('.ApproveDeclineButton');
        approveButton.setAttribute('data-request-action', requestAction);
        approveButton.setAttribute('data-action-type', actionType);
    }

    $(document).on("click", ".ApproveDeclineButton", function(e){
        let itemId = $('#confirmation_item_id').val();
        let operation_status = $('#operation_status').text();
        let route = $('#lar').text();
        let request_action = $(this).attr('data-request-action');
        let actionType = $(this).attr('data-action-type') || 'POST';

        if(actionType == 'GET'){
            setTimeout(function() {
                window.location.href = route;
            }, 500); // half seconds in milliseconds
        } else {
            $.ajax({
                url: route,
                method: actionType,
                data: {
                    item_id: itemId,
                    request_action: request_action,
                    operation_status: operation_status
                },
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"  // Set the CSRF token in the request headers
                },
                success: function(response) {
                    // Handle the success response
                    if(response.status == 'success'){
                        toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                        toastr.success(response.message);
                    } else {
                        toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                        toastr.error(response.message);
                    }
                    $('#confirmationModal').modal('hide');
                        setTimeout(function() {
                            location.reload();
                        }, 3000);
                },
                error: function(xhr, status, error) {
                    // Handle the error response
                    console.error('Form submission failed');
                    console.error(error);
                }
            });
        }
    });
    
    function showImages(event, inputID, imgID)
    {
        // Get the file input element
        var fileInput = $('#'+inputID);
        // Get the image element
        var previewImage = $('#'+imgID);

        // Get the selected file
        var file = event.target.files[0];

        // Create a FileReader object
        var reader = new FileReader();

        // Set up the FileReader onload event
        reader.onload = function(e) {
        // Set the src attribute of the image element to the loaded data URL
            previewImage.attr('src', e.target.result);
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(file);
    }

    function setFileNameToFileInput(event) {
        var input = event.target;
        var fileName = input.files[0].name;

        // Find the <span> with class driverDocumentAttachmentDiv
        var label = input.closest('div').previousElementSibling.querySelector('.driverDocumentAttachmentDiv .attachment');

        console.log(label); // should log the <a> element
        label.innerText = fileName;
    }


    var _GLOBAL_URL = "{{ asset('') }}";
    var _TOKEN = "{{ csrf_token() }}"; 

    $('.select2').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
    $('.multiple-select').select2({
        theme: 'bootstrap4',
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });

    function resetForm() {
        // reset the form via jQuery
        $('#search-filter').trigger("reset");

        // reset select2 fields
        $('#search-filter').find('select').val(null).trigger('change');

        // re-submit if needed
        $('#search-filter').submit();
    }
    // change the notification dropdown direction
    document.querySelectorAll('.dropdown-menu-end').forEach(function(el) {
        el.setAttribute('data-bs-popper', 'none');
    });

</script>

@yield('js')
@include('layouts.toast')

</body>
</html>