@extends('layouts.master')
@section('title')
    <title>{{ $page_title }}</title>
@endsection()

@section('sidebar')
    @include('layouts.sidebar')
@endsection()

@section('navbar')
    @include('layouts.navbar')
@endsection()

@section('css')
<style>
    .custom-table td, .custom-table td button{
        font-size: 14px;
    }
    .custom-table td button.custom-success, .custom-table td button.custom-danger{
        width: 85px;
    }
</style>
@endsection
@section('main-content')

<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <!-- card-header -->
        <!--cenario 1: only header, 2:header and add button, 3:header and print, other:header , add button and prin. type:both[pdf,excel], type:[pdf], type:[excel] -->
        <x-card-header 
            :scenario="'2'"
            :pageTitle="$page_title"
            :permission="'Location - Add New Location'"
            :buttonLabel="$item"
            :buttonClass="'addNewLocationBtn'"
            :resourcePath="'settings.location'"
            :totalCount="$allLocations->total()"
            :modal="'add-edit-modal'"
        />
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="mt-3">
                            {{-- Search --}}
                            <x-search-filter 
                                :rows="1" 
                                :inputs-per-row="2" 
                                :col-md-classes="[
                                    ['col-md-10','col-md-2']
                                ]" 
                                :input-config="[
                                    [
                                        ['type' => 'text'], /* searial number */
                                        ['type' => 'select', 'options' => $paginationArray]
                                    ]
                                ]"
                                :names="[
                                    [
                                        'search_term',
                                        'pagination_search_name'     {{-- fixed typo --}}
                                    ]
                                ]"
                                :ids="[
                                    [
                                        'search_term_id',
                                        'pagination_search_name_id'  {{-- fixed typo --}}
                                    ]
                                ]"
                                :placeholders="[
                                    [
                                        __('global.search_term'),
                                        25
                                    ]
                                ]"
                                form-action="{{ route('locations') }}"
                                report-type="both" 
                                :lang="$lang"
                            />
                            <!-- end Search -->
                        </div>
                        <hr/>
                        <div id="data_content">
                            @include('settings/location.list')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
        <x-confirmation-modal />
    </div>
</div>

{{-- delete confrim modal --}}
<div class="modal fade custom-modal" id="confirm-modal">
    <div class="modal-dialog modal-lg" style="width: 400px">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card card-dark mb-1">
                    <div class="card-header" style="padding: 12px 5px 8px 5px">
                        <h3 class="card-title text-white"><i class="fa fa-check" style="margin-top: -1px"></i> {{ __('global.confirmTitle'); }}</h3>
                        <button type="button" class="close cancel-btn" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; font-size: 20px; top: 11px; {{ app()->getLocale() == 'fa' ? 'left' : 'right' }}: 6px;">
                            <i class="fa fa-times-circle"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="confrim-content-text" style="padding: 10px 20px 5px 20px; font-size: 16px"></div>
                        <div style="padding: 0px 10px 5px 18px;">
                            <button class="btn btn-primary btn-sm change-status-btn">
                                {{ __('global.confrim') }}
                            </button>
                            <button class="btn btn-danger btn-sm cancel-btn" data-bs-dismiss="modal" aria-label="Close">
                                {{ __('global.cancel') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
{{-- delete confrim modal --}}

<!-- /page content -->
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('setting')
    @include('layouts.setting')
@endsection

@section('js')
<script>
    $(document).on('submit', '#add-location-form', function(e) {
        e.preventDefault();
        if(!validateForm('add-location-form')){
            return false;
        }
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"  // Set the CSRF token in the request headers
            },
            success: function(response) {
                if(response.status == 'success'){
                    toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 3000); // 3 seconds in milliseconds (1000 milliseconds = 1 second)
                    // Handle success response
                } else {
                    console.log(response);
                    toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                toastr.options =
                {
                "closeButton" : true,
                "progressBar" : true
                }
                toastr.error(error);
            }
        });
    });

    $(document).on('submit', '#edit-location-form', function(e) {
        e.preventDefault();
        if(!validateForm('edit-location-form')){
            return false;
        }
        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"  // Set the CSRF token in the request headers
            },
            success: function(response) {
                if(response.status == 'success'){
                    toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.reload();
                    }, 3000); // 3 seconds in milliseconds (1000 milliseconds = 1 second)
                    // Handle success response
                } else {
                    console.log(response);
                    toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                    toastr.error(response.message);
                }
            },
            error: function(xhr, status, error) {
                // Handle error response
                toastr.options =
                {
                "closeButton" : true,
                "progressBar" : true
                }
                toastr.error(error);
            }
        });
    });

    // Delete Event
    $(document).on("click", ".deleteBtn", function() {
        // Store the row element and the record ID (or any other relevant data)
        var $row = $(this).closest("tr");
        var location_id = $(this).attr('data-id');
        var originalRoute = $(this).attr('data-url');
        
        var newRoute = originalRoute.replace(/_route/g, '').replace(/s/g, '');
        // Construct the URL using the new route
        var urllink = '/location/' + newRoute;
        
        // Show the confirmation modal
        $("#confirmModal").modal("show");

        // Add a click event listener to the "Confirm" button
        $("#confirmButton").off("click").on("click", function() {
            // Perform AJAX request to delete the record
            $.ajax({
                url: urllink,
                type: "POST",
                data: { location_id: location_id },
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"  // Set the CSRF token in the request headers
                },
                success: function(response) {
                    if(response.status == 'success'){
                        $row.remove();// Remove the row from the table
                        $("#confirmModal").modal("hide"); // Hide the confirmation modal
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
                },
                error: function(error) {
                    toastr.options =
                    {
                    "closeButton" : true,
                    "progressBar" : true
                    }
                    toastr.error(error);
                    $("#confirmModal").modal("hide"); // Hide the confirmation modal
                }
            });
        });
    });
</script>
@endsection