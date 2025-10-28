@extends('layouts.master')

@section('title')
    <title>{{ $page_title }}</title>
@endsection()

@section('navbar')
    @include('layouts.lib.navbar')
@endsection()

@section('menubar')
    @include('layouts.lib.menubar')
@endsection()

@section('content-header')
    @include('layouts.lib.contentheader')
@endsection()

@section('main-content')
<div class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card data-table">
                    <div class="card-header">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="role-tab" data-toggle="pill" href="#role" role="tab" aria-controls="role-tab" aria-selected="true">
                                    <i class="fa fa-user-shield"></i> Roles
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="permission-tab" data-toggle="pill" href="#permission" role="tab" aria-controls="permission" aria-selected="false">
                                    <i class="fa fa-user-tag"></i> permissions
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade active show pl-3 pr-3 pt-3" id="role" role="tabpanel" aria-labelledby="role-tab">
                                <label class="custom-label"><i class="fa fa-list"></i> {{ __('rolePermission.role.list') }}</label>
                                <button class="btn btn-xs btn-primary lang-float" onclick="rolePermissionModal(1);">
                                    <i class="fa fa-plus"></i> {{ __('rolePermission.role.add') }}
                                </button>
                                <table class="table custom-table table-bordered mt-2">
                                    <thead>
                                        <tr>
                                            <th style="width: 2%" class="text-center">#</th>
                                            <th style="">{{ __('rolePermission.role.name') }}</th>
                                            <th style="">{{ __('rolePermission.permission.name') }}</th>
                                            <th style="width: 6%" class="actions"><i class="fa fa-cog"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $counter = ($roles->currentPage() - 1) * $roles->perPage() + 1; @endphp
                                        @foreach ($roles as $role)
                                            <tr id="role-tr-{{ $counter }}">
                                                <td class="text-center">{{ $counter }}</td>
                                                <td>
                                                    {{ $role->name }}
                                                </td>
                                                <td>
                                                    <ul class="numbered-list">
                                                        @foreach ($role->permissions as $permission)
                                                            <li>{{ $permission->name }}</li>
                                                        @endforeach
                                                    </ul>
                                                </td>
                                                <td class="text-center pr-0 pl-0">
                                                    <button class="btn btn-outline-primary btn-xs show-edit-btn" onclick="rolePermissionModal(1, '{{ $role->id }}');">
                                                        <i class="bx bx-pen"></i>
                                                    </button>
                                                    <button class="btn btn-outline-danger btn-xs" onclick="confirmModal('{{ $role->id }}', 'role', '{{ $counter }}')" title="{{ __('global.delete') }}">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            @php $counter++; @endphp
                                        @endforeach
                                        @if ($roles->isEmpty())
                                            <tr>
                                                <td colspan="5">
                                                    No Role records found!
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="9">
                                                <nav aria-label="role pagination">
                                                    <ul class="pagination">
                                                        @if ($roles->onFirstPage())
                                                            <li class="page-item disabled">
                                                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                                                            </li>
                                                        @else
                                                            <li class="page-item">
                                                                <a class="page-link" href="{{ $roles->previousPageUrl() }}" tabindex="-1">Previous</a>
                                                            </li>
                                                        @endif
                                
                                                        @foreach ($roles->getUrlRange(1, $roles->lastPage()) as $page => $url)
                                                            @if ($page == $roles->currentPage())
                                                                <li class="page-item active" aria-current="page">
                                                                    <a class="page-link" href="{{ url()->current() }}?page={{ $page }}">{{ $page }}</a>
                                                                </li>
                                                            @else
                                                                <li class="page-item">
                                                                    <a class="page-link" href="{{ url()->current() }}?page={{ $page }}">{{ $page }}</a>
                                                                </li>
                                                            @endif
                                                        @endforeach
                                
                                                        @if ($roles->hasMorePages())
                                                            <li class="page-item">
                                                                <a class="page-link" href="{{ $roles->nextPageUrl() }}">Next</a>
                                                            </li>
                                                        @else
                                                            <li class="page-item disabled">
                                                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Next</a>
                                                            </li>
                                                        @endif
                                                    </ul>
                                                </nav>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="tab-pane fade pl-3 pr-3 pt-3" id="permission" role="tabpanel" aria-labelledby="permission-tab">
                                <label class="custom-label"><i class="fa fa-list"></i> {{ __('rolePermission.permission.list') }}</label>
                                <button class="btn btn-xs btn-primary lang-float" onclick="rolePermissionModal('2');">
                                    <i class="fa fa-plus"></i> {{ __('rolePermission.permission.add') }}
                                </button>
                                <div id="permission-list">
                                    @include('setting/rolePermission.listPermission')
                                </div>
                            </div>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->keys() as $key)
                                        @if ($errors->has($key))
                                            <li>{{ $errors->first($key) }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>

{{-- role permission modal --}}
<div class="modal fade custom-modal" id="role-permission-modal">
    <div class="modal-dialog modal-lg" style="width: 400px">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card card-dark mb-1" id="modal-content"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
{{-- role permission modal --}}

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
                        <div id="confrim-content-text" style="padding: 10px 20px 5px 20px; font-size: 16px"></div>
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

<script>
    var rowid = 0;
    function rolePermissionModal(section, roleID=0, permissionID=0)
    {
        $.ajax({
            url: '{{ route("rolePermission.modal") }}',
            type: 'GET',
            data: {
                "_token": "{{ csrf_token() }}",
                "section": section,
                "roleID": roleID,
                "permissionID": permissionID,
            },
            success: function (response) {
                $("#modal-content").html(response);
                $("#role-perssion").select2();
                $("#role-name").select2();
                $("#role-permission-modal").modal();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    toastr.error(response.errors);
                }
            }
        });
    }
    // submit add role form
    function addRole(formID)
    {
        var roleName = $("#role-name").val();
        var rolePermission = $("#role-perssion").val();
        if(roleName == ""){
            $("#role-name").css("border", "1px solid #F00");
            $("#role-name").focus();
            return false;
        }else{
            $("#role-name").css("border", "");
        }
        if(rolePermission == ""){
            $("#role-perssion").css("border", "1px solid #F00");
            $("#role-perssion").focus();
            return false;
        }else{
            $("#role-perssion").css("border", "");
        }
        $("#"+formID).submit();
    }
    // submit update role form
    function updateRole(formID)
    {
        var roleName = $("#role-name").val();
        var rolePermission = $("#role-perssion").val();
        if(roleName == ""){
            $("#role-name").css("border", "1px solid #F00");
            $("#role-name").focus();
            return false;
        }else{
            $("#role-name").css("border", "");
        }
        if(rolePermission == ""){
            $("#role-perssion").css("border", "1px solid #F00");
            $("#role-perssion").focus();
            return false;
        }else{
            $("#role-perssion").css("border", "");
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
    function confirmModal(roleID, section, trid)
    {
        rowid = trid;
        if(section == "role"){
            var confirmContent = "{{ __('rolePermission.role.delete') }}";
            $("#role-tr-"+trid).addClass("table-danger");
        }else{
            var confirmContent = "{{ __('rolePermission.role.delete') }}";
            $("#permission-tr-"+trid).addClass("table-success");
        }
        $("#confrim-content-text").html(confirmContent);
        $(".delete-btn").attr("onclick", "deleteRole('"+roleID+"', '"+trid+"')");
        $('#confirm-modal').modal({backdrop: 'static', keyboard: false}, 'show');
    }
    // add permission function
    function addPermission()
    {
        var permissionName = $("#permission-name").val();
        if(permissionName == ""){
            $("#permission-name").css("border", "1px solid #F00");
            $("#permission-name").focus();
            return;
        }else{
            $("#permission-name").css("border", "");
        }
        var roleName = $("#role-name").val();
        $.ajax({
            url: '{{ route("role.deleteRole") }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "permissionName": permissionName,
                "roleName": roleName
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
</script>
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
    
</style>
@endsection()