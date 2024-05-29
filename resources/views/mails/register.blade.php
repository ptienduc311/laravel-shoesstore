<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        .content {
            margin-top: 20px;
        }

        p {
            margin-bottom: 15px;
        }

        p.notify {
            opacity: 0.7;
            font-style: italic;
        }

        a.register {
            text-transform: uppercase;
            font-weight: bold;
            color: red;
            text-decoration: none;
            transition: text-decoration 0.3s ease;
        }

        a.register:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Xác nhận tài khoản của bạn</h2>
        </div>
        <div class="content">
            <p>Xin chào {{$username}},</p>
            <p>Cảm ơn bạn đã đăng ký tài khoản tại Shoes Store. Để hoàn tất quá trình đăng ký, hãy nhấn vào nút bên
                dưới:</p>
            <a class="button" href="{{$urlActive}}"
                style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none;">Xác
                nhận tài khoản</a>
            <p>Nếu bạn không thực hiện đăng ký, vui lòng bỏ qua email này.</p>
            <p class="notify">Email này có hiệu lực trong vòng 24 giờ. Nếu quá 24 giờ xác nhận sẽ không còn hiệu lực.
            </p>
            <p class="notify">Nếu bạn vẫn muốn đăng ký tài khoản thì hãy nhấn vào đường dẫn bên dưới</p>
            <a href="{{$urlReg}}" class="register">Đăng ký</a>
            <p style="font-weight:bold;">Trân trọng,</p>
            <p>Shoes Store</p>
        </div>
    </div>
</body>

</html>
