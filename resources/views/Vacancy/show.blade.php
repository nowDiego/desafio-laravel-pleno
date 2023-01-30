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

    <main class="container-fluid w-100 d-flex align-items-center justify-content-center gap-4">

        <div class="w-30 h-50">
            <div>{{ $vacancy->title }}</div>
            <div>{{ $vacancy->description }}</div>
            <div>{{ $vacancy->requirement }}</div>
            <div>{{ $vacancy->employer->trade }}</div>
            <div>{{ $vacancy->status->name }}</div>
            <div>{{ $vacancy->type->name }}</div>
        </div>


        <div class="d-flex flex-column w-40 h-50 overflow-auto ">
            <h5>Candidatos:</h5>
            @foreach ($vacancy->applicants as $applicant)
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-text">{{ $applicant->itin }}</h5>
                        <p class="card-text">{{ $applicant->name }}</p>


                    </div>
                </div>
            @endforeach

        </div>


    </main>
</body>

</html>
