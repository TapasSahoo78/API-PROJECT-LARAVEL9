<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<style>
    span {
        color: red;
    }
    .result{
        color: green;
    }
</style>

<h1>User Registration</h1>

<form id="register_form">
    <input type="text" name="name" placeholder="Enter Name">
    <br>
    <span class="error name_error"></span>
    <br><br>
    <input type="email" name="email" placeholder="Enter Email">
    <br>
    <span class="error email_error"></span>
    <br><br>
    <input type="password" name="password" placeholder="Enter Password">
    <br>
    <span class="error password_error"></span>
    <br><br>
    <input type="password" name="password_confirmation" placeholder="Enter Confirm Password">
    <br>
    <span class="error password_confirmation_error"></span>
    <br><br>
    <input type="submit" value="Register">
</form>
<br>
<p class="result"></p>

<script>
    $(document).ready(function() {
        $("#register_form").submit(function(event) {
            event.preventDefault();

            var formData = $(this).serialize();
            $.ajax({
                url: "http://localhost:8000/api/register",
                type: "POST",
                data: formData,
                success: function(data) {
                    if (data.msg) {
                        $("#register_form")[0].reset();
                        $(".error").text("");
                        $(".result").text(data.msg);
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
                if (key == 'password') {
                    if (value.length > 1) {
                        $(".password_error").text(value[0]);
                        $(".password_confirmation_error").text(value[1]);
                    } else {
                        if (value[0].includes("password confirmation")) {
                            $(".password_confirmation_error").text(value);
                        } else {
                            $(".password_error").text(value);
                        }
                    }
                } else {
                    $("." + key + "_error").text(value);
                }
            });
        }
    });
</script>
