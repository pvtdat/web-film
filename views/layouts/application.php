<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <!-- Icon -->
    <link rel="icon" type="image/x-icon" href="/web-film/assets/image/img/logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
    <!-- CSS Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- JS Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
      crossorigin="anonymous"></script>

    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Josefin Sans' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Poetsen One' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Source Sans Pro' rel='stylesheet'>

    <!-- CSS Style -->
    <link rel="stylesheet" href="/web-film/assets/css/styles.css">
    <title>Movie Online</title>

    <!-- Nav bar -->
    <nav class="navbar navbar-expand-lg navbar-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="?controller=pages&action=home">
          <img style="border-radius: 15px;" src="https://media.giphy.com/media/WMob15P0h9O04LlqLo/giphy.gif"
            alt="DIT Logo" width="50" height="50">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
          aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
          <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="?controller=pages&action=home">Phim</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                Thể loại
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                <li><a class="dropdown-item" href="?controller=movie&action=kinhdi">Kinh dị</a></li>
                <li><a class="dropdown-item" href="?controller=movie&action=cartoon">Hoạt hình</a></li>
                <!-- <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li> -->
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown2" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">
                Quốc gia
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown2">
                <li><a class="dropdown-item" href="?controller=movie&action=viemovies">Việt Nam</a></li>
                <!-- <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item" href="#">Something else here</a></li> -->
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?controller=movie&action=newmovies">Phim hot</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?controller=movie&action=singlemovies">Phim lẻ mới</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?controller=movie&action=newseries">Phim bộ mới</a>
            </li>
          </ul>
          <form class="d-flex search-form" action="?controller=movie&action=searching" method="POST">
            <input class="form-control me-2" type="search" placeholder="Tìm phim" aria-label="Search" name="key">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav>
  </head>

  <body>
    <?= @$content ?>
  </body>

  <footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright footer-content text-center my-auto">
          <p>Copyright &copy; 2024 by <a href="">DatPham.Com</a></p> <span class="footer-space">|</span>
          <p>Vận hành bởi Dat Pham <i class="far fa-heart"></i></p>
        </div>
    </div>
  </footer>
</html>
<DOCTYPE html>