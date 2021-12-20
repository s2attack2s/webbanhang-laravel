<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Login</title>
    <link href="/css/Login/Login.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
    @include('sweetalert::alert')

    <div class="Login">

        <form action="{{route('PostLogin')}}" method="post" id="form-login">
            @csrf
            <div class="text-field">
                <label for="email">Email</label>
                <input autocomplete="off" type="text" id="email" name="email" placeholder="Enter your email" />
            </div>
            <div class="text-field password-input">
                <label for="password">Password</label>
                <input autocomplete="off" type="password" name="password" id="password" placeholder="Enter your password here" />
            </div>
            @if($errors->any())
            <p class="error">{{$errors->first()}}</p>
            @endif
            <div class="form-group">
                <button class="btn btn-primary submit-login" type="submit">Đăng nhập</button>

            </div>
        </form>
        <div class="a_div">
            <button data-toggle="modal" data-target="#forgot-pass" class="btn btn-warning login_forgot">Quên mật khẩu?</button>
            <a href="{{route('Register')}}" class="login_signup">Bạn chưa có tài khoản?</a>
        </div>
 
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" type="text/javascript"></script>
    <script src="//js.pusher.com/3.1/pusher.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#form-login").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                    }
                },
                messages: {
                    password: {
                        required: "Vui lòng nhập mật khẩu",
                    },
                    email: {
                        required: "Bạn chưa nhập email",
                        email: "Email không đúng định dạng"
                    }
                },

                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>