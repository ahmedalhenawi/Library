@extends('dashboard')


@section('content')






    <!-- form start -->

        <div class="col-12 col-md-8">

                <!-- /.card-header -->

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3>Create new category</h3>
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


                <form id="my-form">

                 <div class="card-body">
                    <div class="form-group">
                        <label for="exampleInputEmail1">name</label>
                        <input type="text" class="form-control" name="name" value="{{ @old('name') }}" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="img">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="is_active" name="is_active"  >

                        <label class="form-check-label" for="exampleCheck1">Status</label>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="button" onclick="create()" class="btn btn-primary">Submit</button>

                </div>
            </form>

        </div>

    </div>



@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



<script>
function create(){
        const myForm = document.getElementById('my-form');
        const formData = new FormData(myForm);
        formData.append('is_active', document.getElementById('is_active').checked);




        axios.post('{{ route('category.store') }}', formData) 
        .then(function(response) {
  swal(response.data.message);
document.getElementById('my-form').reset();

         })
        .catch(function(error) {
        console.log(error);
 swal(error.response.data.message);


 
        });
        }



</script>
@endsection