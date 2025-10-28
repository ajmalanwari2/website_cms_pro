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
            @php
                $photoPath = public_path('upload/images/employee/' . $employee->image);
            @endphp
            <!-- view -->
            <div class="card data-table view-employee mb-3">
                <div class="card-header">
                    <label class="card-title"><i class="fa fa-user"></i> {{ __('employee.employee_view')}}</label>
                    <button type="button" class="btn btn-primary btn-sm edit-btn float-{{ app()->getLocale() == 'fa' ? 'left' : 'right' }}">
                        <i class="bx bx-pen"></i> {{ __('employee.employee_edit') }}
                    </button>
                    <button type="button" class="btn btn-dark btn-sm view-btn float-{{ app()->getLocale() == 'fa' ? 'left' : 'right' }}" onclick="window.history.back();">{{ __('global.back')}}</button>
                </div>
                <div class="card-body">
                    <div class="row">
    
                        <div class="col-md-3 d-flex">
                            <div class="flex-grow-1">
                                <div class="card">
                                    <div class="card-body @if($employee->status == 'active') alert-success @else alert-danger @endif">
                                        <div class="d-flex flex-column align-items-center text-center">
                                            <img src="{{ $employee->image && file_exists($photoPath) ? asset('upload/images/employee/' . $employee->image) : asset('dist/img/system-img/default-img.png') }}" alt="{{ $employee->name }}" class="rounded-circle" width="140" height="140">
                                            <div class="mt-2">
                                                <h4>{{ ucfirst($employee->name) }}, {{ ucfirst($employee->last_name) }}</h4>
                                                <p class="text-secondary mb-1">{{ ucfirst($employee->designation) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-9 d-flex">
                            <div class="flex-grow-1">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="employee_name">{{ __('employee.employee_name') }}</label>
                                                        <p class="text-secondary m-0">{{ $employee->name }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="employee_name">{{ __('employee.employee_father_name') }}</label>
                                                        <p class="text-secondary m-0">{{ $employee->father_name }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="employee_name">{{ __('employee.employee_last_name') }}</label>
                                                        <p class="text-secondary m-0">{{ $employee->last_name }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="employee_name">{{ __('employee.employee_id_number') }}</label>
                                                        <p class="text-secondary m-0">{{ $employee->id_number }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="employee_name">{{ __('employee.employee_email') }}</label>
                                                        <p class="text-secondary m-0">{{ $employee->email }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="employee_name">{{ __('employee.employee_phone') }}</label>
                                                        <p class="text-secondary m-0">{{ $employee->phone }}</p>
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label for="employee_name">{{ __('employee.employee_departments') }}</label>
                                                        <p class="text-secondary m-0">{{ $employee->department->name_en }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="employee_name">{{ __('employee.employee_manager') }}</label>
                                                        <p class="text-secondary m-0">{{ $employee->user->name }}</p>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="employee_name">{{ __('employee.employee_salary') }}</label>
                                                        <p class="text-secondary m-0">{{ $employee->salary }}</p>
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

            <!-- end view-->
            @if(auth()->user()->hasPermissionTo('Setting - Admin'))
                <!-- edit -->
                <div class="card data-table mb-3 edit-employee hiddens">
                    <div class="card-header">
                        <label class="card-title"><i class="fa fa-user"></i> {{ __('employee.employee_edit')}}</label>
                    </div>
                    <div class="card-body">
                        @csrf
                        <form id="editEmployeeForm" action="{{ route('update-employee')}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="edit_employee_id" id="edit_employee_id" value="{{ $employee->id }}" class="form-control" />
                            <div class="row">
            
                                <div class="col-md-3 d-flex">
                                    <div class="flex-grow-1">
                                        <div class="card">
                                            <div class="card-body @if($employee->status == 'active') alert-success @else alert-danger @endif">
                                                <div class="d-flex flex-column align-items-center text-center">
                                                    <label for="edit_employee_photo_pic" id="img-label" style="padding: 3px 5px; border-radius: 5px; text-align: center;">
                                                        <img id="previewImage" src="{{ $employee->image && file_exists($photoPath) ? asset('upload/images/employee/' . $employee->image) : asset('dist/img/system-img/default-img.png') }}" alt="{{ $employee->name }}" for="edit_employee_photo_pic" class="rounded-circle" width="140" height="140">
                                                    </label>
                                                    <input type="file" class="custom-file-input" name="edit_employee_photo_pic" id="edit_employee_photo_pic" onchange="showImages(event, 'edit_employee_photo_pic', 'previewImage')" style="display:none;">
                                                
                                                    <div class="mt-3">
                                                        <h4>{{ ucfirst($employee->name) }}, {{ ucfirst($employee->last_name) }}</h4>
                                                        <p class="text-secondary mb-1">{{ ucfirst($employee->designation) }}</p>
                                                    </div>
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
            
                                <div class="col-md-9 d-flex">
                                    <div class="flex-grow-1">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="employee_name">{{ __('employee.employee_name') }} <span class="required">*</span></label>
                                                                <input type="text" class="form-control" name="r_employee_name" id="edit_employee_name" value="{{ $employee->name }}" placeholder="{{ __('employee.employee_name') }}" />
                                                                <span class="text-danger hiddens">{{ __('global.required') }}</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label for="employee_father_name">{{ __('employee.employee_father_name') }} <span class="required">*</span></label>
                                                                <input type="text" class="form-control" name="r_employee_father_name" id="edit_employee_father_name" value="{{ $employee->father_name }}" placeholder="{{ __('employee.employee_father_name') }}" />
                                                                <span class="text-danger hiddens">{{ __('global.required') }}</span>
                                                            </div>
                                        
                                                            <div class="col-md-4">
                                                                <label for="employee_last_name">{{ __('employee.employee_last_name') }} <span class="required">*</span></label>
                                                                <input type="text" class="form-control" name="r_employee_last_name" id="edit_employee_last_name" value="{{ $employee->last_name }}" placeholder="{{ __('employee.employee_last_name') }}" />
                                                                <span class="text-danger hiddens">{{ __('global.required') }}</span>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                        
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="employee_id_number">{{ __('employee.employee_id_number') }} <span class="required">*</span></label>
                                                                <input type="text" class="form-control" name="r_employee_id_number" id="edit_employee_id_number" value="{{ $employee->id_number }}" placeholder="{{ __('employee.employee_id_number') }}" disabled="disabled" />
                                                                <span class="text-danger hiddens">{{ __('global.required') }}</span>
                                                            </div>
                                        
                                                            <div class="col-md-4">
                                                                <label for="employee_email_address">{{ __('employee.employee_email') }} <span class="required">*</span></label>
                                                                <input type="email" class="form-control" name="r_employee_email" id="edit_employee_email" value="{{ $employee->email }}" placeholder="{{ __('employee.employee_email') }}" />
                                                                <span class="text-danger hiddens">{{ __('global.required') }}</span>
                                                            </div>
                                        
                                                            <div class="col-md-2">
                                                                <label for="employee_phone">{{ __('employee.employee_phone') }} <span class="required">*</span></label>
                                                                <input type="text" class="form-control" name="r_employee_phone" id="edit_employee_phone" value="{{ $employee->phone }}" placeholder="{{ __('employee.employee_phone') }}" />
                                                                <span class="text-danger hiddens">{{ __('global.required') }}</span>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="employee_statuss">{{ __('employee.employee_status') }} <span class="required">*</span></label>
                                                                <select name="r_employee_statuss" id="edit_employee_statuss" class="form-control">
                                                                    <option value="">--{{ __('employee.employee_status') }}--</option>
                                                                    <option @if($employee->status == 'active') selected @endif value="active">{{ __('employee.active') }}</option>
                                                                    <option @if($employee->status == 'inactive') selected @endif value="inactive">{{ __('employee.inactive') }}</option>
                                                                </select>
                                                                <span class="text-danger hiddens">{{ __('global.required') }}</span>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                    </div>
                                                </div>
                        
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <label for="employee_departments">{{ __('employee.employee_departments') }} <span class="required">*</span></label>
                                                                <select name="r_employee_departments" id="edit_employee_departments" class="form-control">
                                                                    <option value="">--{{ __('employee.employee_departments') }}--</option>
                                                                    @if($departments)
                                                                        @foreach($departments as $dept)
                                                                            <option @if($dept->id == $employee->department_id) selected @endif value="{{ $dept->id }}">
                                                                                {{ $dept->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                <span class="text-danger hiddens">{{ __('global.required') }}</span>
                                                            </div>
                                                            
                                                            <div class="col-md-4">
                                                                <label for="employee_manager">{{ __('employee.employee_manager') }} <span class="required">*</span></label>
                                                                <select name="r_employee_manager" id="edit_employee_manager" class="form-control">
                                                                    <option value="">--{{ __('employee.employee_manager') }}--</option>
                                                                    @if($managers)
                                                                        @foreach($managers as $manager)
                                                                            <option @if($manager->id == $employee->manager) selected @endif value="{{ $manager->id }}">{{ $manager->name }} - {{ $manager->last_name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                <span class="text-danger hiddens">{{ __('global.required') }}</span>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label for="employee_designation" style=" display: block;">{{ __('employee.employee_designation') }} <span class="required">*</span></label>
                                                                <select name="r_employee_designation" id="edit_employee_designation" class="form-control" style="width:100%;">
                                                                    <option value="">--{{ __('employee.employee_designation') }}--</option>
                                                                    <option @if($employee->designation == 'Admin') selected @endif value="Admin">{{ __('employee.admin') }}</option>
                                                                    <option @if($employee->designation == 'Manager') selected @endif value="Manager">{{ __('employee.employee_manager') }}</option>
                                                                    <option @if($employee->designation == 'HR') selected @endif value="HR">{{ __('employee.hr') }}</option>
                                                                    <option @if($employee->designation == 'Finance') selected @endif value="Finance">{{ __('employee.finance') }}</option>
                                                                    <option @if($employee->designation == 'Logistic') selected @endif value="Logistic">{{ __('employee.logistic') }}</option>
                                                                    <option @if($employee->designation == 'IT') selected @endif value="IT">{{ __('employee.it') }}</option>
                                                                    <option @if($employee->designation == 'Staff') selected @endif value="Staff">{{ __('employee.staff') }}</option>
                                                                    <option @if($employee->designation == 'Other') selected @endif value="Other">{{ __('employee.other') }}</option>
                                                                </select>
                                                                <span class="text-danger hiddens">{{ __('global.required') }}</span>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label for="employee_salary">{{ __('employee.employee_salary') }} <span class="required">*</span></label>
                                                                <input type="number" class="form-control" name="r_employee_salary" id="edit_employee_salary" oninput="validateInput(event)" value="{{ $employee->salary}}" placeholder="{{ __('employee.employee_salary') }}" />
                                                                <span class="text-danger hiddens">{{ __('global.required') }}</span>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                        
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                    <button type="submit" class="btn btn-primary">{{ __('global.update')}}</button>
                                    <button type="button" class="btn btn-dark view-btn">{{ __('global.back')}}</button>
                                </div>
            
                            </div>
                        </form>
                    </div>
                </div>
                <!-- end edit -->
            @endif

        </div>
    </div>

@if (session('success'))
    <script>
		toastr.success('{{ session('success') }}');
		@php
			session()->forget('success');		
        @endphp
    </script>
@endif
@if (session('error'))
    <script>
        toastr.success('{{ session('error') }}');
    </script>
@endif

@section('js')
    <script>

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        
        $(document).ready(function(){
            
            $(document).on('click', '.edit-btn', function(e) {
                $('.view-employee').slideUp('slow');
                $('.edit-employee').removeClass('hiddens');
                $('.edit-employee').slideDown('slow');
            });

            $(document).on('click', '.view-btn', function(e) {
                $('.view-employee').slideDown('slow');
                $('.edit-employee').slideUp('slow');
            });

            $(document).on('submit', '#editEmployeeForm', function(e) {
                e.preventDefault();
                
                if(!validateForm('editEmployeeForm')){
                    return false;
                }

                var employee_encrypted_id = lastUrlSegment();

                var fileInput = document.getElementById("edit_employee_photo_pic");
                var employee_photo = null;

                if (fileInput.files.length !== 0) {
                    employee_photo = fileInput.files[0];
                }

                var employee_id = $('#edit_employee_id').val();
                var employee_name = $('#edit_employee_name').val();
                var employee_father_name = $('#edit_employee_father_name').val();
                var employee_last_name = $('#edit_employee_last_name').val();
                var employee_id_number = $('#edit_employee_id_number').val();
                var employee_email = $('#edit_employee_email').val();
                var employee_phone = $('#edit_employee_phone').val();
                var employee_designation = $('#edit_employee_designation').val();
                var employee_departments = $('#edit_employee_departments').val();
                var employee_manager = $('#edit_employee_manager').val();
                var employee_salary = $('#edit_employee_salary').val();
                var employee_statuss = $('#edit_employee_statuss').val();

                var formData = new FormData();

                formData.append('employee_id', employee_id);
                formData.append('employee_name', employee_name);
                formData.append('employee_father_name', employee_father_name);
                formData.append('employee_last_name', employee_last_name);
                formData.append('employee_id_number', employee_id_number);
                formData.append('employee_email', employee_email);
                formData.append('employee_phone', employee_phone);
                formData.append('employee_designation', employee_designation);
                formData.append('employee_departments', employee_departments);
                formData.append('employee_manager', employee_manager);
                formData.append('employee_salary', employee_salary);
                formData.append('employee_statuss', employee_statuss);
                formData.append('employee_photo', employee_photo);

                formData.append('_token', "{{ csrf_token() }}");

                $.ajax({
                    url: $(this).attr('action'),
                    type: "POST",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(response) {
                    if(response.status == 'success'){
                        $('#addEmployee').modal('hide');
                        toastr.options =
                        {
                        "closeButton" : true,
                        "progressBar" : true
                        }
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.reload();
                        }, 30000); // 30 seconds in milliseconds (1000 milliseconds = 1 second)

                        setTimeout(function() {
                            // Construct the URL using a template literal
                            var redirectUrl = '{{ route("view-employee", ["id" => "__id__"]) }}'.replace('__id__', employee_encrypted_id);
                            window.location.href = redirectUrl;
                        }, 3000); // 3 seconds in milliseconds
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
        });


    </script>
@endsection


@endsection