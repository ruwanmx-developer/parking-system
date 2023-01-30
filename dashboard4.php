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
                    <div class="title">HELP</div>
                    <div class="form-item-wrap">
                        <input type="text" class="inp-text" id="title" placeholder="Title" autocomplete="new-password">
                    </div>
                    <div class="form-item-wrap">
                        <textarea name="" id="message" placeholder="Message"></textarea>
                    </div>

                    <div class="marg-b">
                        <button onclick="admin_contact()" class="btn btn-common w100">SEND</button>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>

    <!-- scripts -->
    <script>
    function admin_contact() {

        let title = document.getElementById("title").value;
        let message = document.getElementById("message").value;

        if (title === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter a title to continue'
            })
            return;
        }
        if (message === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter your message to continue'
            })
            return;
        }

        let data = new FormData();
        data.append('title', title);
        data.append('message', message);
        data.append('admin_contact', 'true');

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                let x = JSON.parse(xhttp.responseText);
                if (x.code === "c1") {
                    Swal.fire({
                        icon: 'error',
                        title: 'Unexpected Error',
                        html: "Some unexpected error occured in the database. Try again!"
                    })
                } else if (x.code === "c2") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Message Sent',
                        html: "Your message has deliverd to the admin. Wait before send another message!"
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