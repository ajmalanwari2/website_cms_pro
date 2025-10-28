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
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Users</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard'); }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">User List</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h5 class="mb-0">{{ __('users.list') }}</h5>
                        </div>
                        <div id="records-list">
                            @include('settings/user.list')
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </div>
</div>


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

    function addUser()
    {
        if (!validateForm("user-add-form")) {
            return;
        }
        var formData = new FormData();
        formData.append('type', $('#type').val());
        formData.append('userid', $('#userid').val());
        formData.append('name', $('#name').val());
        formData.append('email', $('#email').val());
        formData.append('role', $('#role').val());
        formData.append('password', $('#password').val());

        formData.append('_token', "{{ csrf_token() }}");

        $.ajax({
            url: '{{ route("user.store") }}',
            type: 'POST',
            data: formData,
            contentType: false,
            cache: false,
            processData: false,
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}"  // Set the CSRF token in the request headers
            },
            success: function(response) {
                $('.error-section').html("");
                if(response == 1){
                    $('#email').val()
                    $('.error-section').append('<div class="alert alert-danger" style="padding:5px;">Role Is Required.</div>');
                }else if(response == 2){
                    $('.error-section').append('<div class="alert alert-danger" style="padding:5px;">The selected role is invalid.</div>');
                }else{
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                $('.error-section').html("");alert('error');
                // Handle error response
                var errors = xhr.responseJSON.errors;
                if (errors) {
                    $.each(errors, function(key, value) {
                        // Assuming you have an element with id 'error-container'
                        $('.error-section').append('<div class="alert alert-danger" style="padding:5px;">' + value + '</div>');
                    });
                }
                toastr.error(error);
            }
        });
    }
    
    // open confirm modal
    function openChangeUserStatusModal(uid, status, trid)
    {
        rowid = trid;
        var confirmTitle = "{{ __('global.confirmTitle') }}";
        if(status == "Active"){
            var confirmContent = "{{ __('users.enable_user') }}";
            $("#uid-"+trid).addClass("table-danger");
        }else{
            var confirmContent = "{{ __('users.disable_user') }}";
            $("#uid-"+trid).addClass("table-success");
        }
        $("#confrim-content-text").html(confirmContent);
        
            $("#tr-"+trid).addClass('alert alert-danger');
            $("#user-id").val(uid);
            $("#user-status").val(status);
            var modalEl = document.getElementById('chage-user-status-modal');
            var modal = new bootstrap.Modal(modalEl, {
                backdrop: 'static',
                keyboard: false
            });
            modal.show();
        $('#chage-user-status-modal').modal({backdrop: 'static', keyboard: false}, 'show');
    }

    function enableDisableStatus()
    {
        let uid = $("#user-id").val();
        let status = $("#user-status").val();
        $.ajax({
            url: "{{ route('user.changestatus') }}",
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "uid": uid,
                "status": status,
            },
            success: function (response) {
                window.location.reload();
            },
            error: function(xhr) {
                window.location.reload();
            }
        });
    }

    // this function is used to list all user by type. 1=employee. 2=teacher. 3=student
    function getUsers(id, selectID, selectName, resultID, url)
    {
        $("#role").val('0');
        $("#role").trigger('change.select2');
        $("#name").val('');
        $("#email").val('');

        $.ajax({
            url: url,
            type: 'GET',
            headers: { 'X-CSRF-TOKEN': _TOKEN },
            data: {
                "id": id,
                "selectID": selectID,
                "selectName": selectName,
            },
            success: function (response) {
                $('#' + resultID).html(response);
                $('.select2').select2({
                    theme: 'bootstrap4',
                    width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
                    placeholder: $(this).data('placeholder'),
                    allowClear: Boolean($(this).data('allow-clear')),
                });
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }

    // get user info
    function getUserInfo(userid)
    {
        var type = $("#type").val();
        $.ajax({
            url: '{{ route("getUserInfo") }}',
            type: 'POST',
            data:{
                "_token": "{{ csrf_token() }}",
                userid: userid,
                type: type
            },
            success: function(response) {
                $("#name").val(response.name);
                $("#email").val(response.email);
                $("#previewImage").attr('src', response.photo);
                if(type == 3){
                    $("#role").val('Student');
                    $("#role").trigger('change.select2');
                    $('#role').prop('disabled', true);
                }else if(type == 2){
                    $("#role").val('Teacher');
                    $("#role").trigger('change.select2');
                    $('#role').prop('disabled', true);
                }else{
                    $('#role').prop('disabled', false);
                    $('#role option[value="Student"]').prop('disabled', true);
                    $('#role option[value="Teacher"]').prop('disabled', true);
                }
            },
            error: function(xhr, status, error) {
                toastr.error(error);
            }
        });
    }

    $('#chage-user-status-modal').on('hidden.bs.modal', function () {
        $("table tr").removeClass('alert alert-danger')
    });

</script>
@endsection