<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="login">
    <!-- include navigation -->
    <?php include_once('./components/navigation.php');?>

    <!-- section 1 -->
    <section id="section-1">
        <div class="form-wrap">
            <div class="title">LOGIN</div>
            <div class="form-item-wrap">
                <input type="text" class="inp-text" id="email" placeholder="Email Address" autocomplete="new-email">
            </div>
            <div class="form-item-wrap">
                <input type="password" class="inp-text" id="password" placeholder="Password"
                    autocomplete="new-password">
            </div>
            <div class="marg-b">
                <input class="inp-text" type="checkbox" id="remember" checked>
                <label for="remember">
                    Remember Me
                </label>
            </div>
            <div class="marg-b">
                <button onclick="user_login()" class="btn btn-common w100">Log In</button>
            </div>
            <div>
                <label>
                    Forgot your password? <a href="">Click here </a>
                </label>
            </div>
            <div>
                <label>
                    Don't you have an account? <a href="./register.php">Click here </a>
                </label>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>


    <!-- scripts -->
    <script>
    function user_login() {

        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let enc_pass = md5(password);

        if (email === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter your email address to continue'
            })
            return;
        }
        if (!(email_pattern.test(email))) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid field',
                html: "<b>" + email +
                    "</b> is not an valid email address. Enter a valid email address"
            })
            return;
        }
        if (password === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter your password to continue'
            })
            return;
        }

        let data = new FormData();
        data.append('email', email);
        data.append('password', enc_pass);
        data.append('user_login', 'true');

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "c1") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Unregisterd Email',
                        html: "<b>" + email +
                            "</b> address is not registerd in our database"
                    })
                } else if (x.code === "c2") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Incorect Password',
                        html: "Incorrect password for the <b>" + email + "</b> address"
                    })
                } else if (x.code === "c3") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Successfull',
                        html: "Welcome <b>" + x.name + "</b>!"
                    }).then(() => {
                        if (x.role == 1) {
                            window.location = "./admin_dashboard1.php";
                        } else if (x.role == 2) {
                            window.location = "./dashboard1.php";
                        }

                    })
                }
            }
        };
        xhttp.open("POST", "./functions/functions.php", true);
        xhttp.send(data);
    }
    </script>
</body>

</html>