<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Short Links DECODED</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        html,body{
            height: 100%;
        }
        body{
            display: grid;
            place-items: center;
            height: 100%;
        }
    </style>
</head>
<body>
    @include('inc.alerts')
    <div class="card">
        <div class="card-body">
           <h5 class="text-muted mb-2">You will be redirected to:</h5>
           @isset($link)
                <p class="font-weight-bold mt-3"> {{$link->original_url}}</p>
                <p class="mt-2 text-success">Link Visited: {{$link->visit_count}} times</p>
                <p class="text-danger">Last Visited: {{$link->updated_at}}</p>
           @endisset
        </div>
    </div>
</body>
</html>
