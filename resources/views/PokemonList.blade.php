<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap4.min.css">

        <title>Pokemons</title>
    </head>

    <body>
        <div class="container p-5 d-flex justify-content-between">
            <div class="card">
                <div class="card-body"> 
                    <table id="pokemons" class="display" style="width:100%">
                        <thead class="w-50">
                            <tr>
                                <td>Nombre</td>
                                <td class="text-right">Ver info</td>
                            </tr>
                        </thead>
                        <tbody class="w-50">
                            @foreach ($pokemons as $pokemon)
                                <tr>
                                    <td>{{ ucwords($pokemon['nombre']) }}</td>
                                    <td>
                                        <div class="text-right pr-3">
                                            <button class="btn btn-info" onclick="updateInfo('{{ $pokemon['url'] }}')">
                                                Info
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
    
            <div class="card">
                <div class="card-body">
                    <table class="inline">
                        @if ($details)
                            <tr>
                                <td>Nombre: </td>
                                <td id="pokeName">{{ ucwords($details['name']) }}</td>
                            </tr>
                            <tr>
                                <td>Experiencia: </td>
                                <td id="pokeXp">{{ $details['base_experience'] }}</td>
                            </tr>
                            <tr>
                                <td>Altura: </td>
                                <td id="pokeH">{{ $details['height'] }}</td>
                            </tr>
                            <tr>
                                <td>Peso: </td>
                                <td id="pokeW">{{ $details['weight'] }}</td>
                            </tr>
                            <tr>
                                <td>
                                    <img src="{{ $details['sprites']['back_default'] }}" alt="" srcset="">
                                </td>
                                <td>
                                    <img src="{{ $details['sprites']['front_default'] }}" alt="" srcset="">
                                </td>
                            </tr>
                        @else
                            <tr>
                                Seleccione un pokemon para ver los detalles
                            </tr>
                        @endif
                    </table>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js"></script>

        <script>
            new DataTable('#pokemons');
        </script>

        <script>
            function lastIndexOf(str, char) {
                for (let i = str.length - 1; i >= 0; i--) {
                    if (str[i] === char) {
                        return i;
                    }
                }
                return -1; 
            }//obtengo la ultima posicion 

            function updateInfo(pokeUrl) {
                let url = pokeUrl.slice(0, -1)//recortar el caracter
                let lastSlashIndex = lastIndexOf(url, '/')//optener posicion 
                let id = url.slice(lastSlashIndex + 1, url.lenght)//recortar posicion
                
                console.log(id);

                window.location.href = '/details/' + id

                // fetch('/details/' + id, {method: "GET"})
                // .then(response => {
                //     // response.json()
                //     // location.reload()
                //     console.log(response);
                // })
                // .catch(err => {
                //     console.log(err);
                // });
            }
        </script>
    </body>
</html>
