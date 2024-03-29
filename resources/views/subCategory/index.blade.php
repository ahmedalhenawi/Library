@extends('dashboard')

@section('title' , 'sub Category')

@section('style')
    <link rel="stylesheet" href="{{asset('css/datatable.css')}}">
@endsection

@section('content')
    <div class="col-12 col-md-10">

    <div class="d-flex justify-content-between align-items-center mb-4"  style="width: 100%">
        <div>
            <h3>{{__('index.show sub categories')}}</h3>
        </div>
        <a href="{{ route('subCategory.create') }}" class="btn btn-dark px-5">{{__('index.Add new sub category')}}</a>
    </div>


    @if (session()->has('msg'))
        <div class="alert alert-{{session('style')}}" role="alert">
            {{session('msg')}}
        </div>
    @endif
    <table class="table" id="table_id">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">{{__('index.name')}}</th>
            <th scope="col">{{__('index.is_active')}}</th>
            <th scope="col">{{__('index.img')}}</th>
            <th scope="col">{{__('index.parent_name')}}</th>
            <th scope="col">{{__('index.actions')}}</th>
        </tr>
        </thead>
        <tbody>

{{--        @forelse($subCategories as $subCategory)--}}
{{--            <tr id="{{$subCategory->id}}">--}}
{{--                <td>{{$subCategory->id}}</td>--}}
{{--                <td>{{$subCategory->name}}</td>--}}
{{--                <td><img src="{{Storage::url('subCategory/'.$subCategory->img)}}" alt="category image" height="40px" width="40px"></td>--}}
{{--                <td><span class="{{$subCategory->is_active == 'Active'?'badge badge-success': 'badge badge-danger'}}">{{$subCategory->is_active}}</span></td>--}}
{{--                            <td>{{$subCategory->category->name}}</td>--}}
{{--                <td>--}}
{{--                    <button onclick="deleting( {{$subCategory->id}})" class="btn btn-outline-danger btn-sm">Delete</button>--}}

{{--                    <a href="{{route('subCategory.edit' ,  ['subCategory'=>$subCategory->id])}}" class="btn btn-outline-primary btn-sm">Edit</a>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @empty--}}
{{--            <td rowspan="5"><center>no data found</center> </td>--}}
{{--        @endforelse--}}

        </tbody>
    </table>
{{--        {{$subCategories->links()}}--}}
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
                    axios.delete(`/subCategory/${id}`)
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
                                'هذا الصنف الفرعي مرتبط بمجموعة كتب' ,
                                'error'
                            )

                        });
                }
            });
        }
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
                ajax: "{{ route('subCategory.fetch_all') }}",
                columns: [{
                    data: 'id',
                    name: 'id'
                },
                    {
                        data: 'name_{{LaravelLocalization::setLocale()}}' ,
                        name: '{{__('index.name')}}'
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
                        data: 'parent_name',
                        name: '{{__('index.parent_name')}}'
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
