    @extends('principal')
    @section('contenido')

    @if(Auth::check())
    @if (Auth::user()->id_rol == 1)
    <template v-if="menu==0">
        <example-component></example-component>
    </template>

    <template v-if="menu==1">
        <persona></persona>
    </template>

    <template v-if="menu==2">
        <tipo_empleado></tipo_empleado>
    </template>

    <template v-if="menu==3">
        <departamento></departamento>
    </template>

    <template v-if="menu==4">
        <especialidad></especialidad>
    </template>

    <template v-if="menu==5">
        <horario></horario>
    </template>

    <template v-if="menu==6">
        <jornada></jornada>
    </template>

    <template v-if="menu==7">
        <user></user>
    </template>

    <template v-if="menu==8">
        <rol></rol>
    </template>

    <template v-if="menu==9">
        <h1>Contenido del menú 9</h1>
    </template>

    <template v-if="menu==10">
        <tipo_permiso></tipo_permiso>
    </template>

    <template v-if="menu==11">
        <evento_persona></evento_persona>
    </template>

    <template v-if="menu==12">
        <evento></evento>
    </template>

    <template v-if="menu==13">
        <especilidad_persona></especilidad_persona>
    </template>

    <template v-if="menu==14">
        <departamento_persona></departamento_persona>
    </template>
    @elseif (Auth::user()->id_rol == 2)
    <template v-if="menu==8">
        <rol></rol>
    </template>
    @else
    @endif
    @endif


    @endsection