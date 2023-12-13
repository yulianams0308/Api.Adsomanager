@extends('layouts.app')

@section('content')
  <form action="{{route('datasheets.store')}}" method="POST" >

    @csrf

    <div class="form-group">
    <label for="exampleFormControlInput1">Número ficha</label>
    <input type="text" class="form-control" name="numero_ficha" placeholder="">
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Programa</label>
    <input type="text" class="form-control" name="programa" placeholder="">
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Competencias</label>
    <select class="form-control select2" name="competences[]" id="competences">
        @foreach($competences as $competence)
            <option value="{{ $competence->id }}">{{ $competence->nombre_competencia }}</option>
        @endforeach
    </select>
</div>

  <button type="submit">Enviar</button>

</form>


@endsection