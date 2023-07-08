<tr>
    <td>{{$data->id}}</td>
    <td>{{$data->name}}</td>
    <td><img src="{{Storage::url('category/'.$data->img)}}" alt="category image" height="40px" width="40px"></td>
    <td>{{$data->is_active}}</td>
    <td>
{{--        <form method="POST" action="{{route('category.destroy' , ['category' =>$data->id ])}}"  class="d-inline" >--}}
{{--            @csrf--}}
{{--            @method('delete')--}}
{{--            <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>--}}
{{--        </form>--}}
        <a href="#" class="btn btn-outline-danger btn-sm delete" data-id="{{$data->id}}">DELETE</a>
        <a href="{{route('category.edit' ,  ['category'=>$data->id])}}" class="btn btn-outline-primary btn-sm">Edit</a>
    </td>
</tr>
