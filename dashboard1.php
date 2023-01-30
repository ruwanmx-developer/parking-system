<!DOCTYPE html>
<html lang="en">

<head>
    <title>User Dashboard</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="dashboard">
    <!-- include navigation -->
    <?php $page='dashboard';?>
    <?php include_once('./components/navigation.php');?>

    <!-- user validation -->
    <?php 
    if(array_key_exists('ses_role',$_SESSION)){
        if($_SESSION['ses_role'] != 2){
            header('location:./index.php');
        }
    } else {
        header('location:./index.php');
    }
    ?>

    <!-- pre validations -->
    <?php
     $_email = $_SESSION['ses_email'];
    
     $sql = "SELECT * FROM users WHERE email='$_email'";
     $result = $__conn->query($sql);
     $row = $result->fetch_assoc();
    ?>

    <!-- section 1 -->
    <section id="section-1">
        <div class="menu-list">
            <div>
                <a href="./dashboard1.php" class="btn-common">Edit Profile</a>
                <a href="./dashboard2.php" class="btn-common">View Released</a>
                <a href="./dashboard3.php" class="btn-common">View Active</a>
                <a href="./dashboard4.php" class="btn-common">Contact Admin</a>
            </div>
        </div>
        <div class="pwrap">
            <div class="partial">
                <div class="form-wrap">
                    <div class="title">EDIT PROFILE</div>
                    <div class="form-item-wrap">
                        <input type="text" class="inp-text" id="fname" placeholder="First Name"
                            autocomplete="new-password" value="<?php echo $row['first_name'];?>">
                    </div>
                    <div class="form-item-wrap">
                        <input type="text" class="inp-text" id="lname" placeholder="Last Name"
                            autocomplete="new-password" value="<?php echo $row['last_name'];?>">
                    </div>
                    <div class="form-item-wrap">
                        <input type="text" class="inp-text" id="uname" placeholder="User Name"
                            autocomplete="new-password" value="<?php echo $row['user_name'];?>">
                    </div>
                    <div class="form-item-wrap">
                        <input type="text" class="inp-text" id="mobile" placeholder="Phone Number"
                            autocomplete="new-password" value="<?php echo $row['mobile'];?>">
                    </div>
                    <div class="form-item-wrap">
                        <input type="password" class="inp-text" id="opassword" placeholder="Old Password"
                            autocomplete="new-password">
                    </div>
                    <div class="form-item-wrap">
                        <input type="password" class="inp-text" id="npassword" placeholder="New Password"
                            autocomplete="new-password">
                    </div>
                    <div class="form-item-wrap">
                        <input type="password" class="inp-text" id="cpassword" placeholder="Confirm Password"
                            autocomplete="new-password">
                    </div>
                    <div class="marg-b">
                        <button onclick="user_update()" class="btn btn-common w100">Update</button>
                    </div>

                </div>
            </div>
        </div>

    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>

    <!-- scripts -->
    <script>
    function user_update() {

        let fname = document.getElementById("fname").value;
        let lname = document.getElementById("lname").value;
        let uname = document.getElementById("uname").value;
        let mobile = document.getElementById("mobile").value;
        let opassword = document.getElementById("opassword").value;
        let npassword = document.getElementById("npassword").value;
        let cpassword = document.getElementById("cpassword").value;
        let enc_passn = md5(npassword);
        let enc_passo = md5(opassword);

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
        if (opassword === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter your old password to continue'
            })
            return;
        }
        if (npassword === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter a new password to continue'
            })
            return;
        }
        if (cpassword === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please confirm your new password to continue'
            })
            return;
        }
        if (cpassword !== npassword) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid Field',
                text: 'Passwords doesn\'t match'
            })
            return;
        }

        let data = new FormData();
        data.append('fname', fname);
        data.append('lname', lname);
        data.append('uname', uname);
        data.append('mobile', mobile);
        data.append('opassword', enc_passo);
        data.append('npassword', enc_passn);
        data.append('user_update', 'true');

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "c1") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid Password',
                        text: "Enter your correct old password to continue"
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
                        title: 'User Updated',
                        html: "User Data Updated sucessfully"
                    }).then(() => {
                        window.location = "./dashboard1.php";
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