@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="col-md-7 py-5 mx-auto">
            <div class="card card-primary card-outline">
                <div class="card-header text-center">{{ __('Add Contact Us') }}</div>
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
                    <form action="{{ route('contactus.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        {{-- Name --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Name <i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="text" required class="form-control" name="name" value="{{ old('name') }}" placeholder="Enter name">
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Email <i class="text-danger">*</i></label>
                            <div class="col-md-9">
                                <input type="email" required class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter email">
                            </div>
                        </div>

                        {{-- Contact Number --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Contact Number</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="contact_number" value="{{ old('contact_number') }}" placeholder="Enter contact number">
                            </div>
                        </div>

                        {{-- Address --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Address</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="address" rows="2" placeholder="Enter address">{{ old('address') }}</textarea>
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Description</label>
                            <div class="col-md-9">
                                <textarea class="form-control" name="description" rows="4" placeholder="Enter description...">{{ old('description') }}</textarea>
                            </div>
                        </div>

                        {{-- Image --}}
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label">Image</label>
                            <div class="col-md-9">
                                <input type="file" class="form-control" name="image" accept="image/*" style="height:45px; padding:6px;">
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="form-group row">
                            <div class="col-md-9 offset-md-3">
                                <input type="submit" class="btn btn-primary" value="Add Contact">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

