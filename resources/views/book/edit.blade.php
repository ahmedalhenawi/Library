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
                    <label for="name">name</label>
                    <input type="text" class="form-control" name="name" value="{{$book->name}}" id="name" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="author_name">author_name</label>
                    <input type="text" class="form-control" name="author_name" value="{{$book->author_name}}" id="author_name" placeholder="author_name">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{$book->description}}</textarea>
                </div>
                <div class="form-group">
                    <label>publication_at:</label>
                        <input type="text" class="form-control datepicker" value="{{$book->publication_at}}" name="publication_at" >
                </div>




                    {{--        select categpry         --}}

                <div class="form-group" data-select2-id="29">
                    <label>Category</label>
                    <select class="form-control select2 select2-hidden-accessible"  style="width: 100%;" id="my-select" onchange="updateSub()">
                        <option selected disabled>Choose Category</option>
                        @forelse($categories as $category)
                            <option @selected($book->subCategory->category->id == $category->id ) value="{{$category->id}}">{{$category->name}}</option>

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
                <button type="button" onclick="updateItem()" class="btn btn-primary">Submit</button>
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



        var selectElement = document.getElementById("mySelect");
        selectElement.selectedIndex = selectElement.selectedIndex;

        function updateItem(){

            const myForm = document.getElementById('my-form');
            const formData = new FormData(myForm);
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

                    axios.post("{{route('book.update', ['book'=> $book->id])}}", formData)
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
