<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Url Shortner</title>
</head>

<body>

    @guest
    <a href="{{ route('login') }}">Log in</a>
    @endguest

    @auth
    <a href="{{ route('admin.list-links') }}">Dashboard</a>   
    @endauth

    <h1 class="text-center">Url Shortner</h1>


    <div class="container row">
        <div class="col-md-4">
        </div>
        <div class="col-md-6">

            @if (session('success'))
               URL shortened successfully <a href="{!! session('success') !!}">{!! session('success') !!}</a> 
            @endif

            <br><br>
            <form method="POST" action="{{ route('shorten.url') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Full URL *</label>
                    <input type="text" class="form-control" name="original_url" required>
                    <div id="emailHelp" class="form-text">We'll provide you a short url.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Expiry date(optional)</label>
                    <input type="date" class="form-control" name="expires_on" >
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
