
@extends('backend.partials.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Payment for Course</h1>
                        <p class="text-muted">Course: {{ $course->title }} | Price: ${{ number_format($course->price, 2) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mb-4">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="info-box mb-3 d-flex justify-content-between align-items-center bg-primary text-white">
                        <div class="info-box-content">
                            <span class="info-box-text fw-bold" style="font-size: 2rem;">Your Payment</span>
                            <span class="info-box-number" style="font-size: .7rem;">
                            Complete the payment to enroll in this course
                        </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Payment Table --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @php
                                $enrollment = $course->enrollments()->where('user_id', auth()->id())->first();
                            @endphp

                            <div class="table-responsive">
                                <table class="table table-bordered table-striped">
                                    <thead class="bg-gradient-teal text-white">
                                    <tr>
                                        <th>#</th>
                                        <th>User Name</th>
                                        <th>User Email</th>
                                        <th>Course Title</th>
                                        <th>Price</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>{{ auth()->user()->name }}</td>
                                        <td>{{ auth()->user()->email }}</td>
                                        <td>{{ $course->title }}</td>
                                        <td>${{ number_format($course->price, 2) }}</td>
                                        <td class="text-center">
                                            @if(!$enrollment || $enrollment->status == 'pending')
                                                <a href="{{ route('courses.pay', $course->id) }}" class="btn btn-success btn-sm">
                                                    Pay Now
                                                </a>
                                            @else
                                                <span class="badge bg-success">Paid</span>
                                            @endif
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            {{-- Optional: show message if already paid --}}
                            @if($enrollment && $enrollment->status == 'success')
                                <div class="alert alert-success mt-3">
                                    You have successfully paid for this course.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
