@extends('dashboard')


@section('content')






    <!-- form start -->

    <div class="col-12 col-md-8">

        <!-- /.card-header -->

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3>update category</h3>
            </div>
            <a href="{{ route('category.index') }}" class="btn btn-dark px-5">show categories</a>
        </div>

        <ul>
            @if ($errors->any())
                <div class="alert alert-warning" role="alert">

                    @foreach ($errors->all() as $error )
                        <li>{{$error}}</li>
                    @endforeach
                </div>
            @endif

        </ul>
        {{--                <a href="{{route('category.index')}}" class=" btn btn-primary" >show all Categories</a>--}}


        <form id="my-form" method="post">

            <div class="card-body">
                <div class="form-group">
                    <label for="name">name</label>
                    <input type="text" class="form-control" name="name"  value="{{$category->name}}" id="name" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="img" name="img">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" @checked($category->is_active == 'active') id="is_active" name="is_active" value="{{true}}">
                    <label class="form-check-label" for="is_active">Status</label>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="updating({{$category->id}})" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </div>

    </div>



@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



    <script>
         function updating(category_id){

            const myForm = document.getElementById('my-form');
            const formData = new FormData(myForm);
            console.log(category_id);
            formData.append('name' , document.getElementById('name').value)
            formData.append('_method' , 'PUT');
            formData.append('is_active', document.getElementById('is_active').checked);
            if(document.getElementById('img').files[0] !== undefined){
                    formData.append('img' , document.getElementById('img').files[0])
            }
            axios.post(`/category/${category_id}`, formData)
                .then(function(response) {
                    swal(response.data.message);
                    // document.getElementById('my-form').reset();
                })
                .catch(function(error) {
                    // console.log(error);
                    swal('error');
                });
        }


    </script>
@endsection
