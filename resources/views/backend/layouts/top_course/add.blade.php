@extends('backend.partials.master')
@section('content')
    <div class="content-wrapper">
        <div class="col-md-7 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">{{ __('Add Product Form') }}</div>
                <div class="card-body">

                    {{-- Show Validation Errors --}}
                    @if ($errors->any())
                        <div style="color: red;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('online-courses.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        {{-- Title --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Title <i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="text" required class="form-control" name="title" value="{{ old('title') }}">
                            </div>
                        </div>

                        {{-- Subtitle --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Subtitle</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="subtitle" value="{{ old('subtitle') }}">
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Image <i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="file" required class="form-control" name="image" style="height:45px; padding:6px;">
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" rows="4" placeholder="Enter product description...">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <input type="submit" class="btn btn-primary" value="Add Course">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
