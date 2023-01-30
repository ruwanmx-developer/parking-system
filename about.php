<!DOCTYPE html>
<html lang="en">

<head>
    <title>About</title>
    <?php include_once('./components/header.php');?>
</head>

<body id="about">
    <!-- include navigation -->
    <?php $page='about';?>
    <?php include_once('./components/navigation.php');?>

    <!-- section 1 -->
    <section id="section-1">
        <img src="./img/logow.png" class="logo">
        <div class="title"><span class="pri-text">A</span>uto<span class="pri-text">B</span>ooking.com
        </div>

        <div class="desc">Quickly design and customize responsive mobile-first sites with Bootstrap,
            the world’s most popular front-end open source toolkit, featuring Sass variables and mixins,
            responsive gridQuickly design and customize responsive mobile-first sites with Bootstrap, the
            world’s most popular front-end open source toolkit, featuring Sass variables and mixins,
            responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.
            system, extensive prebuilt components, and powerful JavaScript plugins.</div>
        <div class="user-wrap">
            <div class="partial">
                <img src="./img/4331014.png" alt="">
                <div class="name">Kanishka</div>
            </div>
            <div class="partial">
                <img src="./img/4333642.png" alt="">
                <div class="name">Himeth</div>
            </div>
            <div class="partial">
                <img src="./img/4333632.png" alt="">
                <div class="name">Wasana</div>
            </div>
            <div class="partial">
                <img src="./img/4333637.png" alt="">
                <div class="name">Randi</div>
            </div>
            <div class="partial">
                <img src="./img/4333649.png" alt="">
                <div class="name">Ravidi</div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <?php include_once('./components/footer.php');?>
</body>

</html>