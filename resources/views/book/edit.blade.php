@extends('dashboard')

@section('title' , 'Edit Book')
@section('content')






    <!-- form start -->

    <div class="col-12 col-md-8">

        <!-- /.card-header -->

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h3>Create new Book</h3>
            </div>
            <a href="{{ route('book.index') }}" class="btn btn-dark px-5">Show Books</a>
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


        <form action="{{route('book.update' , ['book' => $book->id] ) }}" method="POST">
            @csrf
            @method('put')
            {{--            id	name	author_name	description	category_id	publication_at	created_at	updated_at--}}
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">name</label>
                    <input type="text" class="form-control" name="name" value="{{old('name')?old('name'): $book->name }}" id="exampleInputEmail1" placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">author_name</label>
                    <input type="text" class="form-control" name="author_name" value="{{old('author_name')?old('author_name'): $book->author_name }}" id="exampleInputEmail1" placeholder="author_name">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3">{{old('description')?old('description'): $book->description }}</textarea>
                </div>
                <div class="form-group">
                    <label>publication_at:</label>
                    <input type="text" class="form-control datepicker"  name="publication_at" value="{{old('publication_at')?old('publication_at'): $book->publication_at }}">
                </div>

                <div class="form-group" data-select2-id="29">
                    <label>Minimal</label>
                    <select class="form-control select2 select2-hidden-accessible" name="category_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">

                        @forelse($categories as $category)
                            <option @selected($category->name == $book->category_id) value="{{$category->id}}">{{$category->name}}</option>

                        @empty
                            <option disabled> no categories exists</option>
                        @endforelse

                    </select>

                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>

    </div>





@endsection



@section('scripts')

    <script>
        $('.datepicker').datepicker();
    </script>

@endsection
