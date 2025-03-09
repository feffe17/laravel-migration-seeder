<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabellone Treni</title>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <h1>Tabellone Treni</h1>
    <table>
        <thead>
            <tr>
                <th>Azienda</th>
                <th>Partenza</th>
                <th>Arrivo</th>
                <th>Orario Partenza</th>
                <th>Orario Arrivo</th>
                <th>Codice Treno</th>
                <th>Carrozze</th>
                <th>Stato</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trains as $train)
                <tr>
                    <td>{{ $train->azienda }}</td>
                    <td>{{ $train->stazione_partenza }}</td>
                    <td>{{ $train->stazione_arrivo }}</td>
                    <td>{{ $train->orario_partenza }}</td>
                    <td>{{ $train->orario_arrivo }}</td>
                    <td>{{ $train->codice_treno }}</td>
                    <td>{{ $train->totale_carrozze }}</td>
                    <td>
                        @if ($train->cancellato)
                            ❌ Cancellato
                        @elseif (!$train->in_orario)
                            ⚠️ In Ritardo
                        @else
                            ✅ In Orario
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
