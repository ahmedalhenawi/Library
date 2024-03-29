@extends('dashboard')


@section('content')






    <!-- form start -->

    <div class="col-12 col-md-8">

        <!-- /.card-header -->

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3>update sub category</h3>
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


        <form id="my-form" method="post">

            <div class="card-body">
                <div class="form-group">
                    <label for="name">name_en</label>
                    <input type="name_en" class="form-control" name="name_en"  value="{{$subCategory->name_en}}" id="name_en" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="name">name_ar</label>
                    <input type="text" class="form-control" name="name_en"  value="{{$subCategory->name_en}}" id="name_en" placeholder="Enter Name">
                </div>composer require mcamara/laravel-localization
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

                <select class="form-control select2 select2-hidden-accessible" name="category_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                    @forelse($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>

                    @empty
                        <option disabled> no categories exists</option>
                    @endforelse

                </select>

                <div class="form-check mt-2">
                    <input type="checkbox" class="form-check-input" @checked($subCategory->is_active == 'Active') id="is_active" name="is_active" value="{{true}}">
                    <label class="form-check-label" for="is_active">Status</label>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="updating({{$subCategory->id}})" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </div>

    </div>



@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>



    <script>


        function updating(id){

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

                    axios.post("{{route('subCategory.update', ['subCategory'=> $subCategory->id])}}", formData)
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
