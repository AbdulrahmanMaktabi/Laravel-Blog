@extends('theme.master')
@section('page-title', 'My Blogs ')

@section('content')
    @include('theme.partials.hero')
    <!-- ================ contact section start ================= -->
    <div class="container">
        <h1>List Of Blogs:</h1>
        {{-- start from here --}}
        <table class="table table-striped">
            <thead>
                <tr>
                    {{-- <th scope="col" style="width: 5% ">#</th> --}}
                    <th scope="col" style="width: ">Title</th>
                    <th scope="col" style="width: 15% ">Action</th>
                </tr>
            </thead>
            <tbody>
                @if ($blogs->isNotEmpty())
                    @foreach ($blogs as $blog)
                        <tr>
                            {{-- <th scope="row">{{ $blog->id }}</th> --}}
                            <td>
                                <a href="{{ route('blogs.show', $blog) }}" target="_blank">
                                    {{ $blog->name }}
                                </a>
                            </td>
                            <td class="d-flex">
                                <a href="{{ route('blogs.edit', $blog) }}" class="btn btn-sm btn-primary mr-2">Edit</a>
                                <form action="{{ route('blogs.destroy', $blog) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger mr-2"
                                        onclick="return confirm('Are you sure you want to delete this blog?');">Delete</button>
                                </form>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <h1 style="color: red; font-size:40px">Empty</h1>
                @endif

            </tbody>
        </table>
    </div>
    <!-- ================ contact section end ================= -->
@endsection
