@extends('layouts.master')

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
                        <label class="card-title"><i class="fa fa-info-circle"></i> {{ __('user.view') }}</label>
                        <button type="button" class="btn btn-primary btn-sm float-{{ app()->getLocale() == 'fa' ? 'left' : 'right' }}" data-toggle="modal" data-target="#add-role-modal">
                            <i class="fa fa-cog"></i> {{ __('user.add_role') }}
                        </button>
                        <a href="{{ route('users') }}" class="btn btn-primary btn-sm float-{{ app()->getLocale() == 'fa' ? 'left' : 'right' }}">
                            <i class="fa fa-arrow-circle-left"></i> {{ __('global.back') }}
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table" style="margin-bottom: 10px; border-bottom: 3px ridge #EEE; border-top: 3px ridge #EEE;">
                            <tr>
                                <td style="width: 10%">
                                    <label class="custom-label">{{ __('user.name') }}</label>
                                </td>
                                <td style="width: 70%">
                                    {{ $user->name }}
                                </td>
                                <td rowspan="4" class="text-center">
                                    @php
                                        $src = "";
                                        if($user->type == "Employee"){
                                            $src = $user->photo != '' ? asset('upload/images/employee/'.$user->photo) : asset('dist/img/system-img/default-img.png');
                                        }else if($user->type == "Teacher"){
                                            $src = $user->photo != '' ? asset('upload/images/teacher/'.$user->photo) : asset('dist/img/system-img/default-img.png');
                                        }else if($user->type == "Student"){
                                            $src = $user->photo != '' ? asset('upload/images/student/img/'.$user->photo) : asset('dist/img/system-img/default-img.png');
                                        }else{
                                            $src = $user->photo != '' ? asset('upload/images/users/'.$user->photo) : asset('dist/img/system-img/default-img.png');
                                        }
                                    @endphp
                                    <img id="profile-pic" src="{{ $src }}" style="width: 120px; height: 120px; border: 3px double #929292; border-radius: 50%;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="custom-label">{{ __('user.email') }}</label>
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="custom-label">{{ __('user.type') }}</label>
                                </td>
                                <td>
                                    {{ $user->type }}
                                </td>
                            </tr>
                        </table>
                        <div class="row mt-2">
                            <div class="col-12">
                                <input type="hidden" id="userid" value="{{ encryption($user->id) }}">
                                @foreach($user->roles as $role)
                                    <div class="card rooms-section" id="role-{{ $role->name }}">
                                        <div class="card-header">
                                            <h3 class="card-title" style="margin-top: 2px">
                                                <i class="fa fa-user-shield"></i> {{ __('user.role_name') }}: <span style="border: 1px solid #a1a1a1; background: #fff; padding: 2px 5px; border-radius: 5px;">{{ $role->name }}</span>
                                            </h3>
                                            <div class="card-tools">
                                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <button type="button" class="btn btn-tool" title="{{ __('global.delete_role') }}" onclick="confirmModal('{{ $role->name }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="card-body p-2" style="border: 1px solid #CCC">
                                            <div class="row pb-2">
                                                <ul class="numbered-list">
                                                    @foreach($role->permissions as $permission)
                                                        <li>{{ $permission->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
</div>
{{-- add new role to user modal --}}
<div class="modal fade custom-modal" id="add-role-modal">
    <div class="modal-dialog modal-lg" style="width: 400px">
        <div class="modal-content">
            <div class="modal-body">
                <form id="add-role-form" action="{{ route('user.storeRole') }}" method="POST">
                    @csrf
                    <input type="hidden" name="userid" value="{{ encryption( $user->id )}}">
                    <div class="card card-dark mb-1">
                        
                        <div class="card-header" style="padding: 12px 5px 8px 5px">
                            <h3 class="card-title"><i class="fa fa-user-shield"></i> {{ __('user.add_role') }}</h3>
                            <button type="button" class="close cancel-btn" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; font-size: 20px; top: 11px; {{ app()->getLocale() == 'fa' ? 'left' : 'right' }}: 6px;">
                                <i class="fa fa-times-circle"></i>
                            </button>
                        </div>

                        <div class="card-body p-2">
                            <label class="custom-label">{{ __('user.role') }}</label>
                            <select name="role" id="role" class="form-control">
                                <option value="0">{{ __('global.select') }}</option>
                                @foreach ($availableRoles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            <button type="button" class="btn btn-primary btn-sm change-status-btn mt-1" onclick="addRole();">
                                <i class="fa fa-check"></i> {{ __('global.confrim') }}
                            </button>
                            <button type="button" class="btn btn-danger btn-sm cancel-btn mt-1" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i> {{ __('global.cancel') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

{{-- delete role confrim modal --}}
<div class="modal fade custom-modal" id="confirm-role-modal">
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
                        <div style="padding: 10px 20px 5px 20px; font-size: 16px">
                            {{ __('user.delete_role') }}
                        </div>
                        <div style="padding: 0px 10px 5px 18px;">
                            <button class="btn btn-primary btn-sm change-status-btn" onclick="removeRole();">
                                <i class="fa fa-check"></i> {{ __('global.confrim') }}
                            </button>
                            <button class="btn btn-danger btn-sm cancel-btn" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fa fa-times"></i> {{ __('global.cancel') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
{{-- delete role confrim modal --}}

<script>
var roleName = "";
// add role function
function addRole()
{
    var role = $("#role").val();
    if(role == 0){
        $("#role").css("border", "1px solid #F00");
        return;
    }
    $("#add-role-form").submit();
}

// open confirm modal
function confirmModal(role)
{
    roleName = role;
    $("#role-"+roleName+" .card-header").addClass("custom-danger");
    $('#confirm-role-modal').modal({backdrop: 'static', keyboard: false}, 'show');
}

function removeRole()
{
    var userid = $("#userid").val();
    $.ajax({
        url: '{{ route("user.removeRole") }}',
        type: 'POST',
        data: {
            "_token": "{{ csrf_token() }}",
            "roleName": roleName,
            "userid": userid
        },
        success: function(response) {
            $("#role-"+roleName).remove();
            $('.cancel-btn').click();
            toastr.success(response.success);
        },
        error: function(xhr, status, error) {
            // Check if the error response contains the 'errors' object
            if (xhr.responseJSON && xhr.responseJSON.errors && xhr.responseJSON.errors.user) {
                // Display the error message in the Blade view
                var errorMessage = xhr.responseJSON.errors.user;
                toastr.error(errorMessage);
            } else {
                toastr.error('An error occurred. Please try again later.');
            }
        }
    });
}

$(".cancel-btn").click(function (){
    $("#role-"+roleName+" .card-header").removeClass("custom-danger");
});

</script>
<style>
    .rooms-section{
        box-shadow: none;
        margin-bottom: 10px;
    }
    .rooms-section .card-header{
        border: 1px solid #ccc;
        padding: 5px 10px;
        background-image: linear-gradient(#EEE, #FFF, #EEE);
    }
    .rooms-section .card-header button{
        color: #555;
        margin-top: -13px
    }
</style>
@endsection()