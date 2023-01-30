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


        <div class="card" style="width: 18rem;">
            <img src={{ URL::asset('storage/' . $applicant->photo) }} class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-text">{{ $applicant->name }}</h5>
                <p class="card-text">{{ $applicant->user->email }}</p>
                <p class="card-text">{{ $applicant->itin }}</p>
                <p class="card-text">{{ $applicant->gender }}</p>
                <p class="card-text">{{ $applicant->age }}</p>


            </div>
        </div>

    </main>

</body>

</html>
