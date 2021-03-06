<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de dias trabajados</title>
    <style>
        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            font-size: 0.875rem;
            font-weight: normal;
            line-height: 1.5;
            color: #151b1e;
        }

        .table {
            display: table;
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1px solid #c2cfd6;
        }

        thead {
            display: table-header-group;
            vertical-align: middle;
            border-color: inherit;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #c2cfd6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #c2cfd6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #c2cfd6;
        }

        th,
        td {
            display: table-cell;
            vertical-align: inherit;
        }

        th {
            font-weight: bold;
            text-align: -internal-center;
            text-align: left;
        }

        tbody {
            display: table-row-group;
            vertical-align: middle;
            border-color: inherit;
        }

        tr {
            display: table-row;
            vertical-align: inherit;
            border-color: inherit;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .izquierda {
            float: left;
        }

        .derecha {
            float: right;
        }
    </style>
</head>

<body>
    <div>
        <h1 ALIGN=center>Reporte de dias trabajados</h1>
        <h3>Lista de jornadas <span class="derecha">{{now()}}</span></h3>

        @if($criterio == 'id_persona')
        <h4>Criterio: Persona</h4>
        <h4>Buscar: {{$buscar}}</h4>
        @elseif($criterio == 'hora_salida')
        <h4>Criterio: Hora de salida</h4>
        <h4>Buscar: {{$buscar}}</h4>
        @elseif($criterio == 'hora_llegada')
        <h4>Criterio: Hora de Llegada</h4>
        <h4>Buscar: {{$buscar}}</h4>
        @elseif($criterio == 'fecha_llegada')
        <h4>Criterio: Fecha de Llegada</h4>
        <h4>Buscar: {{$buscar}}</h4>
        @elseif($criterio == 'fecha_salida')
        <h4>Criterio: Fecha de Llegada</h4>
        <h4>Buscar: {{$buscar}}</h4>
        @endif


    </div>
    <div>
        <table class="table table-bordered table-striped table-sm">
            <thead>
                <tr>
                    <th>Persona</th>
                    <th>Hora Llegada</th>
                    <th>Hora Salida</th>
                    <th>Fecha Llegada</th>
                    <th>Fecha Salida</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jornadas2 as $a)
                <tr>
                    <td>{{$a->Pnombre}}</td>
                    <td>{{$a->hora_llegada}}</td>
                    <td>{{$a->hora_salida}}</td>
                    <td>{{$a->fecha_llegada}}</td>
                    <td>{{$a->fecha_salida}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="izquierda">
        <p><strong>Total de dias trabajados: </strong>{{$cont}}</p>
    </div>
</body>

</html>