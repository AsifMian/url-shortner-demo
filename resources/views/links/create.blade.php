<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Short Links ASIF</title>
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
            <form action="{{route('create_short_link')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="original_url">Paste Your Link</label>
                    <input class="form-control" type="url" required name="original_url">
                    <button class="form-control mt-3 btn btn-sm btn-primary" type="submit">Short My Link</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
