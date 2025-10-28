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
		<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-4">
			<div class="breadcrumb-title pe-3">{{ __('global.company_profile' )}}</div>
			<div class="ps-3">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb mb-0 p-0">
						<li class="breadcrumb-item">
							<a href="{{ route('dashboard')}}">
								<i class="bx bx-home-alt"></i>
							</a>
						</li>
						<li class="breadcrumb-item active" aria-current="page">{{ __('global.company_profile' )}}</li>
					</ol>
				</nav>
			</div>
		</div>
		<!--end breadcrumb-->

		<div class="container">
			<div class="main-body bg-white shadow-sm rounded-3 p-4">
				<div class="row g-2">
					<div class="view-profile row g-4">
						<!-- Left Profile Card -->
						<div class="col-lg-5">
							<div class="card shadow border-0 rounded-3 h-100">
								<div class="card-body text-center">
									@php
										$imagePath = @$existProfile->image ? storage_path('app/public/attachment/profile/image/' . @$existProfile->image) : null;
										$imageExists = $imagePath && file_exists($imagePath); // true only if file exists physically
										$inputName = $imageExists ? 'edit_profile_pic' : 'r_edit_profile_pic';
										$imageSrc = $imageExists ? asset('storage/attachment/profile/image/' . @$existProfile->image) : asset('assets/images/default-company.png');
									@endphp

									 <img src="{{ @$existProfile && @$existProfile->image && file_exists(storage_path('app/public/attachment/profile/image/' . @$existProfile->image)) ? asset('storage/attachment/profile/image/'. @$existProfile->image) : asset('assets/images/default-company.png') }}"
                                        alt="{{ @$existProfile->name }}" class="rounded-circle p-1 bg-primary shadow" width="110" height="120">

									<div class="mt-3">
										<h4 class="fw-bold">{{ @$existProfile->name }}</h4>
										<p class="text-muted small mb-0"><i class='bx bx-envelope'></i> {{ @$existProfile->email }}</p>
										<p class="text-muted small"><i class='bx bx-phone'></i> {{ @$existProfile->phone }}</p>
										<div class="d-flex justify-content-center gap-2 mt-3">
											<button class="btn btn-primary btn-sm px-4">
												<a href="{{ @$existProfile->facebook != null ? @$existProfile->facebook : '#' }}" class="text-white">{{ __('global.follow')}}</a>
											</button>
											<button class="btn btn-info btn-sm px-4 edit-btn">{{ __('global.edit')}}</button>
										</div>
									</div>
								</div>
							</div>
						</div>

						<!-- Right Blockquote -->
						<div class="col-lg-7 d-flex">
							<blockquote class="blockquote bg-light p-4 rounded-3 shadow-sm border-start border-4 border-primary w-100">
								<footer class="blockquote-footer mt-2">
									{{ __('global.company_statement')}}
								</footer>
								<p class="mb-2 mt-3 fst-italic text-justify"> {{ @$existProfile->address }}</p>
								<hr>
								<p class="text-muted small">Dot Number: {{ @$existProfile->dot_number }}</p>
								<p class="text-muted small">MC Number: {{ @$existProfile->mc_number }}</p>
								<p class="text-muted small">EIN: {{ @$existProfile->ein }}</p>
								<p class="text-muted small">SCAC: {{ @$existProfile->scac }}</p>
								<p class="text-muted small"><a href="{{ @$existProfile->linkedin != null ? @$existProfile->linkedin : '#' }}"><i class='lni lni-linkedin'></i> Linkedin</a></p>
							</blockquote>
						</div>
					</div>
				</div>

				<!-- Edit Profile Section -->
				<div class="row mt-4">
					<div class="col-lg-12 edit-profile hiddens">
						<div class="card shadow-sm border-0">
							<div class="card-body">
								@csrf
                        		<form id="createOreditCompanyForm" action="{{ route('company.profile.update')}}" method="POST" enctype="multipart/form-data">
                            		<input type="hidden" name="edit_company_id" id="edit_company_id" value="{{ encryption(@$existProfile->id) }}" class="form-control" />
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">{{ __('global.company_name')}}</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="text" class="form-control" name="r_name" value="{{ @$existProfile->name }}"/>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">{{ __('global.email')}}</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="text" class="form-control" name="r_email" value="{{ @$existProfile->email }}"/>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">{{ __('global.phone')}}</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="text" class="form-control" name="phone" value="{{ @$existProfile->phone }}"/>
										</div>
									</div>
									
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">{{ __('global.company.dot_number')}}</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="text" class="form-control" name="dot_number"  value="{{ @$existProfile->dot_number }}" placeholder="{{ __('global.company.dot_number') }}"/>
										</div>
									</div>

									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">{{ __('global.company.mc_number') }}</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="text" class="form-control" name="mc_number"  value="{{ @$existProfile->mc_number }}" placeholder="{{ __('global.company.mc_number') }}"/>
										</div>
									</div>

									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">{{ __('global.company.ein') }}</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="text" class="form-control" name="ein"  value="{{ @$existProfile->ein }}" placeholder="{{ __('global.company.ein') }}"/>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">{{ __('global.company.scac') }}</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="text" class="form-control" name="scac"  value="{{ @$existProfile->scac }}" placeholder="{{ __('global.company.scac') }}"/>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">{{ __('global.facebook')}}</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="text" class="form-control" name="facebook"  value="{{ @$existProfile->facebook }}"/>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">{{ __('global.linkedin')}}</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<input type="text" class="form-control" name="linkedin"  value="{{ @$existProfile->linkedin }}"/>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">{{ __('global.address')}}</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<textarea type="text" class="form-control" name="address" >{{ @$existProfile->address }}</textarea>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-sm-3">
											<h6 class="mb-0">{{ __('global.upload_image')}}</h6>
										</div>
										<div class="col-sm-9 text-secondary">
											<label for="{{ $inputName }}" id="img-label" style="padding: 3px 5px; border-radius: 5px; text-align: center;">
												<img id="previewImage" src="{{ $imageSrc }}" alt="{{ @$existProfile->name }}" class="rounded-circle" width="182" height="auto">
												@if(!$imageExists)
													<span class="required">*</span>
												@endif
											</label>
											<input type="file" class="custom-file-input" name="{{ $inputName }}" id="{{ $inputName }}" onchange="showImages(event, '{{ $inputName }}', 'previewImage')" style="display:none;">
										</div>
									</div>
									<div class="row">
										<div class="col-sm-3"></div>
										<div class="col-sm-9 text-secondary">
											<input type="submit" class="btn btn-primary px-4"  value="{{ !empty($application) ? __('global.update') : __('global.save') }}"/>
											<button type="button"
													class="btn btn-dark view-btn pull-{{ app()->getLocale() == 'en' ? 'right' : 'left' }}">
												{{ __('global.back')}}
											</button>
										</div>
									</div>
								</form>
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
<script>
	$(document).ready(function(){

		$(document).on('click', '.edit-btn', function(e) {
			$('.view-profile').slideUp('slow');
			$('.edit-profile').removeClass('hiddens');
			$('.edit-profile').slideDown('slow');
		});

		$(document).on('click', '.view-btn', function(e) {
			$('.edit-profile').slideUp('slow');
			$('.view-profile').slideDown('slow');
		});

		$(document).on('submit', '#createOreditCompanyForm', function(e) {
			e.preventDefault();
			var id = $('#edit_company_id').val();
			if(!validateForm('createOreditCompanyForm')){
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
	})
</script>
@endsection