<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Signup</title>
    <link href="/css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>

<body>

    <main class="container-fluid w-100 d-flex  align-items-center justify-content-center">

        <div class="row gy-2">


            <form action="/signup/applicant" method="POST" enctype="multipart/form-data" class="col-6 p-5">
                @csrf

                <h3>Candidato</h3>

                <div class="mb-3">

                    <label for="name">Nome</label>
                    <input type="text" id="name" name="name" />
                    @if ($errors->has('name'))
                        <div class="error f_red">{{ $errors->first('name') }}</div>
                    @endif

                </div>

                <div class="mb-3">

                    <label for="email">E-mail</label>
                    <input type="text" id="email" name="email" />
                    @if ($errors->has('email'))
                        <div class="error f_red">{{ $errors->first('email') }}</div>
                    @endif

                </div>

                <div class="mb-3">

                    <label for="itin">CPF</label>
                    <input type="text" id="itin" name="itin" />
                    @if ($errors->has('itin'))
                        <div class="error f_red">{{ $errors->first('itin') }}</div>
                    @endif
                </div>

                <div class="mb-3">

                    <label for="gender">Gênero</label>
                    <select name="gender" id="gender">
                        <option value="M"> Masculino </option>
                        <option value="F"> Feminino </option>
                    </select>
                    @if ($errors->has('gender'))
                        <div class="error f_red">{{ $errors->first('gender') }}</div>
                    @endif
                </div>

                <div class="mb-3">

                    <label for="age">Idade</label>
                    <input type="text" id="age" name="age" />
                    @if ($errors->has('age'))
                        <div class="error f_red">{{ $errors->first('age') }}</div>
                    @endif
                </div>

                <div class="mb-3">

                    <label for="photo">Foto</label>
                    <input type="file" id="photo" name="photo" />
                    @if ($errors->has('photo'))
                        <div class="error f_red">{{ $errors->first('photo') }}</div>
                    @endif
                </div>

                <div class="mb-3">

                    <label for="username">Usuário</label>
                    <input type="text" id="username" name="username" />
                    @if ($errors->has('username'))
                        <div class="error f_red">{{ $errors->first('username') }}</div>
                    @endif
                </div>

                <div class="mb-3">

                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" />
                    @if ($errors->has('password'))
                        <div class="error f_red">{{ $errors->first('password') }}</div>
                    @endif
                </div>


                <button type="submit" class="btn btn-primary">Cadastrar</button>




            </form>

            <br />

            <form action="/signup/employer" method="POST" class="col-6 p-5">
                @csrf

                <h3>Empregador</h3>

                <div class="mb-3">

                    <label for="trade">Nome Fantasia</label>
                    <input type="text" id="trade" name="trade" />
                    @if ($errors->has('trade'))
                        <div class="error f_red">{{ $errors->first('trade') }}</div>
                    @endif
                </div>

                <div class="mb-3">

                    <label for="ein">CNPJ</label>
                    <input type="text" id="ein" name="ein" />
                    @if ($errors->has('ein'))
                        <div class="error f_red">{{ $errors->first('ein') }}</div>
                    @endif
                </div>

                <div class="mb-3">

                    <label for="email">E-mail</label>
                    <input type="text" id="email" name="email" />
                    @if ($errors->has('email'))
                        <div class="error f_red">{{ $errors->first('email') }}</div>
                    @endif
                </div>

                <div class="mb-3">

                    <label for="username">Usuário</label>
                    <input type="text" id="username" name="username" />
                    @if ($errors->has('username'))
                        <div class="error f_red">{{ $errors->first('username') }}</div>
                    @endif
                </div>

                <div class="mb-3">

                    <label for="password">Senha:</label>
                    <input type="password" id="password" name="password" />
                    @if ($errors->has('password'))
                        <div class="error f_red">{{ $errors->first('password') }}</div>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Cadastrar</button>

            </form>

        </div>

    </main>

</body>

</html>
