@include('header')
<h1>User Login</h1>

<form id="login_form">
    <input type="email" name="email" placeholder="Enter Email">
    <br>
    <span class="error email_error"></span>
    <br><br>
    <input type="password" name="password" placeholder="Enter Password">
    <br>
    <span class="error password_error"></span>
    <br><br>
    <input type="submit" value="Login">
</form>
<br>
<p class="result"></p>

<script>
    $(document).ready(function() {
        $("#login_form").submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();
            //console.log(formData);
            $.ajax({
                url: "http://localhost:8000/api/login",
                type: "POST",
                data: formData,
                success: function(data) {
                    console.log(data);
                    if (data.success == false) {
                        $('.result').text(data.msg);
                    } else if (data.success == true) {
                        localStorage.setItem("user_token", data.token_type + " " +
                            data.access_token);
                        window.open("/profile", "_self")
                    } else {
                        printErrorMsg(data);
                    }
                }
            });
        });

        function printErrorMsg(msg) {
            //console.log(msg);
            $(".error").text("");
            $.each(msg, function(key, value) {
                // console.log(value);
                $("." + key + "_error").text(value);
            });
        }
    });
</script>
</body>

</html>
