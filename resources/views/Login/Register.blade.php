<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Register</title>
    <link href="/css/Login/Login.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>

<body>
    <div class="Register">
        <form method="post" action="{{route('PostRegister')}}" id="form-register">
            @csrf
            <div class="text-field">
                <label for="name">Name</label>
                <input autocomplete="off" type="text" id="name" name="name" placeholder="Enter your name" />
            </div>
            <div class="text-field">
                <label for="email">Email</label>
                <input autocomplete="off" type="text" id="email" name="email" placeholder="Enter your email" />
            </div>
            <div class="text-field password-input">
                <label for="password">Password</label>
                <input autocomplete="off" type="password" name="password" id="password" placeholder="Enter your password here" />
            </div>
            <div class="text-field password-input">
                <label for="confirm-password">Confirm Password</label>
                <input autocomplete="off" type="password" name="confirm_password" id="confirm_password" placeholder="Enter your confirm-password" />
            </div>
            <div class="form-group">
                <button class="btn btn-primary submit-login" id="submit-register" type="submit">Đăng ký</button>
                <div class="a_div">
                    <a href="{{route('Login')}}" class="login_forgot">Bạn đã có tài khoản?Đăng nhập</a>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js" type="text/javascript"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#submit-register").click(function() {
                $("#form-register").validate({
                    rules: {
                        name: {
                            required: true,
                            maxlength: 30,
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        password: {
                            required: true,
                            minlength: 6,
                        },
                        confirm_password: {
                            required: true,
                            equalTo: "#password",
                        }
                    },
                    messages: {
                        name: {
                            required: "Họ tên không được để trống",
                            maxlength: "Hộ tên không được vượt quá 30 ký tự"
                        },
                        email: {
                            required: "Bạn chưa nhập email",
                            email: "Email không đúng định dạng"
                        },
                        password: {
                            required: "Please provide a password",
                            minlength: "Mật khẩu phải có ít nhất 6 chữ ký tự"
                        },
                        confirm_password: {
                            required: "Vui lòng xác nhận mật khẩu",
                            equalTo: "Mật khẩu nhập lại không khớp"
                        }

                    }
                });
            });
        });
    </script>

</body>

</html>