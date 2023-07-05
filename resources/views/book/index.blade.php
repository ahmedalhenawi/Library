@extends('dashboard')

@section('title' , 'books')

@section('content')
    <div class="col-12 col-md-10">

        <div class="d-flex justify-content-between align-items-center mb-4"  style="width: 100%">
            <div>
                <h3>show categories</h3>
            </div>
            <a href="{{ route('book.create') }}" class="btn btn-dark px-5">Add new category</a>
        </div>


        @if (session()->has('msg'))
            <div class="alert alert-{{session('style')}}" role="alert">
                {{session('msg')}}
                {{--            @dd(session('msg'))--}}
            </div>
        @endif
        <table class="table">
            <thead>
            <tr>

                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Author Name</th>
                <th scope="col">Category Name</th>
                <th scope="col">Description</th>
                <th scope="col">Publication At</th>
                <th scope="col">actions</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
{{--        {{$books->links()}}--}}
    </div>


@endsection
