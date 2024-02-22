<div class="container section-space--sm">
    <div class="d-flex justify-content-center">
        @if($rows instanceof \Illuminate\Pagination\AbstractPaginator)
            {{ $rows->links('web.layouts.inc.pagination') }}
        @endif
    </div>
</div>
