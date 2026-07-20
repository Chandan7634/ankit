@extends('backend.layouts.master')

@section('main-content')
    <div class="card">
        <h5 class="card-header">Edit Product</h5>
        <div class="card-body">
            <form method="post" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="inputTitle" class="col-form-label">Title <span class="text-danger">*</span></label>
                            <input id="inputTitle" type="text" name="title" placeholder="Enter title"
                                value="{{ $product->title }}" class="form-control">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="is_featured" class="col-form-label">Is Featured</label><br>
                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                {{ $product->is_featured ? 'checked' : '' }}> Yes
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cat_id" class="col-form-label">Category <span class="text-danger">*</span></label>
                            <select name="cat_id" id="cat_id" class="form-control">
                                <option value="">--Select any category--</option>
                                @foreach ($categories as $cat_data)
                                    <option value="{{ $cat_data->id }}"
                                        {{ $product->cat_id == $cat_data->id ? 'selected' : '' }}>
                                        {{ $cat_data->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $product->child_cat_id ? '' : 'd-none' }}" id="child_cat_div">
                            <label for="child_cat_id" class="col-form-label">Sub Category</label>
                            <select name="child_cat_id" id="child_cat_id" class="form-control">
                                <option value="">--Select any sub category--</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="price" class="col-form-label">Base Price (&#8377;) <span class="text-danger">*</span></label>
                            <input id="price" type="number" name="price" placeholder="Enter price"
                                value="{{ $product->price }}" class="form-control">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="discount" class="col-form-label">Discount (%)</label>
                            <input id="discount" type="number" name="discount" min="0" max="100"
                                placeholder="Enter discount" value="{{ $product->discount }}" class="form-control">
                            @error('discount')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-form-label">Pot Sizes &amp; Prices</label>
                            <small class="text-muted d-block mb-2">Each size can have its own price — the shop updates
                                the price when the customer picks a size. Leave a price blank to use the base
                                price.</small>
                            <div id="size-price-rows">
                                @forelse ($product->size_prices as $sizeName => $sizeValue)
                                    <div class="row g-2 mb-2 size-price-row">
                                        <div class="col-5">
                                            <input type="text" name="size[]" class="form-control"
                                                placeholder='Size (e.g. 6" Pot)' value="{{ $sizeName }}">
                                        </div>
                                        <div class="col-5">
                                            <input type="number" name="size_price[]" step="0.01" min="0"
                                                class="form-control" placeholder="Price (&#8377;)"
                                                value="{{ $sizeValue }}">
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-outline-danger remove-size-row">&times;</button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="row g-2 mb-2 size-price-row">
                                        <div class="col-5">
                                            <input type="text" name="size[]" class="form-control"
                                                placeholder='Size (e.g. 6" Pot)'>
                                        </div>
                                        <div class="col-5">
                                            <input type="number" name="size_price[]" step="0.01" min="0"
                                                class="form-control" placeholder="Price (&#8377;)">
                                        </div>
                                        <div class="col-2">
                                            <button type="button" class="btn btn-outline-danger remove-size-row">&times;</button>
                                        </div>
                                    </div>
                                @endforelse
                            </div>
                            <button type="button" id="add-size-row" class="btn btn-sm btn-secondary">+ Add Size</button>
                            @error('size.*')
                                <span class="text-danger d-block">{{ $message }}</span>
                            @enderror
                            @error('size_price.*')
                                <span class="text-danger d-block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="condition" class="col-form-label">Condition</label>
                            <select name="condition" class="form-control">
                                <option value="">--Select Condition--</option>
                                <option value="default" {{ $product->condition == 'default' ? 'selected' : '' }}>Default</option>
                                <option value="new" {{ $product->condition == 'new' ? 'selected' : '' }}>New</option>
                                <option value="hot" {{ $product->condition == 'hot' ? 'selected' : '' }}>Hot</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="stock" class="col-form-label">Quantity <span class="text-danger">*</span></label>
                            <input id="quantity" type="number" name="stock" min="0"
                                placeholder="Enter quantity" value="{{ $product->stock }}" class="form-control">
                            @error('stock')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="status" class="col-form-label">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control">
                                <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group d-flex gap-2">
                            @foreach (explode(',', $product->photo) as $item)
                                <div class="rounded bg-light avatar-md d-flex align-items-center justify-content-center">
                                    <img src="{{ Storage::url($item) }}" alt="" class="avatar-md">
                                </div>
                            @endforeach
                        </div>
                        <div class="form-group mt-2">
                            <label for="photo" class="col-form-label">Change Photo</label>
                            <input id="photo" type="file" multiple name="photo[]" accept="image/*" class="form-control">
                            <small class="text-muted">Any size is fine — every photo is auto-cropped to a uniform
                                800&times;800 square.</small>
                            @error('photo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">Summary <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" name="summary">{{ $product->summary }}</textarea>
                    @error('summary')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" class="col-form-label">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ $product->description }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <button class="btn btn-success" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/old/summernote/summernote.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css">
@endpush
@push('scripts')
    <script src="{{ asset('assets/old/summernote/summernote.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#summary').summernote({ placeholder: "Write short description.....", tabsize: 2, height: 150 });
            $('#description').summernote({ placeholder: "Write detail description.....", tabsize: 2, height: 150 });
        });

        var child_cat_id = '{{ $product->child_cat_id }}';
        console.log(child_cat_id);

        $('#cat_id').change(function () {
            var cat_id = $(this).val();
            if (!cat_id) return;

            $.ajax({
                url: "/admin/category/" + cat_id + "/child",
                type: "POST",
                data: { _token: "{{ csrf_token() }}" },
                success: function (response) {
                    if (typeof response !== 'object') response = $.parseJSON(response);

                    var html_option = "<option value=''>--Select any one--</option>";
                    if (response.status && response.data) {
                        $('#child_cat_div').removeClass('d-none');
                        $.each(response.data, function (id, title) {
                            html_option += "<option value='" + id + "' " + (child_cat_id == id ? 'selected' : '') + ">" + title + "</option>";
                        });
                    } else {
                        $('#child_cat_div').addClass('d-none');
                    }
                    $('#child_cat_id').html(html_option);
                }
            });
        });

        if (child_cat_id) {
            $('#cat_id').change();
        }

        $('#add-size-row').click(function () {
            $('#size-price-rows').append($('.size-price-row').first().clone().find('input').val('').end());
        });
        $(document).on('click', '.remove-size-row', function () {
            if ($('.size-price-row').length > 1) {
                $(this).closest('.size-price-row').remove();
            } else {
                $(this).closest('.size-price-row').find('input').val('');
            }
        });
    </script>
@endpush
