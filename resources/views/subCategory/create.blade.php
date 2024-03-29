@extends('dashboard')


@section('title' , 'Add Sub Category')





@section('content')


    <!-- form start -->

        <div class="col-12 col-md-8">

                <!-- /.card-header -->

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h3>Create new sub category</h3>
                </div>
                 <a href="{{ route('subCategory.index') }}" class="btn btn-dark px-5">show sub categories</a>
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
                        <label for="name_en">name_en</label>
                        <input type="text" class="form-control" name="name_en" value="{{ @old('name_en') }}" id="name_en" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="name_en">name_ar</label>
                        <input type="text" class="form-control" name="name_ar" value="{{ @old('name_en') }}" id="name_en" placeholder="Enter Name">
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

                     <div class="form-group" data-select2-id="29">
                         <label>Parent Category</label>
                         <select class="form-control select2 select2-hidden-accessible" name="category_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                             @forelse($categories as $category)
                                 <option value="{{$category->id}}">{{$category->name}}</option>

                             @empty
                                 <option disabled> no categories exists</option>
                             @endforelse

                         </select>

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





@endsection
@section('scripts')

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



<script>
function create(){
        const myForm = document.getElementById('my-form');
        const formData = new FormData(myForm);
        formData.append('is_active', document.getElementById('is_active').checked?1:0);




        axios.post('{{ route('subCategory.store') }}', formData)
        .then(function(response) {
            Swal.fire({
                position: 'top-end',
                icon: response.data.style,
                title: response.data.message,
                showConfirmButton: false,
                timer: 5500
            })
            if(response.data.style !== 'error'){
                document.getElementById('my-form').reset();
            }
            // document.getElementById('my-form').reset();

         })
        .catch(function(error) {
            console.log(error);
            Swal.fire({
                position: 'top-end',
                icon: response.data.style,
                title: response.data.message,
                showConfirmButton: false,
                timer: 5500
            })



        });
        }


</script>
@endsection
