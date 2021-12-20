<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="referrer" content="never">
    <title>Quên mật khẩu</title>
    <link href="/css/Login/Login.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="Login">
        <form action="/reset" method="post" id="Password-form">
            @csrf
            <input type="hidden" name="token" value="{{$passwordReset->token}}" />
            <div class="text-field">
                <label for="email">Email</label>
                <input autocomplete="off" type="email" id="email" name="email" value="{{$passwordReset->email}}" placeholder="Enter your email" readonly />
            </div>
            <div class="text-field">
                <label for="password">Mật khẩu</label>
                <input autocomplete="off" type="password" id="password" name="password" placeholder="Enter your password" />
            </div>
            <div class="text-field password-input">
                <label for="password_confirmation">Nhập lại mật khẩu</label>
                <input autocomplete="off" type="password" name="password_confirmation" id="password_confirmation" placeholder="Enter your password here" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary submit-login" type="submit">Đổi</button>
            </div>
        </form>
        <div class="a_div">
            <a href="{{route('Register')}}" class="login_signup">Bạn chưa có tài khoản?</a>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous" type="text/javascript"></script>

    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#Password-form").validate({
                rules: {
                    email:{
                        required: true,
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    password_confirmation: {
                        required: true,
                        equalTo: '#password'
                    }
                },
                messages: {
                    email:{
                        required: "Email không được để trống",
                    },
                    password: {
                        required: "Mật khẩu không được để trống",
                        minlength: "Mật khẩu ít nhất 6 chữ số"
                    },
                    password_confirmation: {
                        required: "Vui lòng xác nhận mật khẩu",
                        equalTo: 'Mật khẩu chưa trùng khớp'
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