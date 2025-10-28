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
            :permission="'Permission - All Permission'"
            :buttonLabel="$item"
            :buttonClass="'addNewPermissionBtn'"
            :resourcePath="'settings.rolePermission.permission'"
            :totalCount="$permissions->total()"
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
                                <a class="nav-link" href="{{ route('roles') }}">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                                        </div>
                                        <div class="tab-title">Roles</div>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" href="{{ route('permission') }}">
                                    <div class="d-flex align-items-center">
                                        <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i></div>
                                        <div class="tab-title">permissions</div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content py-3">
                            <div class="tab-pane fade show active" id="successhome" role="tabpanel">
                                <label class="custom-label" style="margin-bottom: 10px"> {{ __('rolePermission.permission.list') }}</label>
                                <div id="role-list">
                                    @include('settings/rolePermission.permission.list')
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
                        <h3 class="card-title">
                            <i class="fa fa-check" style="margin-top: -1px"></i> {{ __('global.confirmTitle'); }}
                        </h3>
                        <button type="button" class="close cancel-btn" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; font-size: 20px; top: 11px; {{ app()->getLocale() == 'fa' ? 'left' : 'right' }}: 6px;">
                            <i class="fa fa-times-circle"></i>
                        </button>
                    </div>
                    <div class="card-body">
                        <div style="padding: 10px 20px 5px 20px; font-size: 16px">
                            {{ __('rolePermission.permission.delete') }}
                        </div>
                        <div style="padding: 0px 10px 5px 18px;">
                            <button class="btn btn-primary btn-sm delete-permission-btn">
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
    var rowid = 0;
    // add permission function
    function addPermission(formID)
    {
        var permissionName = $("#permission-name").val();
        if(permissionName == ""){
            $("#permission-name").css("border", "1px solid #F00");
            $("#permission-name").focus();
            return;
        }else{
            $("#permission-name").css("border", "");
        }
        $("#"+formID).submit();
    }
    // update permission function
    function updatePermission(id, pid)
    {
        var permission = $("#tr-"+id+" #permission").val();
        if(permission == ""){
            $("#tr-"+id+" #permission").css("border", "1px solid #F00");
            $("#tr-"+id+" #permission").focus();
            return false;
        }else{
            $("#tr-"+id+" #permission").css("border", "");
        }
        $.ajax({
            url: '{{ route("permission.updatePermission") }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "permissionName": permission,
                'permissionID': pid
            },
            success: function (response) {
                toggleEdit(id, false);
                $("#pname-"+id).html(permission);
                round_success_noti('Permission Successfully Updated');
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    toastr.error(response.errors);
                }
            }
        });
    }
    // open confirm modal
    function confirmModal(permissionID, trid)
    {
        rowid = trid;
        $("#permission-tr-"+trid).addClass("table-danger");
        $(".delete-permission-btn").attr("onclick", "deletePermission('"+permissionID+"', '"+trid+"')");
        $('#confirm-modal').modal({backdrop: 'static', keyboard: false}, 'show');
    }
    // delete permission
    function deletePermission(pid, trid)
    {
        $.ajax({
            url: '{{ route("permission.deletePermission") }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                "pid": pid
            },
            success: function (response) {
                $(".cancel-btn").click();
                $("#permission-tr-"+trid).remove();
                toastr.success(response.success);
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    toastr.error(response.errors);
                }
            }
        });
    }
    $(".cancel-btn").click(function (){
        $("#permission-tr-"+rowid).removeClass("table-danger");
    });
</script>
@endsection