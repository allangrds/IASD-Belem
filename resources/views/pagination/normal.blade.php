<nav class="pagination is-centered" role="navigation" aria-label="pagination">
    <a
        class="pagination-previous"
        @if(empty($paginator->previousPageUrl())) disabled @endif
        href={{ $paginator->previousPageUrl() }}
    >
        Anterior
    </a>
    <a
        class="pagination-next"
        @if(empty($paginator->nextPageUrl())) disabled @endif
        href={{ $paginator->nextPageUrl() }}
    >
        Próxima
    </a>
    <ul class="pagination-list">
        <li>
            <a
                class="pagination-link"
                aria-label="Ir para página 1"
                href={{$paginator->url(1)}}
            >
                Primeira
            </a>
        </li>
        <li>
            <a class="pagination-link is-current" aria-label="Page {{ $paginator->currentPage() }}" aria-current="page">
                {{ $paginator->currentPage() }}
            </a>
        </li>
        <li>
            <a
                class="pagination-link"
                aria-label="Ir para página 1"
                href={{$paginator->url($paginator->lastPage())}}
            >
                Última
            </a>
        </li>
    </ul>
</nav>
