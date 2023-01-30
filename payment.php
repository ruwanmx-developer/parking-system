<!DOCTYPE html>
<html lang="en">

<head>
    <title>Payment</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="booking">
    <!-- include navigation -->
    <?php include_once('./components/navigation.php');?>

    <!-- section 1 -->
    <section id="section-1">

        <div class="form-wrap">
            <div class="title">PAYMENT DETAILS</div>
            <div class="form-item-wrap">
                <label class="form-label mb-0 req">Card Holder's Name</label>
                <input type="text" class="form-control" id="cname" placeholder="S JOHN" autocomplete="new-email">
            </div>
            <div class="form-item-wrap">
                <label for="exampleDataList" class="form-label mb-0 req">Card Number</label>
                <input type="text" class="form-control" id="card_no" placeholder="4323 2342 3525 5869"
                    autocomplete="new-email">
            </div>
            <div class="form-item-wrap">
                <label for="exampleDataList" class="form-label mb-0 req">Expiry</label>
                <input type="text" class="form-control" id="expire" placeholder="MM/YY" autocomplete="new-email">
            </div>
            <div class="form-item-wrap">
                <label for="exampleDataList" class="form-label mb-0 req">CVC</label>
                <input type="text" class="form-control" id="cvc" placeholder="***" autocomplete="new-email">
            </div>
            <div class="form-item-wrap">
                <!-- <button onclick="user_login()" class="btn btn-common w-100">Proceed to payment</button> -->
                <button onclick="confirm_payment()" class="btn btn-common w100">Confirm
                    Booking</button>
            </div>

        </div>
    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>

    <!-- scripts -->
    <script>
    function confirm_payment() {

        let cname = document.getElementById("cname").value;
        let card_no = document.getElementById("card_no").value;
        let expire = document.getElementById("expire").value;
        let cvc = document.getElementById("cvc").value;

        if (cname === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter the card holder\'s name to continue'
            })
            return;
        }
        if (!(c_name_pattern.test(cname))) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid field',
                html: "<b>" + cname +
                    "</b> is not an valid card holder\'s name. Enter a valid card holder\'s name"
            })
            return;
        }
        if (card_no === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter the card no to continue'
            })
            return;
        }
        if (!(card_pattern.test(card_no))) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid field',
                html: "<b>" + card_no +
                    "</b> is not an valid card no. Enter a valid card no"
            })
            return;
        }
        if (expire === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter the card expire date to continue'
            })
            return;
        }
        if (!(expire_pattern.test(expire))) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid field',
                html: "<b>" + expire +
                    "</b> is not an valid expire date. Enter a valid expire date"
            })
            return;
        }
        if (cvc === "") {
            Swal.fire({
                icon: 'warning',
                title: 'Empty Field',
                text: 'Please enter the cvc no to continue'
            })
            return;
        }
        if (!(cvc_pattern.test(cvc))) {
            Swal.fire({
                icon: 'error',
                title: 'Invalid field',
                html: "<b>" + cvc +
                    "</b> is not an valid cvc no. Enter a valid cvc no"
            })
            return;
        }

        Swal.fire({
            icon: 'info',
            title: 'Confirm Payment',
            html: "You will be charge <b>Rs " + <?php echo $_POST['price'];?> +
                ".00</b> for your booking. Confirm and Pay.",
            showCancelButton: true,
            cancelButtonText: 'No, Cancel!',
            confirmButtonText: 'Yes, Confirm!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {


                let data = new FormData();
                data.append('slot', "<?php echo $_POST['slot']; ?>");
                data.append('floor', "<?php echo $_POST['floor']; ?>");
                data.append('plate_no', "<?php echo $_POST['v_no']; ?>");
                data.append('vehical_type', "<?php echo $_POST['v_type']; ?>");
                data.append('price', "<?php echo $_POST['price']; ?>");
                data.append('bday', "<?php echo $_POST['bday']; ?>");
                data.append('rday', "<?php echo $_POST['rday']; ?>");
                data.append('confirm_payment', 'true');

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
                                title: 'Booking Complete',
                                html: "You can park your vehical in your slot now."
                            }).then(() => {
                                window.location = "./index.php";
                            })
                        }
                    }
                };
                xhttp.open("POST", "./functions/functions.php", true);
                xhttp.send(data);
            }
        })

    }
    </script>
</body>

</html>