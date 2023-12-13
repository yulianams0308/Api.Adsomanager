@extends('layouts.app')
@section('content')
    <table>
        <thead>
            <tr>
                <th>observacion</th>
                <th>fecha_inicio</th>
                <th>fecha_fin</th>
                <th>Ambiente</th>
                <th>Ficha</th>
                <th>Sede</th>
                <th>Capacidad del ambiente</th>
            </tr>
        </thead>

    @foreach ($sessions as $session)
    <tbody>
    <tr>
                    <th>{{$session->observacion}}</th>
                    <th>{{$session->fecha_inicio}}</th>
                    <th>{{$session->fecha_fin}}</th>
                    <th>{{$session->room->num_salon}}</th>
                    <th>{{$session->datasheet->numero_ficha}}</th>
                    <th>{{$session->room->sede}}</th>
                    <th>{{$session->room->capacidad}}</th>
                


                    <th><a href="{{route('sessions.show',$session->id)}}">Detalle</a></th>
                    <th>
                       <form method="post" action="{{route('sessions.destroy',$session->id)}}">
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