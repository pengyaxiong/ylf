


@if ($paginator->hasPages())
    <div class="page-pagination d-middle" style="margin-top:60px;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li ><a href="#"> <img id="prev" class="page-pagination-btn d-middle-item" src="/home/images/icon-arrow-left.png" alt=""/></a>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"> <img id="prev" class="page-pagination-btn d-middle-item" src="/home/images/icon-arrow-left.png" alt=""/></a>
        @endif
        <input id="pageNum" class="page-pagination-input d-middle-item" value="{{$paginator->currentPage()}}" type="text"/>
        <span class="page-pagination-divider d-middle-item">/</span>
        <label id="totalPage" class="page-pagination-tot d-middle-item">{{$paginator->lastPage()}}</label>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">
                <img id="next" class="page-pagination-btn d-middle-item" src="/home/images/icon-arrow-right.png"
                     alt=""/>
            </a>
        @else
            <a href="#">
                <img id="next" class="page-pagination-btn d-middle-item" src="/home/images/icon-arrow-right.png"
                     alt=""/>
            </a>
        @endif
    </div>
@endif


{{--{!! $solutions->appends(Request::all())->links('home.layouts._page') !!}--}}