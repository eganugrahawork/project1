<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="icon" href="{{ asset('storage/logos/logoputih.png') }}"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/login.css">
</head>

<body>

    <img src="{{ asset('storage/logos/loccanalogo.png') }}" id="img-responsive" >
    <div class="success-message" data-successmessage="{{ session('success') }}"></div>
    <div class="fail-message" data-failmessage="{{ session('fail') }}"></div>
    <div class="box">
        <h2>Login</h2>
        <hr>
        <span id="typehere" class="fs-6 fw-bolder text-white"></span>
        @error('username')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Waduh !!</strong> {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @enderror
        <form method="POST" action="{{ route('login') }}" class="mt-3">
          @csrf
            <div class="inputBox">
            <input type="username" name="username" class="@error('username') is-invalid @enderror" required onkeyup="this.setAttribute('value', this.value);" value="{{ old('username') }}">
            <label>Username</label>
          </div>
          <div class="inputBox">
            <input type="password" name="password" required value=""
                   onkeyup="this.setAttribute('value', this.value);">
            {{-- <input type="password" class="@error('password') is-invalid @enderror" name="password" required value=""
                   onkeyup="this.setAttribute('value', this.value);"
                   pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                   title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"> --}}
            <label>Password</label>

          </div>
          <button type="submit" class="btn-custom btn-animenya" id="btn-custom" >Sign in</button>
          <div id="loadingnya"></div>
        </form>

        <div class="d-flex justify-content-center mt-4">
            <p class="text-white">Do not Have Account ? <a href="/register" class=" text-warning">Create Account ?</a></p>
        </div>
        <div class="d-flex justify-content-center">
            <a href="/forgot-password" class="text-warning"> Forgot Password ?</a>
        </div>
      </div>

      {{-- <script src="/js/admin/index.js"></script> --}}
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
      <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script>
        $('form').submit(function(){
            $('#btn-custom').hide()
            $('#loadingnya').html('<div class="spinner-grow text-success" role="status"><span class="sr-only"></span></div>')
            // $('#btn-custom').attr("disabled", 'disabled')
        })

        // success message
        const successMessage = $('.success-message').data('successmessage')
        const failMessage = $('.fail-message').data('failmessage')

        if(successMessage){
            Swal.fire(
                'Success',
                successMessage,
                'success'
            )
        }

        if(failMessage){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: failMessage
            })
        }
      </script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.8/typed.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.8/typed.min.js"></script>
      <script>
      var typed = new Typed("#typehere", {
    strings: ["Loccana ", "Is The Best Solution", "For Your Bussiness.", "Lets Register Now", 'And Get The Best Offer From Us.', 'Dont Forget To Smile And Make Your Day Happier :).', 'Greeting From Us, Team Loccana.'],
    typeSpeed: 50
});
      </script>

</body>

</html>
