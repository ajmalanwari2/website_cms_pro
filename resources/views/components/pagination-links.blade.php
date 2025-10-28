<nav aria-label="Pagination">
    <ul class="pagination pagination-sm">
        @if ($paginator->currentPage() > 1)
            <li class="page-item">
                <a class="page-link" data-resultid="data_content" data-formid="search-filter" href="{{ $paginator->url(1) }}" aria-label="First">
                    <span aria-hidden="true">&laquo; {{ __('global.first') }}</span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" data-resultid="data_content" data-formid="search-filter" href="{{ $paginator->previousPageUrl() }}" aria-label="Previous">
                    <span aria-hidden="true">&lsaquo; {{ __('global.previous') }}</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" aria-disabled="true">{{ __('global.first') }}</span>
            </li>
            <li class="page-item disabled">
                <span class="page-link" aria-disabled="true">{{ __('global.previous') }}</span>
            </li>
        @endif

        @php
            $start = max(1, $paginator->currentPage() - 5);
            $end = min($paginator->lastPage(), $paginator->currentPage() + 5);
        @endphp

        @if ($start > 1)
            <li class="page-item">
                <a class="page-link" data-resultid="data_content" data-formid="search-filter" href="{{ url()->current() }}?page=1">1</a>
            </li>
            @if ($start > 2)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif
        @endif

        @for ($i = $start; $i <= $end; $i++)
            @if ($i == $paginator->currentPage())
                <li class="page-item active" aria-current="page">
                    <span class="page-link">{{ $i }}</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" data-resultid="data_content" data-formid="search-filter" href="{{ url()->current() }}?page={{ $i }}">{{ $i }}</a>
                </li>
            @endif
        @endfor

        @if ($end < $paginator->lastPage())
            @if ($end < $paginator->lastPage() - 1)
                <li class="page-item disabled"><span class="page-link">...</span></li>
            @endif
            <li class="page-item">
                <a class="page-link" data-resultid="data_content" data-formid="search-filter" href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a>
            </li>
        @endif

        @if ($paginator->currentPage() < $paginator->lastPage())
            <li class="page-item">
                <a class="page-link" data-resultid="data_content" data-formid="search-filter" href="{{ $paginator->nextPageUrl() }}" aria-label="Next">
                    <span aria-hidden="true">{{ __('global.next') }} &rsaquo;</span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" data-resultid="data_content" data-formid="search-filter" href="{{ $paginator->url($paginator->lastPage()) }}" aria-label="Last">
                    <span aria-hidden="true">{{ __('global.last') }} &raquo;</span>
                </a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link" aria-disabled="true">{{ __('global.next') }}</span>
            </li>
            <li class="page-item disabled">
                <span class="page-link" aria-disabled="true">{{ __('global.last') }}</span>
            </li>
        @endif
    </ul>
</nav>

<style>
    .pagination-sm .page-link {
        padding: 0.25rem 0.5rem; /* Adjust padding */
        font-size: 0.875rem;      /* Smaller font size */
    }
</style>