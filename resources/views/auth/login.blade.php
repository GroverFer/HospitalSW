@extends('auth.contenido')

@section('login')
<div class="row justify-content-center ">
    <div class="col-md-8">
        <div class="card-group mb-0">
            <div class="card p-4 bg-transparent border-0">
                <form class="form-horizontal was-validated" method="POST" action="{{ route('login')}}">
                    {{ csrf_field() }}
                    <div class="card-body">
                        <h1 class="text-center text-success font-weight-bold ">INICIAR SESIÓN </h1>
                        <div class="form-group mb-3{{$errors->has('registro' ? 'is-invalid' : '')}}">
                            <span class="input-group-addon pl-2 font-weight-bold border-0 bg-transparent"><i class="icon-user"></i></span>
                            <input type="text" value="{{old('registro')}}" name="registro" id="registro" class="form-control border border-white rounded bg-white text-dark" placeholder="Registro">
                            {!!$errors->first('registro','<span class="invalid-feedback font-weight-bold text-success">:message</span>')!!}
                        </div>
                        <div class="form-group mb-4{{$errors->has('password' ? 'is-invalid' : '')}}">
                            <span class="input-group-addon font-weight-bold border-0 bg-transparent"><i class="icon-lock"></i></span>
                            <input type="password" name="password" id="password" class="form-control border border-white rounded bg-white text-dark" placeholder="Password">
                            {!!$errors->first('password','<span class="invalid-feedback font-weight-bold text-success">:message</span>')!!}
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" class="btn btn-success px-4 border border-success rounded text-white">Acceder</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card text-white bg-transparent py-5 d-md-down-none border-0" style="width:44%">
                <div class="card-body text-center">
                    <div>
                        <h5 class="text-left font-weight-bold font-italic bg-transparent rounded">SOFTWARE DE CONTROL DE ASISTENCIA PARA UN HOSPITAL CON AUTENTIFICACIÓN DE RECONOCIMIENTO FACIAL</h5>
                        <br>
                        <br>
                        <p class="text-left font-weight-bold font-italic">
                            Ingenieria de software - SC
                            <br>
                            Grupo: N.
                        </p>

                        <p class="text-center font-weight-bold font-italic">
                            Santa cruz - Bolivia
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection