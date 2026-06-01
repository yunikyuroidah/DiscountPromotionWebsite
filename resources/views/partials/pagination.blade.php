@if ($paginator->hasPages())
    <nav class="pager" role="navigation">
        @if ($paginator->onFirstPage())
            <span class="pager-link disabled">Sebelumnya</span>
        @else
            <a class="pager-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Sebelumnya</a>
        @endif

        <span class="pager-info">Halaman {{ $paginator->currentPage() }} dari {{ $paginator->lastPage() }}</span>

        @if ($paginator->hasMorePages())
            <a class="pager-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Berikutnya</a>
        @else
            <span class="pager-link disabled">Berikutnya</span>
        @endif
    </nav>
@endif
