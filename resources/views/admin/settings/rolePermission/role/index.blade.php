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
    .data-table .card-header{
        padding: 0;
        border-bottom: none;
    }
    
    .data-table .card-header li a{
        padding: 10px;
    }
    ul.pagination{
        margin-bottom: 0;
    }
    #confrim-content-text{
        padding: 10px 20px 5px 20px;
        font-size: 16px;
        max-height: 430px;
        overflow-y: scroll
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
            :permission="'Role - All Role'"
            :buttonLabel="$item"
            :buttonClass="'addNewRoleBtn'"
            :resourcePath="'settings.rolePermission.role'"
            :totalCount="$roles->total()"
            :modal="'add-edit-modal'"
        />
        <!--end breadcrumb-->
        <!-- Info boxes -->

        <div class="row row-cols-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-2">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-success" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" href="{{ route('roles') }}">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                                        </div>
                                        <div class="tab-title">Roles</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" href="{{ route('permission') }}">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i></div>
                                        <div class="tab-title">permissions</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content py-3">
                            <div class="tab-pane fade show active" id="successhome" role="tabpanel">
                                <label class="custom-label" style="margin-bottom: 10px"><i class="bx bx-list"></i> {{ __('rolePermission.role.list') }}</label>

                                <div id="role-list">
                                    @include('settings/rolePermission.role.list')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /page content -->

{{-- delete confrim modal --}}
<div class="modal fade custom-modal" id="confirm-modal">
    <div class="modal-dialog modal-lg" style="width: 400px">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card card-dark mb-1">
                    <div class="card-header" style="padding: 12px 5px 8px 5px">
                        <h3 class="card-title"><i class="fa fa-check" style="margin-top: -1px"></i> {{ __('global.confirmTitle'); }}</h3>
                        <button type="button" class="close cancel-btn" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; font-size: 20px; top: 11px; {{ app()->getLocale() == 'fa' ? 'left' : 'right' }}: 6px;">
                            <i class="fa fa-times-circle"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div id="confrim-content-text"></div>
                        <div style="padding: 0px 10px 5px 18px;">
                            <button class="btn btn-primary btn-sm delete-btn">
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
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('setting')
    @include('layouts.setting')
@endsection

@section('js')
<script>
    // submit add role form
    function addRole(formID)
    {
        var roleName = $("#role-name").val();
        var rolePermission = $("#role-permission").val();
        if(roleName == ""){
            $("#role-name").css("border", "1px solid #F00");
            $("#role-name").focus();
            return false;
        }else{
            $("#role-name").css("border", "");
        }
        if(rolePermission == ""){
            $("#role-permission").css("border", "1px solid #F00");
            $("#role-permission").focus();
            return false;
        }else{
            $("#role-permission").css("border", "");
        }
        $("#"+formID).submit();
    }
    // submit update role form
    function updateRole(formID)
    {
        var roleName = $("#role-name").val();
        var rolePermission = $("#role-permission").val();
        if(roleName == ""){
            $("#role-name").css("border", "1px solid #F00");
            $("#role-name").focus();
            return false;
        }else{
            $("#role-name").css("border", "");
        }
        if(rolePermission == ""){
            $("#role-permission").css("border", "1px solid #F00");
            $("#role-permission").focus();
            return false;
        }else{
            $("#role-permission").css("border", "");
        }
        $("#"+formID).submit();
    }
    // delete role
    function deleteRole(roleID, trid)
    {
        $.ajax({
            url: '{{ route("role.deleteRole") }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "roleID": roleID
            },
            success: function (response) {
                $(".cancel-btn").click();
                $("#role-tr-"+trid).remove();
                toastr.success(response.success);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    toastr.error(response.errors);
                }
            }
        });
    }
    // open confirm modal
    function confirmModal(roleID, trid)
    {
        rowid = trid;
        var confirmContent = "{{ __('rolePermission.role.delete') }}";
        $("#role-tr-"+trid).addClass("table-danger");
        $("#confrim-content-text").html(confirmContent);
        $(".delete-btn").attr("onclick", "deleteRole('"+roleID+"', '"+trid+"')");
        $('#confirm-modal').modal({backdrop: 'static', keyboard: false}, 'show');
    }
    $(".cancel-btn").click(function (){
        $("#role-tr-"+rowid).removeClass("table-danger");
    });

    // Function to select or deselect all permissions
    function selectAllPermissions(checkbox) {
        const selectElement = document.getElementById('role-permission');
        const options = selectElement.options;
        for (let i = 0; i < options.length; i++) {
            if (options[i].value != 0) {
                options[i].selected = checkbox.checked;
            }
        }

        // Trigger change event to update Select2
        $(selectElement).trigger('change');
    }
</script>
@endsection