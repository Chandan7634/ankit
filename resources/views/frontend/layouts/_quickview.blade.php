{{-- Quick-view modal for a product. Include with ['product' => $product]. --}}
@php
    $qv_photos = array_filter(explode(',', (string) $product->photo));
    $qv_sizes = $product->size_prices;
    $qv_first_size = array_key_first($qv_sizes);
    $qv_base = $qv_first_size !== null ? $qv_sizes[$qv_first_size] : (float) $product->price;
    $qv_discounted = $qv_base - ($qv_base * $product->discount) / 100;
@endphp
<div class="modal fade custom-modal" id="quickViewModal{{ $product->id }}" tabindex="-1"
    aria-labelledby="quickViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-gallery">
                            <span class="zoom-icon"><i class="fi-rs-search"></i></span>
                            <div class="product-image-slider">
                                @foreach ($qv_photos as $data)
                                    <figure class="border-radius-10">
                                        <img src="{{ Storage::url($data) }}" alt="{{ $product->title }}">
                                    </figure>
                                @endforeach
                            </div>
                            <div class="slider-nav-thumbnails pl-15 pr-15">
                                @foreach ($qv_photos as $data)
                                    <div><img src="{{ Storage::url($data) }}" alt="{{ $product->title }}"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="detail-info">
                            <h3 class="title-detail mt-30">{{ $product->title }}</h3>
                            <div class="product-detail-rating">
                                <div class="product-rate-cover text-end">
                                    @php
                                        $qv_avg = (float) $product->getReview->avg('rate');
                                    @endphp
                                    <div class="product-rate d-inline-block">
                                        <div class="product-rating" style="width:{{ $qv_avg * 20 }}%"></div>
                                    </div>
                                    <span class="font-small ml-5 text-muted">
                                        ({{ $product->getReview->count() }} reviews)</span>
                                </div>
                            </div>
                            <div class="clearfix product-price-cover">
                                <div class="product-price primary-color float-left">
                                    <ins><span
                                            class="text-brand js-current-price">&#8377;{{ number_format($qv_discounted, 2) }}</span></ins>
                                    <ins><span
                                            class="old-price font-md ml-15 js-old-price">&#8377;{{ number_format($qv_base, 2) }}</span></ins>
                                    <span class="save-price font-md color3 ml-15">{{ $product->discount }}% Off</span>
                                </div>
                            </div>
                            <div class="bt-1 border-color-1 mt-15 mb-15"></div>
                            <div class="short-desc mb-30">
                                <p class="font-sm">{!! html_entity_decode($product->summary) !!}</p>
                            </div>
                            @if ($qv_sizes)
                                <div class="attr-detail attr-size">
                                    <strong class="mr-10">Pot Size</strong>
                                    <ul class="list-filter size-filter font-small">
                                        @foreach ($qv_sizes as $sizeName => $sizeBase)
                                            <li class="size-price-option @if ($loop->first) active @endif">
                                                <a href="javascript:void(0)" data-size="{{ $sizeName }}"
                                                    data-price="{{ number_format($sizeBase - ($sizeBase * $product->discount) / 100, 2, '.', '') }}"
                                                    data-old="{{ number_format($sizeBase, 2, '.', '') }}">{{ $sizeName }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form action="{{ route('single-add-to-cart') }}" method="POST">
                                @csrf
                                <div class="bt-1 border-color-1 mt-30 mb-30"></div>
                                <div class="detail-extralink">
                                    <div class="detail-qty border radius">
                                        <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                        <span class="qty-val">1</span>
                                        <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                    </div>
                                    <input type="hidden" name="slug" value="{{ $product->slug }}">
                                    <input type="hidden" name="size" class="js-selected-size"
                                        value="{{ $qv_first_size }}">
                                    <input type="hidden" name="quant[1]" class="input-number" data-min="1"
                                        data-max="1000" value="1">
                                    <div class="product-extra-link2">
                                        <button type="submit" class="button button-add-to-cart">Add to cart</button>
                                        <a aria-label="Add To Wishlist" class="action-btn hover-up"
                                            href="{{ route('add-to-wishlist', $product->slug) }}"><i
                                                class="fi-rs-heart"></i></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
