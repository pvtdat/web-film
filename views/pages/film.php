<?php 
   
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/film.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <div class="sub-header p-2">
        <ul class="nav justify-content-end">
            <li class="nav-item my-auto"><a href="login.php">Login</a></li>/
            <li class="nav-item my-auto"><a href="register.php">Register</a></li>
            <li class="nav-item my-auto mx-3"><a href="my_ticket.php">My Tickets</a></li>
    <?php 
        if (!empty($user_name)) {
    ?>
            <li class="nav-item my-auto mr-2" style="color:black;"><strong>Hello </strong><a href="information.php"><?= $user_name ?></a></li>
            <a href="account/logout.php"><i class="bi bi-power" style="font-size: 18px;"></i></a>
    <?php
        }
    ?>
        </ul>
    </div>

    <div class="container-fluid main-header pl-4">
        <div class="row">
            <a class="col-xl-1 col-md-1 col-sm-1 col-xs-1 navbar-brand mr-5" href="home.php">
                <img src="https://www.cgv.vn/skin/frontend/cgv/default/images/cgvlogo.png" alt="CGV Cinema">
            </a>
            
            <ul class="col-xl-8 col-md-7 col-sm-6 col-xs-5 nav justify-content-center">
                <li class="nav-item my-auto mx-2"><a href="theater_system.php">THEATERS</a></li>
                <li class="nav-item my-auto mx-4" style="color: rgb(129, 129, 129);">|</li>
                <li class="nav-item my-auto mx-2"><a href="film.php">MOVIES</a></li>
                <li class="nav-item my-auto mx-4" style="color: rgb(129, 129, 129);">|</li>
                <li class="nav-item my-auto mx-2"><a href="promotion.php">PROMOTION</a></li>
            </ul>
                
            <a class="col-xl-1 col-md-1 col-sm-1 col-xs-1 navbar-brand" href="#">
                <img src="https://www.cgv.vn/media/wysiwyg/2019/AUG/kenhcine.gif" alt="Cine">
            </a>
        
            <a class="col-xl-1 col-md-1 col-sm-1 col-xs-1 navbar-brand" href="#">
                <img src="https://www.cgv.vn/media/wysiwyg/news-offers/mua-ve_ngay.png" alt="Sale Ticket">
            </a>
        </div>
    </div>

    <hr class="mt-1 mb-0">
    
    <div class="tilte-film" style="background-color: #EFEBDB;">
        <h5 class="text-center my-auto pt-2 pb-2"><strong>MOVIES</strong></h5>
    </div>
</head>

<body>
    <div class="container-fluid film text-center pt-4" id="Offer">
        <p>
            <button class="button-film now-film mx-auto" data-toggle="collapse" data-target="#Choice1" aria-controls="Choice1">Now Showing</button>
            <button class="button-film future-film" data-toggle="collapse" data-target="#Choice2" aria-controls="Choice2">Coming Soon</button>
        </p>
        <div class="collapse multi-collapse mt-4" id="Choice1" data-parent="#Offer">
            <div class="grid-wrap">
                <?php 
                    foreach($now_films as $f) {
                ?>
                    <div class="tall">
                        <ul>
                            <li class="booking-card" style="background-image: url(image/now_films/<?= $f['image'] ?>);">                        
                                <div class="book-container">
                                    <div class="content">
                                        <a href="http://<?= $server_host ?>/booking.php?title_movie=<?= $f['name']?>"><button class="btn mx-3 booking-ticket">Booking</button></a>
                                        <a href="now_film/<?= $f['detail'] ?>"><button class="btn">Detail</button></a>
                                    </div>
                                </div>
                                <div class="informations-container">
                                    <h2 class="title"><?= $f['name'] ?></h2>
                                    <p class="sub-title" style="font-size: 14px;"><?= $f['time'] ?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
                <?php
                    }
                ?>
            </div> 
        </div>  
        <div class="collapse multi-collapse" id="Choice2" data-parent="#Offer">
            <div class="grid-wrap">    
            <?php 
                foreach($future_films as $f) {
            ?>         
                    <div class="tall">
                        <ul>
                            <li class="booking-card" style="background-image: url(image/future_films/<?= $f['image'] ?>);">                        
                                <div class="book-container">
                                    <div class="content">
                                        <!-- <button class="btn mx-3">Đặt vé</button> -->
                                        <a href="future_film/<?= $f['detail'] ?>"><button class="btn">Detail</button></a>
                                    </div>
                                </div>
                                <div class="informations-container">
                                    <h2 class="title"><?= $f['name'] ?></h2>
                                    <p class="sub-title" style="font-size: 14px;"><?= $f['time'] ?></p>
                                </div>
                            </li>
                        </ul>
                    </div>
            <?php
                }
            ?>
            </div>
        </div>
    </div>

    <hr class="mt-1 mb-0">
</body>

<footer>
    <div class="container-fluid content-footer">
        <div class="row">
            <div class="col-xl-2 col-md-2 col-sm-12">
                <a href="home.php">
                    <img class="mx-auto d-block" height="150" width="150" src="image/logo/cgv-footer.png" alt="CGV Cinemas logo">
                </a>
            </div>
            <div class="col-xl-10 col-md-10 col-sm-12">
                <ul style="color: gray; font-size: 14px;">
                    <li><strong>COMPANY CJ CGV VIETNAM</strong></li>
                    <li>Business registration certificate: 0303675393, registered for the first time on 31/7/2008,issued by HCMC Department of Planning and Investment.</li>
                    <li>Address: Floor 2, Rivera Park Saigon - No. 7/28 Thanh Thai street, Ward 14, District 10, HCMC.</li>
                    <li>Hotline: 1900 9999</li>
                    <li>COPYRIGHT &copy; 2023 CJ CGV - TeamDC</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer"></div>
</footer>
</html>