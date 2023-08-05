@extends('dashboard')

@section('title' , 'Add Book')
@section('content')






    <!-- form start -->

    <div class="col-12 col-md-8">

        <!-- /.card-header -->

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3>Create new category</h3>
            </div>
            <a href="{{ route('book.index') }}" class="btn btn-dark px-5">show Book</a>
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


        <form id="my-form" enctype="multipart/form-data">
            @csrf
{{--            id	name	author_name	description	category_id	publication_at	created_at	updated_at--}}
            <div class="card-body">
                <div class="form-group">
                    <label for="name_en">name_en</label>
                    <input type="text" class="form-control" name="name_en"  id="name_en" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="name_ar">name_ar</label>
                    <input type="text" class="form-control" name="name_ar"  id="name_ar" placeholder="Enter Name">
            </div>
                <div class="form-group">
                    <label for="author_name_en">author_name_en</label>
                    <input type="text" class="form-control" name="author_name_en"  id="author_name_en" placeholder="author_name">
                </div>
                <div class="form-group">
                    <label for="author_name_er">author_name_er</label>
                    <input type="text" class="form-control" name="author_name_ar"  id="author_name_er" placeholder="author_name">
                </div>
                <div class="form-group">
                    <label for="description_en">description_en</label>
                    <textarea class="form-control" name="description" id="description_en" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="description_ar">description_ar</label>
                    <textarea class="form-control" name="description" id="description_ar" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>publication_at:</label>
                        <input type="text" class="form-control datepicker"  name="publication_at" >
                </div>




                    {{--        select categpry         --}}

                <div class="form-group" data-select2-id="29">
                    <label>Category</label>
                    <select class="form-control select2 select2-hidden-accessible"  style="width: 100%;" id="my-select" onchange="updateSub()">
                        <option selected disabled>Choose Category</option>
                        @forelse($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>

                        @empty
                            <option disabled> no categories exists</option>
                        @endforelse



                    </select>

                </div>



                <div class="form-group" data-select2-id="29">
                    <label>Sub Category</label>
                    <select class="form-control select2 select2-hidden-accessible" name="sub_category_id" style="width: 100%;" id="select-sub">
                    <option>-----</option>
{{--                @forelse($subCategories as $category)--}}
{{--                    <option value="{{$category->id}}">{{$category->name}}</option>--}}

{{--                @empty--}}
{{--                    <option disabled> no categories exists</option>--}}
{{--                @endforelse--}}
                    </select>

                </div>



            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="button" onclick="createItem()" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </div>





@endsection



@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $('.datepicker').datepicker();
    </script>

    <script>
        function updateSub() {
            var selectElement = document.querySelector("#my-select");
            var selectedValue = selectElement.value;
            let select = document.querySelector('#select-sub');

            // remove last options if exist
            select.innerHTML = "";
            console.log(selectedValue);
            axios.get(`/category/${selectedValue}`)
                .then(function (response){
                    let res = response.data.subCategories;
                    res.forEach(function (item){
                        let name = item['name'];
                        let id = item['id'];
                        let option = document.createElement('option');
                        option.setAttribute('value', id);
                        // option.setAttribute('name', name);
                        option.innerText = name;
                        select.appendChild(option);
                        console.log(option);
                    });
                }).catch(function (error){
                })
        }




        function createItem(){
            myForm = document.querySelector('#my-form');
            console.log(myForm);
            const formData = new FormData(myForm)

            axios.post('{{ route('book.store') }}', formData)
                .then(function(response) {
                    Swal.fire({
                        icon: response.data.style,
                        title: 'Oops...',
                        text: response.data.message,
                    })
                    document.getElementById('my-form').reset();

                })
                .catch(function(error) {
                    console.log(error);
                    Swal.fire({
                        icon: error.response.data.style,
                        title: 'Oops...',
                        text: error.response.data.message,
                    })
                });

        }





    </script>

@endsection
