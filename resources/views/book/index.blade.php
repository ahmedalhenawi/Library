@extends('dashboard')

@section('title' , 'books')

@section('content')
    <div class="col-12 col-md-10">

        <div class="d-flex justify-content-between align-items-center mb-4"  style="width: 100%">
            <div>
                <h3>show Books</h3>
            </div>
            <a href="{{ route('book.create') }}" class="btn btn-dark px-5">Add new Book</a>
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
                @forelse($books as $book)
                    <tr>
                    <td>{{$book->id}}</td>
                    <td>{{$book->name}}</td>
                    <td>{{$book->author_name}}</td>


                    <td>{{$book->category->name}}</td>
{{--                    <td>{{\App\Models\Category::find($book->category_id)->name}}</td>--}}


                    <td>{{$book->description}}</td>
                    <td>{{$book->publication_at}}</td>
                    <td>
{{--                        <form method="POST" action="{{route('book.destroy' , ['book' =>$book->id ])}}"  class="d-inline">--}}
{{--                            @csrf--}}
{{--                            @method('delete')--}}
{{--                            <button type="submit" class="btn btn-outline-danger btn-sm" onclick="confirm('are you sure to delete this')" >Delete</button>--}}
{{--                        </form>--}}
                        <a href="#" class="btn btn-outline-danger btn-sm delete" data-id="{{$book->id}}">DELETE</a>
                        <a href="{{route('book.edit' ,  ['book'=>$book->id])}}" class="btn btn-outline-primary btn-sm">Edit</a>
                    </td>

                    </tr>

                @empty
                @endforelse
            </tbody>
        </table>
{{--        {{$books->links()}}--}}
    </div>


@endsection

@section('scripts')

    <script>


        $('.delete').click(function () {
            var id = $(this).attr('data-id');
            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = `/book/delete/${id}`;
                        swal("Poof! Your imaginary file has been deleted!", {
                            icon: "success",
                        });
                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });

        });



    </script>

@endsection
