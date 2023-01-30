<!DOCTYPE html>
<html lang="en">

<head>
    <title>New Review</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="booking">
    <!-- include navigation -->
    <?php include_once('./components/navigation.php');?>

    <!-- user validation -->
    <?php 
    if(array_key_exists('ses_role',$_SESSION)){
        if($_SESSION['ses_role'] != 2){
            header('location:./reviews.php');
        }
    } else {
        header('location:./reviews.php');
    }
    ?>

    <!-- section 1 -->
    <section id="section-1">
        <div class="form-wrap">
            <div class="title">ADD A NEW REVIEW</div>
            <div class="form-item-wrap">
                <input type="text" class="inp-text" id="title" placeholder="Title" autocomplete="new-password">
            </div>
            <div class="form-item-wrap">
                <select class="inp-text" id="rate">
                    <option value="5">5</option>
                    <option value="4">4</option>
                    <option value="3">3</option>
                    <option value="2">2</option>
                    <option value="1">1</option>
                </select>
            </div>
            <div class="form-item-wrap">
                <textarea name="" id="desc" placeholder="Description"></textarea>
            </div>

            <div class="marg-b">
                <button onclick="add_review()" class="btn btn-common w100">SEND</button>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>


    <!-- scripts -->
    <script>
    function add_review() {

        let title = document.getElementById("title").value;
        let rate = document.getElementById("rate").value;
        let desc = document.getElementById("desc").value;

        if (title === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter a title to continue'
            })
            return;
        }
        if (desc === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter the card expire date to continue'
            })
            return;
        }
        let data = new FormData();
        data.append('title', title);
        data.append('rate', rate);
        data.append('desc', desc);
        data.append('add_review', 'true');

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
                        title: 'Rating Complete',
                        html: "Your rating has been updated successfully."
                    }).then(() => {
                        window.location = "./reviews.php";
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