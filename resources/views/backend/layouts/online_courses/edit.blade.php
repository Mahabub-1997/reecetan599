@extends('backend.partials.master')
@section('content')
    <div class="content-wrapper">
        <div class="col-md-8 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">{{ __('Edit Course Form') }}</div>
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
                    <form action="{{ route('online-courses.update', $online_course->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- Title --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Title <i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="text" required class="form-control" name="title" value="{{ old('title', $online_course->title) }}">
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" rows="4">{{ old('description', $online_course->description) }}</textarea>
                            </div>
                        </div>

                        {{-- Price --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Price</label>
                            <div class="col-md-9">
                                <input type="number" step="0.01" class="form-control" name="price" value="{{ old('price', $online_course->price) }}">
                            </div>
                        </div>

                        {{-- Level --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Level</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="level" value="{{ old('level', $online_course->level) }}">
                            </div>
                        </div>

                        {{-- Duration --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Duration</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="duration" value="{{ old('duration', $online_course->duration) }}">
                            </div>
                        </div>

                        {{-- Language --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Language</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="language" value="{{ old('language', $online_course->language) }}">
                            </div>
                        </div>

                        {{-- Existing Image Preview --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Current Image</label>
                            <div class="col-md-9">
                                @if($online_course->image)
                                    <img src="{{ asset('uploads/courses/' . $online_course->image) }}" width="100" alt="Course Image">
                                @else
                                    <p>No image uploaded.</p>
                                @endif
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Change Image</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" name="image" style="height:45px; padding:6px;">
                            </div>
                        </div>

                        {{-- User --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">User</label>
                            <div class="col-md-9">
                                <select name="user_id" class="form-control">
                                    <option value="">-- Select User --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ (old('user_id', $online_course->user_id) == $user->id) ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Rating --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Rating</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" name="rating_id" value="{{ old('rating_id', $online_course->rating_id) }}">
                            </div>
                        </div>

                        {{-- Category --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Category</label>
                            <div class="col-md-9">
                                <select name="category_id" class="form-control">
                                    <option value="">-- Select Category --</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ (old('category_id', $online_course->category_id) == $cat->id) ? 'selected' : '' }}>
                                            {{ $cat->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <input type="submit" class="btn btn-primary" value="Update Course">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
