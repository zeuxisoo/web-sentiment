{{-- */$trans = $environment->getTranslator();/* --}}

<ul class="pager pager-topics">
    @if ($paginator->getCurrentPage() <= 1)
        <li class="pull-left disabled"><span>{{ $trans->trans('pagination.previous') }}</span></li>
    @else
        <li class="pull-left">
            <a href="{{ $paginator->getUrl($paginator->getCurrentPage() - 1) }}">
                {{ $trans->trans('pagination.previous') }}
            </a>
        </li>
    @endif

    @if ($paginator->getCurrentPage() >= $paginator->getLastPage())
        <li class="pull-right disabled"><span>{{ $trans->trans('pagination.next') }}</span></li>
    @else
        <li class="pull-right">
            <a href="{{ $paginator->getUrl($paginator->getCurrentPage() + 1) }}">
                {{ $trans->trans('pagination.next') }}
            </a>
        </li>
    @endif
</ul>
