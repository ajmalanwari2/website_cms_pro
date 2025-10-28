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
            <div class="container-fluid">
                <div class="card card-flush h-xl-100">
                    <div class="card-body list-heading">
                        <x-card-header page-title="{{ __('global.view_all_notification')}}" scenario="1" /> 
                    </div>
                    
                    <!--begin::Header-->
                    <div class="card-header pt-4" style="background: #fff !important;">
                        <!--begin::Toolbar-->
                        <div class="card-toolbar">
                            <ul class="nav" role="tablist" style="padding-{{ app()->getLocale() == 'en' ? 'left' : 'right' }}:0;">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1 active" data-bs-toggle="tab" href="#kt_unread_notification_tab" aria-selected="true" role="tab"><span class="badge badge-square badge-light text-light bg-danger">{{ $notifications->count() }}</span><span> | جدید</span></a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link btn btn-sm btn-color-muted btn-active btn-active-light fw-bold px-4 me-1" data-bs-toggle="tab" href="#kt_read_notification_tab" aria-selected="false" role="tab" tabindex="-1"><span class="badge badge-square badge-light text-light bg-success">{{ $readNotifications->count() }}</span><span> | خوانده شده</a>
                                </li>
                            </ul>
                        </div>
                        <!--end::Toolbar-->
                    </div>
                    <hr>
                    <!--end::Header-->

                    <!--begin::Body-->
                    <div class="card-body pt-6">
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade active show" id="kt_unread_notification_tab" role="tabpanel">
                                <!--begin::Statistics-->
                                <div class="mb-5">
                                    <!--begin::Unread Notification-->
                                    <div class="flex-column flex-lg-row-auto mb-10 mb-lg-0">
                                        <!--begin::Contacts-->
                                        <div class="card card-flush" id="unreadNotificationArea">
                                            @if($notifications->isNotEmpty())
                                                <!--begin::Card body-->
                                                <div class="card-body pt-2" id="kt_notification_contacts_body" dir="rtl">
                                                    <!--begin::List-->
                                                    @foreach($notifications as $notification)
                                                        <!--begin::User-->
                                                        <div class="col-lg mb-3" style="background:#f2f2f2;">
                                                            <a href="{{ route('viewSingleNotification', ['id' => $notification->id])}}" class="text-reset notification-item unreadNotification notification-{{ $notification->id }}" target="_blank">
                                                                <div class="d-flex">
                                                                    <div class="pull-right text-center" id="notification_{{ $notification->id }}">
                                                                        <img src="{{ $user && $user->photo && file_exists($photoPath) ? asset('storage/attachment/employee/photo/' . $user->photo) : asset('assets/img/default-img.png') }}"
                                                                        alt="{{ $user->name }}" style="width:40px;margin:0 auto;" class="bg-primary rounded-circle font-size-16 mb-1">
                                                                        <h6 class="mb-0">{{ isset($notification->data['created_by']) && class_exists('App\Models\User') ? App\Models\User::find($notification->data['created_by'])->name : '' }}</h6>
                                                                        <span class="text-gray-900 text-hover-primary fs-7 mb-1d" style="direction: ltr;cursor: pointer;" data-id="{{ $notification->id }}"><i class="mdi mdi-eye-outline"></i> </span>
                                                                    </div>
                                                                    <div class="flex-grow-1 p-2 pull-left text-left">
                                                                        <h6 class="mb-1" key="t-your-order">{{ $notification->data['title'] }}</h6>
                                                                        <div class="font-size-12">
                                                                            <p class="mb-1" key="t-grammer">{{ $notification->data['message'] }}</p>
                                                                            <p class="mb-0">
                                                                                <i class="mdi mdi-clock-outline"></i> 
                                                                                <span key="t-min-ago">{{formatVertaDate($notification->created_at->timestamp)}}</span>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <!--end::User-->
                                                        <!--begin::Separator-->
                                                        <div class="separator separator-dashed"></div>
                                                        <!--end::Separator-->
                                                    @endforeach
                                                
                                                    <!--end::List-->
                                                </div>
                                                <!--end::Card body-->
                                            @else
                                                <div class="notice d-flex bg-light-danger rounded border-danger border border-dashed min-w-lg-600px flex-shrink-0 p-6">

                                                    <div class="flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                                        <!--begin::Content-->
                                                        <div class="mb-3 mb-md-0 fw-semibold">
                                                            <div class="fs-6 text-danger-700 pe-7">
                                                                <x-record-not-found />
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </div>
                                            @endif
                        
                                        </div>
                                        <!--end::Contacts-->
                                    </div>
                                    <!--end::Unread Notification-->
                                </div>
                                <!--end::Statistics-->
                            </div>
                            <!--end::Tab pane-->
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade" id="kt_read_notification_tab" role="tabpanel">
                                <!--begin::Statistics-->
                                <div class="mb-5">
                                    <!--begin::Read Notification-->
                                    <div class="flex-column flex-lg-row-auto mb-10 mb-lg-0">
                                        <!--begin::Contacts-->
                                        <div class="card card-flush">
                                            @if($readNotifications->isNotEmpty())
                                                <!--begin::Card body-->
                                                <div class="card-body pt-2" id="kt_notification_read" dir="rtl">
                                                    @foreach($readNotifications as $readNotification)
                                                        @php
                                                            $user = null;
                                                            if (!empty($readNotification->data['created_by'])) {
                                                                $user = \App\Models\User::find($readNotification->data['created_by']);
                                                            }
                                                        @endphp

                                                        <div class="col-lg mb-3" style="background:#f2f2f2;">
                                                            <a href="{{ route('viewSingleNotification', ['id' => $readNotification->id])}}" 
                                                            class="text-reset notification-item unreadNotification notification-{{ $readNotification->id }}" 
                                                            target="_blank">
                                                                <div class="d-flex">
                                                                    <div class="pull-right text-center" id="notification_{{ $readNotification->id }}">
                                                                        <img src="{{ $user && $user->photo && file_exists(storage_path('app/public/attachment/employee/photo/' . $user->photo)) 
                                                                                    ? asset('storage/attachment/employee/photo/' . $user->photo) 
                                                                                    : asset('assets/img/default-img.png') }}"
                                                                            alt="{{ $user?->name ?? 'Unknown User' }}" 
                                                                            style="width:40px;margin:0 auto;" 
                                                                            class="bg-primary rounded-circle font-size-16 mb-1">

                                                                        <h6 class="mb-0">{{ $user?->name ?? '' }}</h6>

                                                                        <span class="text-gray-900 text-hover-primary fs-7 mb-1d" 
                                                                            style="direction: ltr;cursor: pointer;" 
                                                                            data-id="{{ $readNotification->id }}">
                                                                            <i class="mdi mdi-eye-outline"></i>
                                                                        </span>
                                                                    </div>
                                                                    <div class="flex-grow-1 p-2 pull-left text-left">
                                                                        <h6 class="mb-1" key="t-your-order">{{ $readNotification->data['title'] ?? '' }}</h6>
                                                                        <div class="font-size-12">
                                                                            <p class="mb-1" key="t-grammer">{{ $readNotification->data['message'] ?? '' }}</p>
                                                                            <p class="mb-0">
                                                                                <i class="mdi mdi-clock-outline"></i> 
                                                                                <span key="t-min-ago">{{ formatVertaDate($readNotification->created_at->timestamp) }}</span>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <div class="separator separator-dashed"></div>
                                                    @endforeach

                                                    <!--end::List-->
                                                </div>
                                                <!--end::Card body-->
                            
                                                {{-- <div class="card-footer text-center" style="width:100% !important;background-color:white;">
                                                    Pagination Here!
                                                </div> --}}

                                            @else
                                                <div class="notice bg-light-danger rounded border-danger border border-dashed min-w-lg-600px flex-shrink-0 p-6">

                                                    <div class="flex-stack flex-grow-1 flex-wrap flex-md-nowrap">
                                                        <!--begin::Content-->
                                                        <div class="mb-3 mb-md-0 fw-semibold">
                                                            <div class="fs-6 text-danger-700 pe-7">
                                                                <x-record-not-found />
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <!--end::Wrapper-->
                                                </div>
                                            @endif
                        
                                        </div>
                                        <!--end::Contacts-->
                                    </div>
                                    <!--end::Read Notification-->
                                </div>
                                <!--end::Statistics-->
                        
                            </div>
                            <!--end::Tab pane-->
                        </div>
                        <!--end::Tab content-->
                    </div>
                    <!--end::Body-->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function(){});
    </script>
@endsection