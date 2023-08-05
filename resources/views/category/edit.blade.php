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


        <form id="my-form">

            <div class="card-body">
                <div class="form-group">
                    <label for="name_en">name_en</label>
                    <input type="text" class="form-control" name="name_en"  value="{{$category->name_en}}" id="name" placeholder="Enter Name">
                </div>

                <div class="form-group">
                    <label for="name_ar">name_ar</label>
                    <input type="text" class="form-control" name="name_ar"  value="{{$category->name_ar}}" id="name" placeholder="Enter Name">
                </div>

                <div class="mb-3">
                    <label for="cover" class="form-label">image</label>
                    <input class="form-control" type="file" id="img" name="img" >
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" @checked($category->is_active == 'Active') id="is_active" name="is_active" value="{{true}}">
                    <label class="form-check-label" for="is_active">Status</label>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="updating({{$category->id}})" class="btn btn-primary">Update</button>
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
            formData.append('is_active', (document.getElementById('is_active').checked)?1:0);
            formData.append('_method', 'put');

             // for (var pair of formData.entries()) {
             //     console.log(pair[0]+ ', ' + pair[1]);
             // }


             Swal.fire({
                 title: 'Do you want to save the changes?',
                 showDenyButton: true,
                 showCancelButton: true,
                 confirmButtonText: 'Save',
                 denyButtonText: `Don't save`,
             }).then((result) => {
                 /* Read more about isConfirmed, isDenied below */
                 if (result.isConfirmed) {

                     axios.post("{{route('category.update', ['category'=> $category->id])}}", formData)
                         .then(function(response) {
                             Swal.fire('Saved!', `${response.data.message}`, `${response.data.style}`)
                             // document.getElementById('my-form').reset();
                         })
                         .catch(function(error) {
                             // console.log(error);
                             Swal.fire('not Saved!', `${error.response.data.message}`, `${error.response.data.style}`)
                         });

                 } else if (result.isDenied) {
                     Swal.fire('Changes are not saved', '', 'info')
                 }
             })

        }


    </script>
@endsection
