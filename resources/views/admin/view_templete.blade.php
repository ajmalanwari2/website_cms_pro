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
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Available breakpoints</h5>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#user-modal">
                                <i class="bx bx-plus"></i> {{ __('global.add') }}
                            </button>
                        </div>
                        <hr/>
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

@endsection