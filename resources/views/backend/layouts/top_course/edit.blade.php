@extends('backend.partials.master')
@section('content')
    <div class="content-wrapper">
        <div class="col-md-7 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">{{ __('Edit Top Course') }}</div>
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
                    <form action="{{ route('top-course.update', $topCourse->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Title <i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="text" required class="form-control" name="title" value="{{ old('title', $topCourse->title) }}">
                            </div>
                        </div>

                        {{-- Subtitle --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Subtitle</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="subtitle" value="{{ old('subtitle', $topCourse->subtitle) }}">
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Image</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" name="image" style="height:45px; padding:6px;">
                                @if($topCourse->image)
                                    <img src="{{ asset('uploads/top_courses/'.$topCourse->image) }}" alt="Current Image" class="mt-2" width="100">
                                @endif
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" rows="4" placeholder="Enter product description...">{{ old('description', $topCourse->description) }}</textarea>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <input type="submit" class="btn btn-success" value="Update Course">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
