<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<h1>登录成功  Welcome to Home Page</h1>
token:{{ session('jwt_token') }}
<input id="token" name="token" value="{{ session('jwt_token') }}" type="hidden">
<button id="fetchData">profile 接口来获取用户信息</button>
<hr>
 <div id="user"></div>
</body>
<script>

        $('#fetchData').click(function() {
            // 从 session 或其他地方获取 Bearer Token
            var bearerToken = $('#token').val(); // 这里替换为实际的 Bearer Token
            console.log(bearerToken)
            $.ajax({
                url: '{{route('me')}}',
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + bearerToken
                },
                success: function(response) {
                    console.log('Data fetched successfully:', response);
                    if (response.status == 200){
                        $('#user').html(response.user.username);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data:', xhr.responseText);
                }
            });
        });
</script>
</html>
