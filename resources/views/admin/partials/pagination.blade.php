@if ($paginator->hasPages())
    <div class="border-t border-zinc-800 bg-zinc-950/30 px-4 py-4 sm:px-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <p class="text-[10px] font-bold uppercase tracking-widest text-slate-500 font-mono">
                Menampilkan {{ $paginator->firstItem() }}-{{ $paginator->lastItem() }} dari {{ $paginator->total() }} data
            </p>

            <nav class="flex flex-wrap items-center gap-2" aria-label="Pagination">
                @if ($paginator->onFirstPage())
                    <span class="inline-flex h-9 min-w-9 items-center justify-center border border-zinc-800 bg-black px-3 text-[10px] font-bold uppercase tracking-widest text-slate-700 font-mono cursor-not-allowed">
                        Prev
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="inline-flex h-9 min-w-9 items-center justify-center border border-zinc-800 bg-black px-3 text-[10px] font-bold uppercase tracking-widest text-slate-400 transition hover:border-industrial-orange hover:text-industrial-orange font-mono">
                        Prev
                    </a>
                @endif

                @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                    @if ($page === $paginator->currentPage())
                        <span class="inline-flex h-9 min-w-9 items-center justify-center border border-industrial-orange bg-industrial-orange px-3 text-xs font-black text-white font-mono">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="inline-flex h-9 min-w-9 items-center justify-center border border-zinc-800 bg-black px-3 text-xs font-bold text-slate-400 transition hover:border-industrial-orange hover:text-industrial-orange font-mono">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="inline-flex h-9 min-w-9 items-center justify-center border border-zinc-800 bg-black px-3 text-[10px] font-bold uppercase tracking-widest text-slate-400 transition hover:border-industrial-orange hover:text-industrial-orange font-mono">
                        Next
                    </a>
                @else
                    <span class="inline-flex h-9 min-w-9 items-center justify-center border border-zinc-800 bg-black px-3 text-[10px] font-bold uppercase tracking-widest text-slate-700 font-mono cursor-not-allowed">
                        Next
                    </span>
                @endif
            </nav>
        </div>
    </div>
@endif