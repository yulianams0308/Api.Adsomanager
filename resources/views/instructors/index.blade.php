@extends('layouts.app')
@section('content')
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Profesion</th>

            </tr>
        </thead>

    @foreach ($instructors as $instructor)
    <tbody>
    <tr>
                
                    <th>{{$instructor->user->name}}</th>
                
                 
                    <th>{{$instructor->user->email}}</th>
               
             
                    <th>{{$instructor->profesion}}</th>

                    <th><a href="{{route('instructors.show',$instructor->id)}}">Detalle</a></th>
                    <th>
                       <form method="post" action="{{route('instructors.destroy',$instructor->id)}}">
                           @method('delete')
                           @csrf
                           <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                       </form>
                    </th>
    </tr>
            @endforeach

        </tbody>            
    </table>
@endsection