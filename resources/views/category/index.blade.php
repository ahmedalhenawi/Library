@extends('dashboard')

@section('title' , 'SubCategory')

@section('content')
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

@section('scripts')


<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>


        function deleting(id){



            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                        axios.delete(`/category/${id}`)
                            .then(function(response) {
                                Swal.fire(
                                    'Deleted!',
                                    `${response.data.message}`,
                                    'success'
                                )
                                document.getElementById(id).remove();

                            })
                            .catch(function(error) {
                                Swal.fire(
                                    'ERROR',
                                    // `${error.response.data.message}`,
                                    'هذا الصنف مرتبط بمجموعة كتب' ,
                                    'error'
                                )

                                });
                }
                           });
        }


    </script>


@endsection
