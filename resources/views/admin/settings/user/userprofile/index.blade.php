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
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body list-heading">
                        <!-- card-header -->
                        <!--cenario 1: only header, 2:header and add button, 3:header and print, other:header , add button and prin. type:both[pdf,excel], type:[pdf], type:[excel] -->
                        <x-card-header 
                            :scenario="'1'"
                            :pageTitle="$page_title"
                        />

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-9">
                                    @csrf
                                    <form style="margin: 0em 0em 3em 1em;" id="save_changes_form" action="{{ route('update_userprofile')}}" method="POST">
                                        <h3 class="mt-3">@if($userprofile) {{ Str::ucfirst($userprofile->name) }} @endif</h3>
                                        @if(auth()->user()->hasPermissionTo('UserProfile - Edit Name'))
                                        <div class="row mb-3">
                                            <input name="userprofile_id" type="hidden" class="form-control" id="userprofile_id" value="{{ $userprofile->id }}" />
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">{{ __('profile.name') }}</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="name" type="text" class="form-control" id="name" value="{{ $userprofile->name }}">
                                                <span class="name_required_error required hiddens" style="margin-left:10px;">* {{ __('global.required') }}</span>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-lg-3 col-form-label">{{ __('profile.name') }}</label>
                                            <div class="col-md-8 col-lg-9">{{ $userprofile->name }}</div>
                                        </div>
                                        @endif
                                        @if(auth()->user()->hasPermissionTo('UserProfile - Edit Email'))
                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">{{ __('profile.email') }}</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" type="text" class="form-control" id="email" value="{{ $userprofile->email}}">
                                                <span class="email_required_error required hiddens" style="margin-left:10px;">* {{ __('global.required') }}</span>
                                            </div>
                                        </div>
                                        @else
                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">{{ __('profile.email') }}</label>
                                            <div class="col-md-8 col-lg-9">{{ $userprofile->email }}</div>
                                        </div>
                                        @endif

                                        @if(auth()->user()->hasPermissionTo('UserProfile - Edit Password'))
                                        <div class="row mb-3">
                                            <label for="current" class="col-md-4 col-lg-3 col-form-label">{{ __('profile.current_password') }}</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="current" type="password" class="form-control" id="current">
                                                <span class="current_required_error required hiddens" style="margin-left:10px;">* {{ __('global.required') }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="new" class="col-md-4 col-lg-3 col-form-label">{{ __('profile.new_password') }}</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="new" type="password" class="form-control" id="new">
                                                <span class="new_required_error required hiddens" style="margin-left:10px;">* {{ __('global.required') }}</span>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="confirm" class="col-md-4 col-lg-3 col-form-label">{{ __('profile.confirm_password') }}</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="confirm" type="password" class="form-control" id="confirm">
                                                <span class="confirm_required_error required hiddens" style="margin-left:10px;">* {{ __('global.required') }}</span>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="pull-{{ app()->getLocale() == 'en' ? 'right' : 'left' }} mt-3">
                                            <button type="button" class="btn btn-primary" id="save_changes">{{ __('global.save') }}</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-3 mt-5 text-center">
                                    <img src="{{ $userprofile && $userprofile->employee->image ? asset('storage/attachment/employee/image/' . $userprofile->employee->image) : asset('assets/images/default-img.png') }}" style="width: 100px; height:90px; margin: 0 auto;" alt="{{ $userprofile->employee->image }}" class="rounded-circle mt-3">
                                    <div class="mt-3">
                                        <h4>{{ $userprofile->name}}</h4>
                                        <h4 class="text-secondary mb-1"> {{ ucwords(str_replace('_', ' ', $userprofile->type)) }}</h4>
                                        <h5><i class="bx bx-envelope" style="vertical-align: middle;margin-{{ app()->getLocale() == 'en' ? 'right' : 'left' }}:0.5rem;"></i>{{ $userprofile->email}}</h5>
                                    </div>
                                </div>
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
@endsection

@section('footer')
    @include('layouts.footer')
@endsection

@section('setting')
    @include('layouts.setting')
@endsection

@section('js')
 <script type="text/javascript">

    $(document).ready(function (){

        $(document).on("click", "#save_changes", function(e){
            e.preventDefault();

            var access_token = $("#access_token").val();
            let id = $('#userprofile_id').val();
            let name = $('#name').val();
            let email = $('#email').val();
            let current = $('#current').val();
            let newPass = $('#new').val();
            let confirm = $('#confirm').val();
            var isValid = true;

            if(name == ''){
              isValid = false;
              $('.name_required_error').removeClass('hiddens');
            } else {
              $('.name_required_error').addClass('hiddens');
            }

            if(email == ''){
              isValid = false;
              $('.email_required_error').removeClass('hiddens');
            } else {
              $('.email_required_error').addClass('hiddens');
            }

            if(current == ''){
              isValid = false;
              $('.current_required_error').removeClass('hiddens');
            } else {
              $('.current_required_error').addClass('hiddens');
            }

            if(newPass == ''){
              isValid = false;
              $('.new_required_error').removeClass('hiddens');
            } else {
              $('.new_required_error').addClass('hiddens');
            }

            if(confirm == ''){
              isValid = false;
              $('.confirm_required_error').removeClass('hiddens');
            } else {
              $('.confirm_required_error').addClass('hiddens');
            }

            if(isValid){
              $.ajax({
                  url: "{{ route('update_userprofile') }}",
                  method: "POST",
                  data: {
                        access_token: access_token,
                        id:id,
                        name: name,
                        email: email,
                        current: current,
                        newPass: newPass,
                        confirm: confirm
                  },
                  headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"  // Set the CSRF token in the request headers
                  },
                  success: function(response) {
                      // Handle the success response
                      if(response.status == 'success'){
                          fetchProfileData();
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
                  error: function(xhr, status, error) {
                      // Handle the error response
                      console.error('Form submission failed');
                      console.error(error);
                  }
              });
            }
        });

        // Update Profile edit
        $(document).on("submit", "#editUserProfileForm", function(){
            e.preventDefault();
            var fileInput = document.getElementById("profile_image");
            var profile_image = fileInput.files[0];
            
            if(!profile_image){
                $('.profile_image_required_error').show();
            } else if($('#profile_name').val().length > 13){
                $('.profile_image_required_error').hide();
                $('.profile_name_max_error').show();
            } 
            // else if(fileInput.clientWidth > 300 && fileInput.clientHeight > 300){
            //     $('.profile_image_dimention_error').show();
            //     $('.profile_image_required_error').hide();
            // } 
            else {
                $('.profile_image_required_error').hide();
                // $('.profile_image_dimention_error').hide();
                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                    if(response.status == 'success'){
                        fetchProfileData();
                        $('#editProfile').modal('hide');
                        toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                        toastr.success(response.message);
                        // Handle success response
                    } else {

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

            }
        
        });

    });
    
   $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });

    function fetchProfileData(){
        var profile_id = $('#profile_id').val();
        $.ajax({
              type: "GET",
              url: "{{ route('fetchUserProfile') }}",
              data: { 
                id: profile_id
            },
            success:function(result){
                $('.profile_name').html(result.name);
                $('.edit_profile_image').attr('src', '../assets/dnekcab/images/logo/dark/'+result.logo_dark);
                $('.profile_address').text(result.address);
                $('.profile_phone').text(result.phone);
                $('.profile_email').text(result.email);
                $('.profile_facebook').attr('href', result.facebook);
            },
            error:function(result){
                var errors = result.responseJSON;
                $('#data_content').html(errors);
            }
        });
    }

</script>
@endsection