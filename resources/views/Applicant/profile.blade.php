<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Applicant</title>
    <link href="/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>

    @include('Components.menu')

    <main class="container-fluid w-100 d-flex flex-column align-items-center">


        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-3">

                <label for="name">Nome</label>
                <input type="text" id="name" name="name" value="{{ $applicant->name }}" />
                @if ($errors->has('name'))
                    <div class="error f_red">{{ $errors->first('name') }}</div>
                @endif

            </div>
            <div class="mb-3">

                <label for="gender">Gênero</label>
                <select name="gender" id="gender" value="{{ $applicant->gender }}">
                    <option value="M"> Masculino </option>
                    <option value="F"> Feminino </option>
                </select>
                @if ($errors->has('gender'))
                    <div class="error f_red">{{ $errors->first('gender') }}</div>
                @endif

            </div>
            <div class="mb-3">

                <label for="age">Idade</label>
                <input type="text" id="age" name="age" value="{{ $applicant->age }}" />
                @if ($errors->has('age'))
                    <div class="error f_red">{{ $errors->first('age') }}</div>
                @endif

            </div>
            <div class="mb-3">
                <label for="photo">Foto</label>
                <input type="file" id="photo" name="photo" />

            </div>


            <button type="submit" class="btn btn-primary">Atualizar</button>




        </form>

    </main>

</body>

</html>
