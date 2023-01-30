<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vacancy</title>
    <link href="/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>

    @include('Components.menu')

    <main class="container-fluid w-100 d-flex flex-column align-items-center justify-content-center">

        <h5>Cadastrar Vaga</h5>

        <form action="/vacancy" method="POST" class="border m-2 p-5">
            @csrf

            <div class="mb-3">
                <label for="title">Título</label>
                <input type="text" id="title" name="title" />
                @if ($errors->has('title'))
                    <div class="error f_red">{{ $errors->first('title') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="description">Descrição</label>
                <textarea type="text" id="description" name="description"></textarea>
                @if ($errors->has('description'))
                    <div class="error f_red">{{ $errors->first('description') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="requirement">Requisitos</label>
                <textarea type="text" id="requirement" name="requirement"></textarea>
                @if ($errors->has('requirement'))
                    <div class="error f_red">{{ $errors->first('requirement') }}</div>
                @endif
            </div>
            <div class="mb-3">
                <label for="type">Tipo de contratação</label>
                <select name="type" id="type">
                    @foreach ($types as $item)
                        <option value={{ $item->id }}>{{ $item->name }} </option>
                    @endforeach

                </select>
                @if ($errors->has('type'))
                    <div class="error f_red">{{ $errors->first('type') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>

        </form>

    </main>
</body>

</html>
