<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Attendances</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <form action="{{ route('attendances.store') }}" method="POST">
        @csrf
        <h3>Registro de Asistencia</h3>

        <div class="form-group">
            <label for="sesion_id">Sesión:</label>
            <select name="sesion_id" id="sesion_id" class="form-control">
                @foreach ($sessions as $sesion)
                    <option value="{{ $sesion->id }}">{{ $sesion->fecha_inicio }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="aprendices_no_asistieron">Seleccione los aprendices que no asistieron:</label>
            @foreach ($apprendices as $aprendiz)
                <div class="form-check">
                    <input type="checkbox" name="aprendices_no_asistieron[]" value="{{ $aprendiz->id }}">
                    <label>{{ $aprendiz->user->name }}</label>
                </div>
            @endforeach
        </div>



        <button type="submit" class="btn btn-primary">Guardar Asistencia</button>
    </form>





</body>
</html>
