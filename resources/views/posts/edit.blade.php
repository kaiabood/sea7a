@extends('layouts.app')

@section('admin')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h4>Edit Post</h4></div>

                <div class="card-body">
                    



@if(count($errors)>0)

<ul class="navbar-nav mr-auto">

@foreach( $errors->all() as $error )
      <li class="nav-item active">
       {{ $error }}
      </li>
       
     @endforeach
    
    </ul>

@endif




<form action="/post/update/{{$post->id}}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}


{{-- category --}}

<div class="form-group">
  <label for="exampleFormControlSelect1"><h5>Category</h5></label>
  <select class="form-control" name="category" id="category_id">
   






@foreach ($categores as $category)
@if($post->category == $category)
<option value={{ $category }} selected>{{ $category }}</option>
@else <option value={{ $category }}>{{ $category }}</option>  
@endif
@endforeach
  </select>
</div>

{{-- name --}}
<div class="form-group">
  <label for="name"><h5>Name</h5></label>
  <input type="textarea" class="form-control" name="name" value="{{$post->name}}">
  </div>


{{-- contente --}}
<div class="form-group">
  <label for="contente"><h5>Contente</h5></label>
  <textarea class="form-control" name="contente" rows="8" cols="8">{{$post->contente}}</textarea>
</div>

{{-- city --}}
<div class="form-group">
  <label for="city"><h5>City</h5></label>
  <input type="textarea" class="form-control" name="city" value="{{$post->city}}" >
  </div>
  

  {{-- time --}}
<div class="form-group">
  <label for="time"><h5>Time</h5></label>
  <input type="textarea" class="form-control" name="time" value="{{$post->time}}">
  </div>



  {{--  phone_number --}}
  <div class="form-group">
    <label for="phone_number"><h5>Phone Number</h5></label>
    <input type="textarea" class="form-control" name="phone_number" value="{{$post->phone_number}}"
    >
    </div>

  {{-- map --}}
  <div class="form-group">
    <label for="map"><h5>link of map</h5></label>
    <textarea class="form-control" name="map" rows="8" cols="8">{{$post->map}}</textarea>
  </div>

    {{-- image --}}
    <div class="form-group">
      <label for="image"><h5>Image</h5></label>
      <input type="file" class="form-control-file" name="image" >
    </div>
  
  <button type="submit" class="btn btn-primary"><h5>Save</h5></button>
</form>


                </div>
            </div>
        </div>
    </div>
</div>

@endsection