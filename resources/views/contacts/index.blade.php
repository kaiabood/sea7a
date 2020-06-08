@extends('layouts.app')

@section('admin')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h4>Contacts</h4></div>

                <div class="card-body">
                    



                    <table class="table table-striped">
                        <thead>
                          <tr>
                            
                            <th scope="col"><h5>Name</h5></th>
                            {{-- <th scope="col"><h5>Subject</h5></th> --}}
                            <th scope="col"><h5>Email</h5></th>
                            <th scope="col"><h5>Message</h5></th>
                            <th scope="col"><h5>Delete</h5></th>

 
                          </tr>
                        </thead>
                        <tbody>
                          
                            
                            
                            @foreach ($contacts as $contact)
                                <tr>
                            <th scope="row"><h5>{{$contact->name}}</h5></th>
                            {{-- <th scope="row"><h5>{{$contact->subject}}</h5></th> --}}
                            <th scope="row"><h5>{{$contact->email}}</h5></th>
                            <th scope="row"><h5>{{$contact->message}}</h5></th>
                            
                            <form action="/contact/delete/{{$contact->id}}" method="POST">
                              {{ csrf_field() }}
                              @method("DELETE")

                            <td>  <button type="submit" class="btn btn-primary">delete</button></td>
                            </form >
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