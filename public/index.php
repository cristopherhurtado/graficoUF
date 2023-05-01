<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="stylesheet" href="./css/style.css">
    <title>Grafico UF</title>
</head>

<body>

    <section>
        <h2 class="text-center">Grafico Indicador Unidad de Fomento</h2>
        <div class="container">
            <form id="filtro-fechas">
                <div class="d-flex justify-content-center">
                    <div class="px-4">
                        <label for="fecha-desde">Desde:</label>
                        <input class="form-control" type="date" id="fecha-desde" name="fecha-desde">
                    </div>
                    <div>
                        <label for="fecha-hasta">Hasta:</label>
                        <input class="form-control" type="date" id="fecha-hasta" name="fecha-hasta">
                    </div>
                </div>
                <div class="offset-9">
                    <button class="btn btn-outline-primary mt-2" type="submit">Filtrar</button>
                </div>
            </form>
            <div class="col-8 offset-2">
                <canvas id="graficouf"></canvas>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.0.2/chart.js" integrity="sha512-n8DscwKN6+Yjr7rI6mL+m9nS4uCEgIrKRFcP0EOkIvzOLUyQgOjWK15hRfoCJQZe0s6XrARyXjpvGFo1w9N3xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="./js/grafico.js"></script>
    <script src="./js/importarApi.js"></script>
</body>

</html>