@extends('dashboard')

@section('header' , 'Category')

@section('contnet')
    <div class="col-12 col-md-10">

    <div class="d-flex justify-content-between align-items-center mb-4"  style="width: 100%">
        <div>
            <h3>show categories</h3>
        </div>
        <a href="{{ route('category.create') }}" class="btn btn-dark px-5">Add new category</a>
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
            <th scope="col">name</th>
            <th scope="col">image</th>
            <th scope="col">status</th>
            <th scope="col">actions</th>
        </tr>
        </thead>
        <tbody>
            @each('category.fetch_category' , $categories , 'data')
        </tbody>
    </table>
        {{$categories->links()}}
    </div>


@endsection
