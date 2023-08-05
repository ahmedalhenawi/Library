
@extends('dashboard')

@section('title' , 'SubCategory')

@section('style')

    {{--    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">--}}
    {{--    <link href="https://cdn.datatables.net/1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">--}}
    {{--    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>--}}
    {{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>--}}
    {{--    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>--}}
    {{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>--}}
    {{--    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>--}}
    {{--    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>--}}
    {{--    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>--}}
    {{--    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>--}}
    {{--    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />--}}


    <link rel="stylesheet" href="{{asset('css/datatable.css')}}">

@endsection


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
        <table class="table" id="table_id">
            <thead>
            <tr>
                <th>id</th>
                <th>name_{{LaravelLocalization::setLocale()}}</th>
                <th>is_active</th>
                <th>img</th>
                <th>action</th>
            </tr>
            </thead>
            <tbody>
            {{--            @each('category.fetch_category' , $categories , 'data')--}}
            </tbody>
        </table>
        {{--        {{$categories->links()}}--}}
    </div>


@endsection

@section('scripts')


    <script src="{{asset('js/datatable.js')}}"></script>
    <script src="{{asset('js/jquery-datatable.js')}}"></script>

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


    <script>






    </script>

@endsection

@push('scripts')




    <script>

        $(function() {


            var table = $('#table_id').DataTable({
                processing: true,
                serverSide: true,
                order: [
                    [0,'desc']
                ],
                ajax: "{{ route('category.fetch_all') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },
                    {
                        data: 'name_{{LaravelLocalization::setLocale()}}',
                        name: 'name_{{LaravelLocalization::setLocale()}}'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active',
                    },
                    {

                        data: 'img',
                        name: 'img' ,
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                    // {
                    //     data: 'action',
                    //     name: 'action',
                    //     orderable: false,
                    //     // searchable: false
                    //
                    // }
                ]
            });

        });


    </script>






@endpush
