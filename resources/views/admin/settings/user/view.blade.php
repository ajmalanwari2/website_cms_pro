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
            padding: 2px 0;
        }
        .rooms-section button:hover {
            color: #F00;
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
                        <li class="breadcrumb-item" aria-current="page">User View</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <h5 class="mb-0">
                                <i class="fa fa-info-circle"></i> {{ __('users.view') }}
                            </h5>
                            <div>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-role-modal">
                                    <i class="fa fa-cog fs-13"></i> {{ __('users.add_role') }}
                                </button>
                                <a href="{{ route('users') }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-arrow-circle-left fs-13"></i> {{ __('global.back') }}
                                </a>
                            </div>
                        </div>
                        <table class="table" style="margin-bottom: 10px; border-bottom: 3px ridge #EEE; border-top: 3px ridge #EEE;">
                            <tr>
                                <td style="width: 10%">
                                    <label class="custom-label">{{ __('users.name') }}</label>
                                </td>
                                <td style="width: 70%">
                                    {{ $users->name }}
                                </td>
                                <td rowspan="4" class="text-center">
                                    @php
                                        $default = asset('assets/images/default-img.png');
                                        $folder = $users->type === 'driver' ? 'driver' : 'employee';

                                        $src = $users->photo ? asset('storage/attachment/'.$folder.'/image/'.$users->photo)
                                            : $default;
                                    @endphp

                                    <img alt="image" src="{{ $src }}" style="width: 120px; height: 120px; border: 1px double #CCC; border-radius: 50%;">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="custom-label">{{ __('users.email') }}</label>
                                </td>
                                <td>
                                    {{ $users->email }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label class="custom-label">{{ __('users.type') }}</label>
                                </td>
                                <td>
                                    {{ $users->type }}
                                </td>
                            </tr>
                        </table>
                        <div class="row mt-2">
                            <div class="col-12">
                                <input type="hidden" id="userid" value="{{ encryption($users->id) }}">
                                @foreach($users->roles as $role)
                                    <div class="card rooms-section">
                                        <div class="card-header d-flex justify-content-between align-items-center" id="tr-{{ $role->id }}">
                                            <label class="card-title mb-0" style="font-size: 16px; font-weight: bold">
                                                <i class="fa fa-user-shield me-2"></i> {{ $role->name }}
                                            </label>
                                            <div>
                                                <!-- دکمه حذف -->
                                                <button type="button" class="btn" title="{{ __('global.delete_role') }}" 
                                                    onclick="openDeleteRoleModal({{ $users->id }}, {{ $role->id }})">
                                                    <i class="fas fa-trash fs-13"></i>
                                                </button>
                                                <!-- دکمه Collapse -->
                                                <button type="button" class="btn btn-sm collapse-btn" 
                                                        data-bs-toggle="collapse" 
                                                        data-bs-target="#collapse-{{ $role->name }}" 
                                                        aria-expanded="true" 
                                                        aria-controls="collapse-{{ $role->name }}">
                                                    <i class="fas fa-minus fs-13"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <!-- بخش Collapse -->
                                        <div id="collapse-{{ $role->name }}" class="collapse show">
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
                                    </div>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- add new role to user modal --}}
<div class="modal fade show" id="add-role-modal" tabindex="-1" aria-modal="true" role="dialog">
    <div class="modal-dialog modal-lg" style="width: 400px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-user-shield"></i> {{ __('users.add_role') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="add-role-form" action="{{ route('user.storeRole') }}" method="POST">
                    @csrf
                    <input type="hidden" name="userid" value="{{ encryption( $users->id )}}">
                    <label class="custom-label fs-16">{{ __('users.role') }}</label>
                    <select name="role" id="role" class="form-control">
                        <option value="0">{{ __('global.select') }}</option>
                        @foreach ($availableRoles as $role)
                            <option value="{{ $role->name }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-primary btn-sm change-status-btn mt-1" onclick="addRole();">
                        <i class="fa fa-check fs-11"></i> {{ __('global.confrim') }}
                    </button>
                    <button type="button" class="btn btn-danger btn-sm cancel-btn mt-1" data-bs-dismiss="modal" aria-bs-label="Close">
                        <i class="fa fa-times fs-11"></i> {{ __('global.cancel') }}
                    </button>
                </form>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

{{-- delete role confrim modal --}}
<div class="modal fade" id="delete-user-role-modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 400px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="bx bx-error-circle"></i> {{ __('global.confirmTitle') }}</h5>
                <i class="fa fa-times fs-16" data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer"></i>
            </div>
            <div class="card-body">
                <div style="padding: 10px 20px 5px 20px; font-size: 16px">
                    {{ lang('rolePermission.role.delete') }}
                </div>
                <div style="padding: 0px 10px 5px 18px;">
                    <button class="btn btn-primary btn-sm confirm-btn" onclick="deleteUserRole()">
                        <i class="bx bx-check fs-13"></i>{{ __('global.confrim') }}
                    </button>
                    <button class="btn btn-danger btn-sm cancel-btn" data-bs-dismiss="modal" aria-bs-label="Close">
                        <i class="fa fa-times fs-13"></i> {{ __('global.cancel') }}
                    </button>
                    <input type="hidden" id="user-id" value="">
                    <input type="hidden" id="role-id" value="">
                </div>
            </div>
        </div>
    </div>
</div>
{{-- delete role confrim modal --}}

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

        function openDeleteRoleModal(uId, rId)
        {
            $("#tr-"+rId).addClass('alert alert-danger');
            $("#user-id").val(uId);
            $("#role-id").val(rId);
            var modalEl = document.getElementById('delete-user-role-modal');
            var modal = new bootstrap.Modal(modalEl, {
                backdrop: 'static',
                keyboard: false
            });
            modal.show();
        }
        
        function deleteUserRole()
        {
            let userId = $("#user-id").val();
            let roleId = $("#role-id").val();

            let url = "{{ route('user.removeRole', ['uid' => ':uid', 'rid' => ':rid']) }}"
                .replace(':uid', userId)
                .replace(':rid', roleId);

            $.ajax({
                url: url,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    window.location.reload();
                },
                error: function (xhr, status, error) {
                    window.location.reload();
                }
            });
        }

        $('#delete-user-role-modal').on('hidden.bs.modal', function () {
            $("div.card-header").removeClass('alert alert-danger')
        });

        document.addEventListener('DOMContentLoaded', function () {
            const btn = document.querySelector('#role-{{ $role->name }} .collapse-btn');
            const collapseEl = document.querySelector('#collapse-{{ $role->name }}');

            collapseEl.addEventListener('show.bs.collapse', function () {
            btn.querySelector('i').classList.remove('fa-plus');
            btn.querySelector('i').classList.add('fa-minus');
            });

            collapseEl.addEventListener('hide.bs.collapse', function () {
            btn.querySelector('i').classList.remove('fa-minus');
            btn.querySelector('i').classList.add('fa-plus');
            });
        });
    </script>
@endsection