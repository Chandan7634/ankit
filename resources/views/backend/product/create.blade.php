@extends('backend.layouts.master')

@section('main-content')
    <div class="card">
        <h5 class="card-header">Add Product</h5>
        <div class="card-body">
            <form method="post" action="{{ route('product.store') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="row">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="inputTitle" class="col-form-label">Title <span
                                        class="text-danger">*</span></label>
                                <input id="inputTitle" type="text" name="title" placeholder="Enter title"
                                    value="{{ old('title') }}" class="form-control">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="product-categories" class="col-form-label">Category <span
                                        class="text-danger">*</span></label>
                                <select name="cat_id" id="product-categories" data-choices data-choices-groups
                                    data-placeholder="Select Categories" class="form-control">
                                    @foreach ($categories as $key => $cat_data)
                                        <option value='{{ $cat_data->id }}'>{{ $cat_data->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="child_cat_div">
                                <label for="child_cat_id" class="col-form-label">Sub Category</label>
                                <select name="child_cat_id" id="child_cat_id" class="form-control">
                                    <option value="">--Select any category--</option>
                                    {{-- @foreach ($parent_cats as $key => $parent_cat)
                                    <option value='{{$parent_cat->id}}'>{{$parent_cat->title}}</option>
                                @endforeach --}}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price" class="col-form-label">Base Price(&#8377;) <span
                                        class="text-danger">*</span></label>
                                <input id="price" type="number" name="price" placeholder="Enter price"
                                    value="{{ old('price') }}" class="form-control">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="discount" class="col-form-label">Discount(%)</label>
                                <input id="discount" type="number" name="discount" min="0" max="100"
                                    placeholder="Enter discount" value="{{ old('discount') }}" class="form-control">
                                @error('discount')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="col-form-label">Pot Sizes &amp; Prices</label>
                                <small class="text-muted d-block mb-2">Each size can have its own price — the shop
                                    updates the price when the customer picks a size. Leave a price blank to use the
                                    base price.</small>
                                <div id="size-price-rows">
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
                                </div>
                                <button type="button" id="add-size-row" class="btn btn-sm btn-secondary">+ Add
                                    Size</button>
                                @error('size.*')
                                    <span class="text-danger d-block">{{ $message }}</span>
                                @enderror
                                @error('size_price.*')
                                    <span class="text-danger d-block">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">

                            {{-- <div class="col-md-6">
                            <div class="form-group">
                                <label for="brand_id" class="col-form-label">Brand</label>
                                <select name="brand_id" class="form-control">
                                    <option value="">--Select Brand--</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="condition" class="col-form-label">Condition</label>
                                    <select name="condition" class="form-control">
                                        <option value="">--Select Condition--</option>
                                        <option value="default">Default</option>
                                        <option value="new">New</option>
                                        <option value="hot">Hot</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock" class="col-form-label">Quantity <span
                                            class="text-danger">*</span></label>
                                    <input id="quantity" type="number" name="stock" min="0"
                                        placeholder="Enter quantity" value="{{ old('stock') }}" class="form-control">
                                    @error('stock')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="photo" class="col-form-label">Photo</label>
                                    <input id="photo" type="file" multiple name="photo[]" accept="image/*"
                                        class="form-control">
                                    <small class="text-muted">Any size is fine — every photo is auto-cropped to a
                                        uniform 800&times;800 square.</small>
                                    @error('photo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="status" class="col-form-label">Status <span
                                        class="text-danger">*</span></label>
                                <select name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="is_featured" class="col-form-label">Is Featured</label><br>
                                <input type="checkbox" name='is_featured' id='is_featured' value='1' checked> Yes
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="summary" class="col-form-label">Summary <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" id="summary" name="summary">{{ old('summary') }}</textarea>
                                @error('summary')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description" class="col-form-label">Description</label>
                                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group mb-3">
                        <button type="reset" class="btn btn-warning">Reset</button>
                        <button class="btn btn-success" id="submit-button" type="submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/old/summernote/summernote.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
<script src="{{ asset('assets/old/summernote/summernote.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 100
            });
        });

        $(document).ready(function() {
            $('#description').summernote({
                placeholder: "Write detail description.....",
                tabsize: 2,
                height: 150
            });
        });
        // $('select').selectpicker();

        $('#add-size-row').click(function() {
            $('#size-price-rows').append($('.size-price-row').first().clone().find('input').val('').end());
        });
        $(document).on('click', '.remove-size-row', function() {
            if ($('.size-price-row').length > 1) {
                $(this).closest('.size-price-row').remove();
            } else {
                $(this).closest('.size-price-row').find('input').val('');
            }
        });
    </script>

    <script>
        $('#product-categories').change(function() {
            var cat_id = $(this).val();
            // alert(cat_id);
            if (cat_id != null) {
                // Ajax call
                $.ajax({
                    url: "/admin/category/" + cat_id + "/child",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: cat_id
                    },
                    type: "POST",
                    success: function(response) {
                        if (typeof(response) != 'object') {
                            response = $.parseJSON(response)
                        }
                        // console.log(response);
                        var html_option = "<option value=''>----Select sub category----</option>"
                        if (response.status) {
                            var data = response.data;
                            // alert(data);
                            if (response.data) {
                                $('#child_cat_div').removeClass('d-none');
                                $.each(data, function(id, title) {
                                    html_option += "<option value='" + id + "'>" + title +
                                        "</option>"
                                });
                            } else {}
                        } else {
                            $('#child_cat_div').addClass('d-none');
                        }
                        $('#child_cat_id').html(html_option);
                    }
                });
            } else {}
        })
    </script>
@endpush
