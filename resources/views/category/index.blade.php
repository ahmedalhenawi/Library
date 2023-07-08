@extends('dashboard')

@section('header' , 'Category')

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


        function deleteItem(url , id ){



            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {

                        axios.delete(`/category/${id}`)
                        // axios.delete(`${url+id}` )
                            .then(function(response) {
                                swal(response.data.message);
                            })
                            .catch(function(error) {
                                console.log(error);
                                swal(error.response.data.message);
                            });

                    } else {
                        swal("Your imaginary file is safe!");
                    }
                });





            // axios.post(url+id )
            //     .then(function(response) {
            //         swal(response.data.message);
            //     })
            //     .catch(function(error) {
            //         console.log(error);
            //         swal(error.response.data.message);
            //     });
        }
    </script>


@endsection
