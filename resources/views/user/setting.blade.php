@extends('backend.layouts.master')

@section('main-content')
    <div class="card">
        <h5 class="card-header">Edit Post</h5>
        <div class="card-body">
            <form method="post" action="{{ route('settings.update') }}" enctype="multipart/form-data">
                @csrf
                {{-- @method('PATCH') --}}
                {{-- {{dd($data)}} --}}
                <div class="form-group">
                    <label for="short_des" class="col-form-label">Short Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="quote" name="short_des">{{ $data->short_des }}</textarea>
                    @error('short_des')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description" class="col-form-label">Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="description" name="description">{{ $data->description }}</textarea>
                    @error('description')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="photo" class="col-form-label">Photo</label>
                    @if($data->photo)
                        <div class="mb-2"><img src="{{ Storage::url($data->photo) }}" style="max-height:80px;" alt="current photo"></div>
                    @endif
                    <input id="photo" type="file" name="photo" class="form-control">
                    @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="address" class="col-form-label">Address <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="address" required value="{{ $data->address }}">
                    @error('address')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email" class="col-form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" required value="{{ $data->email }}">
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone" class="col-form-label">Phone Number <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="phone" required value="{{ $data->phone }}">
                    @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="facebook" class="col-form-label">Facebook</label>
                    <input type="text" class="form-control" name="facebook" required value="{{ $data->facebook }}">
                    @error('facebook')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="instagram" class="col-form-label">Instagram</label>
                    <input type="text" class="form-control" name="instagram" required value="{{ $data->instagram }}">
                    @error('instagram')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="youtube" class="col-form-label">Youtube</label>
                    <input type="text" class="form-control" name="youtube" required value="{{ $data->youtube }}">
                    @error('youtube')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="twitter" class="col-form-label">Twitter</label>
                    <input type="text" class="form-control" name="twitter" required value="{{ $data->twitter }}">
                    @error('twitter')
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
    <link rel="stylesheet" href="{{ asset('backend/summernote/summernote.min.css') }}">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
@endpush
@push('scripts')
    <script src="{{ asset('backend/summernote/summernote.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#summary').summernote({
                placeholder: "Write short description.....",
                tabsize: 2,
                height: 150
            });
        });

        $(document).ready(function() {
            $('#quote').summernote({
                placeholder: "Write short Quote.....",
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
    </script>
@endpush
