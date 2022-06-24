<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Block Message</title>
</head>
<body>
    <div class="mail" style="text-align: center">
        <a href="{{ route('welcome') }}"><img src="{{ asset('images/login-logo.png') }}" alt="logo"></a>
        <h2>Hello {{ $mailData->name }}</h2>
        <h3>Your access has been blocked by admin</h3>
        <p>Your access to Expense Manager aplication has been blocked. Reason: {{ $mailData->block_message }}</p>
        <p>If you think there's been a mistake, contact our admin team.<br>Email: expense-manager.admin@gmail.com</p>
    </div>
</body>
</html>
