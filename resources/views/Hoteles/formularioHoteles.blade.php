@extends('layout')

@section('contenido')

<div class="container mx-auto">
    <h1>Crear hotel</h1>
    <hr>

    <form action="{{route('guardarHotel')}}" method="POST">
        {{csrf_field()}}
        <div class="form-group col-md-6 row">
            <div class="form-group col-md-6">
                <label for="Nombre" class="form-label mt-4">Nombre</label>
                <!-- Poner el error si el campo está vacío--> 
                @if($errors->first('NombreHotel'))
                    <p class="text-danger">{{$errors->first('NombreHotel')}}</NombreHotel>
                @endif
                <input type="text" class="form-control" name="NombreHotel" id="NombreHotel" value="{{old('NombreHotel')}}" aria-describedby="NombreHelp" placeholder="Digite Nombre">
                <small id="NombreHelp" class="form-text text-muted">Debe digitar Nombre.</small>
            </div>
            
            <div class="form-group col-md-6">
                <label for="direccion" class="form-label mt-4">Dirección</label>
                @if($errors->first('DireccionHotel'))
                    <p class="text-danger">{{$errors->first('DireccionHotel')}}</DireccionHotel>
                @endif
                <input type="text" class="form-control" name="DireccionHotel" id="DireccionHotel" value="{{old('DireccionHotel')}}" placeholder="Digite dirección">
            </div>
        </div>

        <div class="form-group col-md-6 row">
            <div class="form-group col-md-6">
                <label for="Ciudad" class="form-label mt-4">Ciudad</label>
                @if($errors->first('IdCiudadHotel'))
                    <p class="text-danger">{{$errors->first('IdCiudadHotel')}}</IdCiudadHotel>
                @endif
                <select class="form-select" name="IdCiudadHotel" id="IdCiudadHotel">
                    <option value="">Seleccione ciudad...</option>
                    <option value="1">Cartagena</option>
                    @foreach( $Ciudades as $Ciudad )
                        <option value="{{$Ciudad->IdCiudad}}">{{$Ciudad->NombreCiudad}}</option>
                    @endforeach
                </select>
            </div>
        
            
            <div class="form-group col-md-6">
                <label for="NIT" class="form-label mt-4">NIT</label>
                @if($errors->first('NITHotel'))
                    <p class="text-danger">{{$errors->first('NITHotel')}}</NITHotel>
                @endif
                <input type="number" class="form-control" name="NITHotel" id="NITHotel" value="{{old('NITHotel')}}" placeholder="Digite NIT">
            </div>
            
        </div>

        <div class="form-group col-md-6 row">
 
        <div class="form-group col-md-6">
            <label for="NroHabitaciones" class="form-label mt-4">Nro Hbs.</label>
            @if($errors->first('NroHabsHotel'))
                <p class="text-danger">{{$errors->first('NroHabsHotel')}}</NroHabsHotel>
            @endif
            <input type="number" class="form-control" name="NroHabsHotel" id="NroHabsHotel" value="{{old('NroHabsHotel')}}" placeholder="Digite Nro Habs.">
        </div>

        </div>

        

        <br><br>
        <button type="submit" class="btn btn-primary">Guardar</button>
        </fieldset>
    </form>
    
</div>

@stop
