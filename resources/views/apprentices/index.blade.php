@extends('layouts.app')
@section('content')
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Estado</th>
                <th>Etapa</th>
                <th>Ficha</th>

            </tr>
        </thead>

    @foreach ($aprendices as $aprendiz)
    <tbody>
    <tr>
                
                    <th>{{$aprendiz->user->name}}</th>
                
                 
                    <th>{{$aprendiz->user->email}}</th>
               
             
                    <th>{{$aprendiz->estado}}</th>
        
                    <th>{{$aprendiz->etapa}}</th>
        
                    <th>{{$aprendiz->datasheet->numero_ficha}}</th>

                    <th><a href="{{route('apprentices.show',$aprendiz->id)}}">Detalle</a></th>
                    <th>
                       <form method="post" action="{{route('apprentices.destroy',$aprendiz->id)}}">
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