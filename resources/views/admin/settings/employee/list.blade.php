<table class="table custom-table">
    <thead class="table-dark">
        <tr>
            <th style="width: 5%" class="text-center">#</th>
            <th style="width: 10%">{{ __('employees.employee_id_number') }}</th>
            <th style="width: 20%">{{ __('employees.employee_full_name') }}</th>
            <th style="width: 15%">{{ __('employees.employee_father_name') }}</th>
            <th>{{ __('employees.employee_email') }}</th>
            <th style="width: 10%">{{ __('employees.employee_phone') }}</th>
            <th style="width: 8%">{{ __('employees.employee_status') }}</th>
            <th style="width: 5%;" class="actions"><i class="bx bx-cog"></i></th>
        </tr>
    </thead>
    <tbody>
        @php $counter = ($employees->currentPage() - 1) * $employees->perPage() + 1; @endphp
        @foreach($employees as $employee)
            <tr id="tr-{{ $counter}}">
                <th class="text-center">{{ $counter }}</th>
                <td>{{ $employee->id_number }}</td>
                <td>{{ $employee->name }} {{ $employee->last_name }}</td>
                <td>{{ $employee->father_name }}</td>
                <td>{{ $employee->email }}</td>
                <td>{{ $employee->phone }}</td>
                <td>
                    @php
                    $class = $employee->status == '1' ? 'custom-success' : 'custom-danger';
                    $status = $employee->status == '1' ? 'active' : 'inactive';
                    $icon = $employee->status == '1' ? 'fadeIn animated bx bx-check-circle' : 'bx bx-x-circle';
                    @endphp
                    <button class="btn btn-success {{ $class }}" style="padding: 4px" id="status-btn" onclick="confirmModal('{{ encryption($employee->id) }}', '{{ $status }}', '{{ $counter++ }}')">
                        {{ $status }} <i class="{{ $icon }}"></i>
                    </button>
                </td>
                <td style="padding: 5px; text-align:center;">
                    <a href="{{ route('view-employee', ['id' => encryption($employee->id)]) }}" class="btn btn-outline-primary show-edit-btn" style="padding: 2px 5px 3px 10px">
                        <i class="bx bx-folder-open"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>