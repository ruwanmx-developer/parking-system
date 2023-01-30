<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="login">
    <!-- include navigation -->
    <?php include_once('./components/navigation.php');?>

    <!-- section 1 -->
    <section id="section-1">
        <div class="form-wrap">
            <div class="title mb-3">REGISTER</div>
            <div class="form-item-wrap">
                <input type="text" class="inp-text" id="fname" placeholder="First Name" autocomplete="new-password">
            </div>
            <div class="form-item-wrap">
                <input type="text" class="inp-text" id="lname" placeholder="Last Name" autocomplete="new-password">
            </div>
            <div class="form-item-wrap">
                <input type="text" class="inp-text" id="uname" placeholder="User Name" autocomplete="new-password">
            </div>
            <div class="form-item-wrap">
                <input type="text" class="inp-text" id="email" placeholder="Email Address" autocomplete="new-password">
            </div>
            <div class="form-item-wrap">
                <input type="text" class="inp-text" id="mobile" placeholder="Phone Number" autocomplete="new-password">
            </div>
            <div class="form-item-wrap">
                <input type="password" class="inp-text" id="password" placeholder="Password"
                    autocomplete="new-password">
            </div>
            <div class="form-item-wrap">
                <input type="password" class="inp-text" id="cpassword" placeholder="Confirm Password"
                    autocomplete="new-password">
            </div>
            <div class="marg-b">
                <input class="inp-text" type="checkbox" value="" id="confirm">
                <label for="confirm">
                    Agree to Terms & Conditions
                </label>
            </div>
            <div class="marg-b">
                <button onclick="user_register()" class="btn btn-common w100">Register</button>
            </div>
            <div class="">
                <label>
                    Already have an account? <a href="./login.php">Click here </a>
                </label>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>

    <!-- scripts -->
    <script>
    function user_register() {

        let fname = document.getElementById("fname").value;
        let lname = document.getElementById("lname").value;
        let uname = document.getElementById("uname").value;
        let email = document.getElementById("email").value;
        let mobile = document.getElementById("mobile").value;
        let password = document.getElementById("password").value;
        let cpassword = document.getElementById("cpassword").value;
        let confirm = document.getElementById("confirm");
        let enc_pass = md5(password);

        if (fname === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter your first name to continue'
            })
            return;
        }
        if (!(name_pattern.test(fname))) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid field',
                html: "<b>" + fname +
                    "</b> is not an valid first name. Enter a valid first name"
            })
            return;
        }
        if (lname === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter your last name to continue'
            })
            return;
        }
        if (!(name_pattern.test(lname))) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid field',
                html: "<b>" + lname +
                    "</b> is not an valid last name. Enter a valid last name"
            })
            return;
        }
        if (uname === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter your user name to continue'
            })
            return;
        }
        if (!(uname_pattern.test(uname))) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid field',
                html: "<b>" + uname +
                    "</b> is not an valid user name. Enter a valid user name"
            })
            return;
        }
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
        if (mobile === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter your mobile number to continue'
            })
            return;
        }
        if (!(mobile_pattern.test(mobile))) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid field',
                html: "<b>" + mobile +
                    "</b> is not an valid mobile number. Enter a valid mobile number"
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
        if (cpassword === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please confirm your password to continue'
            })
            return;
        }
        if (cpassword !== password) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Field',
                text: 'Passwords doesn\'t match'
            })
            return;
        }
        if (!confirm.checked) {
            Swal.fire({
                icon: 'warning',
                title: 'Unchecked Field',
                text: 'You have to agree to our terms and conditions to register in this site.'
            })
            return;
        }

        let data = new FormData();
        data.append('fname', fname);
        data.append('lname', lname);
        data.append('uname', uname);
        data.append('email', email);
        data.append('mobile', mobile);
        data.append('password', enc_pass);
        data.append('user_register', 'true');

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "c1") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Already Registerd Email',
                        html: "<b>" + email +
                            "</b> address is already registerd in our database"
                    })
                } else if (x.code === "c2") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Already Registerd Username',
                        html: "<b>" + uname +
                            "</b> is already registerd in our database"
                    })
                } else if (x.code === "c3") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Unexpected Error',
                        html: "Some unexpected error occured in the database. Try again!"
                    })
                } else if (x.code === "c4") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Registration Successfull',
                        html: "Welcome <b>" + x.name + "</b>!"
                    }).then(() => {
                        window.location = "./dashboard.php";
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