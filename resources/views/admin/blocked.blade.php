<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Access Blocked</title>
        <link rel="icon" type="image/x-icon" href="{{ asset('storage/img-users/default.png') }}" >
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>


    <body class="bg-dark text-white">
        <div class="d-flex align-items-center justify-content-center vh-100">
            <div class="text-center">
                <h1 class="display-1 fw-bold">Access Blocked</h1>
                <p class="fs-3"> <span class="text-danger">Opps!</span> You dont have permissions.</p>
                <p class="lead">
                    Try another page.
                  </p>
                <a href="/admin/dashboard" class="btn btn-primary">Back</a>
            </div>
        </div>
    </body>


</html>
