  <hr>
<table class="table custom-table">
    <thead class="table-dark">
        <tr>
            <th style="width: 5%;" class="text-center">#</th>
            <th style="width: 6%;">{{ __('users.photo') }}</th>
            <th style="width: 25%;">{{ __('users.name') }}</th>
            <th>{{ __('users.email') }}</th>
            <th style="width: 12%;">{{ __('users.type') }}</th>
            <th style="width: 5%;" class="actions"><i class="bx bx-cog"></i></th>
        </tr>
    </thead>
    <tbody>
        
        @if ($allUsers->isNotEmpty())
            @php $counter = ($allUsers->currentPage() - 1) * $allUsers->perPage() + 1; @endphp
            @foreach ($allUsers as $users)
                <tr id="tr-{{$counter}}">
                    <th class="text-center">{{ $counter }}</th>
                    <td>
                        @php
                            $default = asset('assets/images/default-img.png');
                            $folder = $users->type === 'driver' ? 'driver' : 'employee';

                            $src = $users->photo ? asset('storage/attachment/'.$folder.'/image/'.$users->photo)
                                : $default;
                        @endphp

                        <img alt="{{ $users->photo }}" src="{{ $src }}" style="width: 40px; height: 40px; border: 1px double #CCC; border-radius: 50%;">
                    </td>
                    <td>
                        {{ $users->name }}
                    </td>

                    <td>
                        {{ $users->email }}
                    </td>

                    <td>
                        {{ ucwords(str_replace('_', ' ', $users->type)) }}
                    </td>
                
                    <td class="text-center">
                        <a href="{{ route('user.view', encryption($users->id)) }}" class="btn btn-outline-primary action-btn">
                            <i class="bx bx-folder-open fs-16"></i>
                        </a>                        
                    </td>
                </tr>
                @php $counter++; @endphp
            @endforeach

        @else

            <tr>
                <td colspan="11">
                    No user records found!
                </td>
            </tr>
        
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="11">
                <nav aria-label="pagination">
                    <ul class="pagination">
                        @if ($allUsers->onFirstPage())
                            <li class="page-item disabled">
                                <a class="page-link" data-resultid="classrooms-list" data-formid="classrooms-filter" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" data-resultid="classrooms-list" data-formid="classrooms-filter" href="{{ $allUsers->previousPageUrl() }}" tabindex="-1">Previous</a>
                            </li>
                        @endif

                        @foreach ($allUsers->getUrlRange(1, $allUsers->lastPage()) as $page => $url)
                            @if ($page == $allUsers->currentPage())
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" data-resultid="classrooms-list" data-formid="classrooms-filter" href="{{ url()->current() }}?page={{ $page }}">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" data-resultid="classrooms-list" data-formid="classrooms-filter" href="{{ url()->current() }}?page={{ $page }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        @if ($allUsers->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" data-resultid="classrooms-list" data-formid="classrooms-filter" href="{{ $allUsers->nextPageUrl() }}">Next</a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <a class="page-link" data-resultid="classrooms-list" data-formid="classrooms-filter" href="#" tabindex="-1" aria-disabled="true">Next</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            </td>
        </tr>
    </tfoot>
</table>