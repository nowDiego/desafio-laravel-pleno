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


    <main class="container-fluid w-100 d-flex gap-2 align-items-center justify-content-center">

        <div class="row gy-5">

            @foreach ($vacancies as $item)
                <div class="card col-6 m-2" style="width: 18rem;">

                    <div class="card-body">
                        <h5 class="card-text">{{ $item->title }}</h5>
                        <p class="card-text">{{ $item->description }}</p>
                        <p class="card-text">{{ $item->requirement }}</p>
                        @isRole(['Applicant'])
                            @if ($item->status->name == 'Ativo')
                                <button class="btn btn-outline-danger" id="apply"
                                    onclick="handleApply({{ $item->id }})">Candidatar-se</button>
                            @endif
                        @endisRole

                    </div>
                </div>
            @endforeach

        </div>

    </main>



</body>
<script>
    async function handleApply(value) {

        console.log(value)
        await fetch(`/vacancy/${value}/subscribe`, {
                headers: {
                    'Accept': 'application/json, text/plain, */*',
                    'Content-Type': 'application/json'
                },
                method: "POST",
                body: JSON.stringify({
                    _token: "{{ csrf_token() }}"
                })
            })
            .then(function(res) {
                return res.json();
            })
            .then(function(data) {

                if (data.status === true) {
                    document.location.reload(true)

                }

            })


    }
</script>

</html>
