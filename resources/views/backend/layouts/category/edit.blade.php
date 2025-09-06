@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="col-md-7 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">{{ __('Edit Category Form') }}</div>
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
                    <form action="{{ route('categories.update', $category->id) }}" method="post">
                        @csrf
                        @method('PUT')

                        {{-- Name --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name <i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="text" required class="form-control" name="name"
                                       value="{{ old('name', $category->name) }}"
                                       placeholder="Enter category name">
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" rows="4" placeholder="Enter category description...">{{ old('description', $category->description) }}</textarea>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <input type="submit" class="btn btn-primary" value="Update Category">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
