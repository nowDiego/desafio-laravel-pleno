<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employer</title>
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


        <h5>Editar Empregador</h5>

        <form method="POST" action="{{ route('employer.update', ['employer' => $employer->id]) }}"
            class="border m-2 p-5">
            @csrf
            @method('PATCH')

            <div class="mb-3">

                <label for="trade">Nome Fantasia</label>
                <input type="text" id="trade" name="trade" value="{{ $employer->trade }}" />
                @if ($errors->has('trade'))
                    <div class="error f_red">{{ $errors->first('trade') }}</div>
                @endif
            </div>
            <div class="mb-3">


                <label for="ein">CNPJ</label>
                <input type="text" id="ein" name="ein" value="{{ $employer->ein }}" />

                @if ($errors->has('ein'))
                    <div class="error f_red">{{ $errors->first('ein') }}</div>
                @endif
            </div>

            <button type="submit" class="btn btn-primary">Cadastrar</button>

        </form>

    </main>

</body>

</html>
