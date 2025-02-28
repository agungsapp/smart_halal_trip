@if ($paginator->hasPages())
		<nav aria-label="Page navigation">
				<ul class="pagination justify-content-center flex-wrap gap-1">
						{{-- Previous Page Link --}}
						@if ($paginator->onFirstPage())
								<li class="page-item disabled" aria-disabled="true" aria-label="Sebelumnya">
										<span class="page-link">«</span>
								</li>
						@else
								<li class="page-item">
										<button wire:click="previousPage" class="page-link" rel="prev" aria-label="Sebelumnya">«</button>
								</li>
						@endif

						{{-- Pagination Elements --}}
						@foreach ($elements as $element)
								{{-- "Three Dots" Separator --}}
								@if (is_string($element))
										<li class="page-item disabled d-none d-md-block" aria-disabled="true">
												<span class="page-link">{{ $element }}</span>
										</li>
								@endif

								{{-- Array Of Links --}}
								@if (is_array($element))
										@foreach ($element as $page => $url)
												@if ($page == $paginator->currentPage())
														<li class="page-item active" aria-current="page">
																<span class="page-link">{{ $page }}</span>
														</li>
												@else
														<li class="page-item">
																<button wire:click="gotoPage({{ $page }})" class="page-link">{{ $page }}</button>
														</li>
												@endif
										@endforeach
								@endif
						@endforeach

						{{-- Next Page Link --}}
						@if ($paginator->hasMorePages())
								<li class="page-item">
										<button wire:click="nextPage" class="page-link" rel="next" aria-label="Berikutnya">»</button>
								</li>
						@else
								<li class="page-item disabled" aria-disabled="true" aria-label="Berikutnya">
										<span class="page-link">»</span>
								</li>
						@endif
				</ul>
		</nav>
@endif
