<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        h2 {
            color: #333;
        }

        p {
            color: #555;
        }

        p.phone,
        p.email {
            font-size: 14px;
            font-style: italic;
            opacity: 0.8;
        }

        span.phone,
        span.email {
            color: #cc0909;
            font-weight: bold;
            margin-top: 5px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Đặt lại mật khẩu</h2>
        </div>
        <h3>Xin chào {{$username}},</h3>
        <p>Chúng tôi đã nhận được yêu cầu đặt lại mật khẩu của bạn. Nếu bạn không yêu cầu điều này, vui lòng bỏ qua
            email này.</p>
        <p>Để đặt lại mật khẩu, hãy nhấp vào nút dưới đây:</p>
        <a class="button" href="{{$urlActive}}"
            style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: #fff; text-decoration: none;">Đặt
            lại mật khẩu</a>
        <p>Nếu bạn gặp bất kỳ vấn đề nào, vui lòng liên hệ với chúng tôi:</p>
        <p class="phone">Qua số điện thoại: <span class="phone">0338.237.xxx</span></p>
        <p class="email">Qua email: <span class="email">storeshoes@gmail.com</span></p>
        <p>Shoes store hân hạnh được đồng hành cùng bạn</p>
    </div>
</body>

</html>
