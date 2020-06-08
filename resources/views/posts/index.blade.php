@extends('layouts.app')

@section('admin')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4>Posts</h4></div>

                <div class="card-body">
                    



                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col"><h5>Image</h5></th>
                            <th scope="col"><h5>Category</h5></th>
                            <th scope="col"><h5>Name</h5> </th>
                            <th scope="col"><h5>Contente</h5></th>
                            <th scope="col"><h5>City</h5></th>
                            <th scope="col"><h5>Phone Nomber</h5></th>
                            <th scope="col"><h5>Time</h5></th>
                            <th scope="col"><h5>Edit</h5></th>
                           <th scope="col"><h5>Delete</h5></th>
 
 
                          </tr>
                        </thead>
                        <tbody>
                          
                            
                            
                            @foreach ($posts as $post)
                                <tr>
                            <th scope="row">
                              <img src="{{$post->image}}" alt="{{$post->name}}" class="img-thumbnail" height="50px" width="50px">
                              </th>
                            
                            <th scope="row">{{$post->category}}</th>
                            <th scope="row">{{$post->name}}</th>
                            <th scope="row">{{$post->contente}}</th>
                            <th scope="row">{{$post->city}}</th>
                            <th scope="row">{{$post->phone_number}}</th>
                            <th scope="row">{{$post->time}}</th>




                           {{-- @if (Auth::check()) --}}
            
                          

                            <td><a class="" href="/post/edit/{{$post->id}}">
                               {{-- edit icon --}}
                                <svg class="bi bi-pencil-square" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M15.502 1.94a.5.5 0 010 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 01.707 0l1.293 1.293zm-1.75 2.456l-2-2L4.939 9.21a.5.5 0 00-.121.196l-.805 2.414a.25.25 0 00.316.316l2.414-.805a.5.5 0 00.196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 002.5 15h11a1.5 1.5 0 001.5-1.5v-6a.5.5 0 00-1 0v6a.5.5 0 01-.5.5h-11a.5.5 0 01-.5-.5v-11a.5.5 0 01.5-.5H9a.5.5 0 000-1H2.5A1.5 1.5 0 001 2.5v11z" clip-rule="evenodd"/>
                                  </svg>
                                {{-- edit icon end --}}

                            </a></td>

                            <form action="/post/delete/{{$post->id}}" method="POST">
                              {{ csrf_field() }}
                              @method("DELETE")

                            <td>  <button type="submit" class="btn btn-primary">delete</button></td>
                            </form >
                            {{-- @endif --}}
                            <i class="far fa-edit"></i>
                          </tr>
                            @endforeach

                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

