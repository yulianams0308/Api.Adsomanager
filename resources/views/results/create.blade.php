<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Competences</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cden.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
  <form action="{{route('results.store')}}" method="POST" >

    @csrf

    <div class="form-group">
    <label for="exampleFormControlInput1">Nombre resultado</label>
    <input type="text" class="form-control" name="nombre_resultado" placeholder="">
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Descripcion</label>
    <input type="text" class="form-control" name="descripcion" placeholder="">
  </div>

  <div class="form-group">
    <label for="exampleFormControlInput1">Horas</label>
    <input type="time" class="form-control" name="horas" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Fecha de inicio</label>
    <input type="date" class="form-control" name="fecha_inicio" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Fecha fin</label>
    <input type="date" class="form-control" name="fecha_fin" placeholder="">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Anexo</label>
    <input type="text" class="form-control" name="url_formato" placeholder="">
  </div>
  <div class="form-group">

    <div class="form-group">
        <select class="form-control select2" name="competences[]" id="competences" multiple>
            @foreach($competences as $id => $competence)
                <option value="{{ $id }}">{{ $competence }}</option>
            @endforeach
        </select>
    </div>

  </div>
  <button type="submit">Enviar Formulario</button>

</form>

</body>
</html>


