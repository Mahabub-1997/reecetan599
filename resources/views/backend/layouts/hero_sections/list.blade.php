@extends('backend.partials.master')

@section('content')
    <div class="container py-4">
        <h2>Hero Sections</h2>
        <a href="{{ route('hero-sections.create') }}" class="btn btn-primary mb-3">Add New</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Image</th>
                <th width="180">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($heroSections as $hero)
                <tr>
                    <td>{{ $hero->id }}</td>
                    <td>{{ $hero->title }}</td>
                    <td>{{ $hero->description }}</td>
                    <td>
                        @if($hero->image)
                            <img src="{{ asset('storage/' . $hero->image) }}" width="100">
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('hero-sections.edit', $hero->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('hero-sections.destroy', $hero->id) }}" method="POST" style="display:inline;">
                            @csrf @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $heroSections->links() }}
    </div>
@endsection

