<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sessions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
  <form action="{{route('sessions.store')}}" method="POST" >
  
    @csrf
  
    <div class="form-group">
        <label for="exampleFormControlInput1">Observación</label>
        <input type="text" class="form-control" name="observacion" placeholder="">
      </div>

      <div class="form-group">
        <label for="exampleFormControlInput1">Fecha de inicio</label>
        <input type="datetime-local" class="form-control" name="fecha_inicio" placeholder="">
      </div>
    
      <div class="form-group">
        <label for="exampleFormControlInput1">Fecha de fin</label>
        <input type="datetime-local" class="form-control" name="fecha_fin" placeholder="">
      </div>

    
    <div class="form-group">
        <label for="exampleFormControlSelect1">Ficha</label>
        <select class="form-control" name="ficha_id">
            @foreach($datasheet as $datasheet)
            <option value="{{ $datasheet['id'] }}">{{ $datasheet['numero_ficha'] }}</option>
        @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="exampleFormControlSelect1">Ambiente</label>
        <select class="form-control" name="ambiente_id">
            @foreach($room as $room)
            <option value="{{ $room['id'] }}">{{ $room['num_salon'] }}</option>
        @endforeach
        </select>
    </div>
    
    



    
  
  <button type="submit">Enviar</button>
 



</form>




</body>
</html>