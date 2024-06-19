<?php
$api = API_KKPHIM::getInstance();
$response_object2 = $api->get_api_list_new_films('1');
$url_src = $response_object3['APP_DOMAIN_CDN_IMAGE'];
?>

<body>
  <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner p-2">
      <!-- The first slide -->
      <div class="carousel-item active">
        <img loading="lazy" class="d-block w-100" src="/web-film/assets/image/posters/<?= $posts[0]->image ?>"
          alt="<?= $posts[0]->name ?>" style="border-radius: 10px;">
      </div>
      <?php
      foreach ($posts as $key => $value) {
        if ($key > 0) {
          ?>
          <!-- The other slides -->
          <div class="carousel-item">
            <img class="d-block w-100" src="/web-film/assets/image/posters/<?= $value->image ?>" alt="<?= $value->name ?>">
          </div>
          <?php
        }
      }
      ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <!-- PHIM RẠP -->
  <div class="mt-2 pt-3 ps-4 d-flex justify-content-between align-items-center">
    <a class="genre-title text-left" href="?controller=movie&action=theatermovies">Phim chiếu rạp
      <i class="fas fa-angle-right"></i>
    </a>
    <div class="d-flex justify-content-end pe-4">
      <button class="btn-prev carousel-control-prev" type="button" data-bs-target="#carouselExampleControls2"
        data-bs-slide="prev">
        <span class="btn-prev-icon carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="btn-next carousel-control-next ms-2" type="button" data-bs-target="#carouselExampleControls2"
        data-bs-slide="next">
        <span class="btn-next-icon carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <div class="ps-4 pe-4">
    <hr class="line">
  </div>

  <div id="carouselExampleControls2" class="carousel slide mb-3 carousel-no-auto-slide">
    <div class="carousel-inner">
      <?php
      $max_items = 8;
      foreach ($response_object['results'] as $index => $movie):
        if ($index >= $max_items) {
          break;
        } ?>
        <?php if ($index % 4 === 0 && $index <= 8): ?>
          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="row justify-content-center">
            <?php endif; ?>
            <div class="mobile-card d-flex justify-content-center col-5 col-sm-2 col-md-2 col-lg-2 col-xl-2">
              <div class="card">
                <?php
                $movie_poster = $movie['poster_path'];
                if (empty($movie_poster)) {
                  $movie_poster = '/web-film/assets/image/img/img_not_available.jpg';
                } else {
                  $movie_poster = 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'];
                }
                $movie_origin_name = $movie['original_title'];
                if (empty($movie_origin_name)) {
                  $movie_origin_name = 'Unavailable';
                }
                ?>
                <img loading="lazy" class="card-img-top" src="<?= $movie_poster ?>" alt="<?= $movie_origin_name ?>">
                <div class="book-container">
                  <div class="content">
                    <a href="<?= '?controller=movie&action=filmdetail&id=' . $movie['id'] ?>">
                      <button class="btn">Trailer</button>
                    </a>
                  </div>
                </div>
                <div class="informations-container">
                  <?php
                  $title = mb_convert_encoding($movie['title'], 'UTF-8');
                  if (mb_strlen($title) > 28) {
                    $title = mb_substr($title, 0, 28) . '..';
                  }
                  $title = mb_strtoupper($title, 'UTF-8');
                  $releaseDate = $movie['release_date'];
                  $dateObject = new DateTime($releaseDate);
                  $formattedDate = $dateObject->format('d/m/Y');
                  ?>
                  <h6 class="title-film mt-2"><?= $title ?></h6>
                  <p class="sub-title-film mb-0"><small class="text-muted"><?= $formattedDate ?></small></p>
                </div>
              </div>
            </div>
            <?php if ($index % 4 === 3 || $index === count($response_object['results']) - 1): ?>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- PHIM MỚI -->
  <div class="mt-2 ps-4 d-flex justify-content-between align-items-center">
    <a class="genre-title text-left" href="?controller=movie&action=newmovies">Phim mới cập nhật
      <i class="fas fa-angle-right"></i>

    </a>
    <div class="d-flex justify-content-end pe-4">
      <button class="btn-prev carousel-control-prev" type="button" data-bs-target="#carouselExampleControls3"
        data-bs-slide="prev">
        <span class="btn-prev-icon carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="btn-next carousel-control-next ms-2" type="button" data-bs-target="#carouselExampleControls3"
        data-bs-slide="next">
        <span class="btn-next-icon carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <div class="ps-4 pe-4">
    <hr class="line">
  </div>

  <div id="carouselExampleControls3" class="carousel slide mb-3 carousel-no-auto-slide">
    <div class="carousel-inner">
      <?php
      $max_items = 8;
      foreach ($response_object2['items'] as $index => $movie):
        if ($index >= $max_items) {
          break;
        } ?>
        <?php if ($index % 4 === 0 && $index <= 8): ?>
          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="row justify-content-center">
            <?php endif; ?>
            <div class="mobile-card d-flex justify-content-center col-5 col-sm-2 col-md-2 col-lg-2 col-xl-2">
              <div class="card">
                <?php
                $movie_poster = $movie['poster_url'];
                if (empty($movie_poster)) {
                  $movie_poster = '/web-film/assets/image/img/img_not_available.jpg';
                }
                $movie_origin_name = $movie['origin_name'];
                if (empty($movie_origin_name)) {
                  $movie_origin_name = 'Unavailable';
                }
                ?>
                <img loading="lazy" class="card-img-top" src="<?= $movie_poster ?>" alt="<?= $movie_origin_name ?>">
                <div class="book-container">
                  <div class="content">
                    <a href="<?= '?controller=movie&action=filmwatching&slug=' . $movie['slug'] ?>">
                      <button class="btn">Xem ngay</button>
                    </a>
                  </div>
                </div>
                <div class="informations-container">
                  <?php
                  $title = mb_convert_encoding($movie['name'], 'UTF-8');
                  if (mb_strlen($title) > 28) {
                    $title = mb_substr($title, 0, 28) . '..';
                  }
                  $title = mb_strtoupper($title, 'UTF-8');
                  $year = $movie['year'];
                  ?>
                  <h6 class="title-film mt-2"><?= $title ?></h6>
                  <p class="sub-title-film mb-0"><small class="text-muted"><?= $year ?></small></p>
                </div>
              </div>
            </div>
            <?php if ($index % 4 === 3 || $index === count($response_object2['items']) - 1): ?>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- PHIM LẺ -->
  <div class="mt-2 ps-4 d-flex justify-content-between align-items-center">
    <a class="genre-title text-left" href="?controller=movie&action=singlemovies">Phim lẻ mới cập nhật
      <i class="fas fa-angle-right"></i>

    </a>
    <div class="d-flex justify-content-end pe-4">
      <button class="btn-prev carousel-control-prev" type="button" data-bs-target="#carouselExampleControls4"
        data-bs-slide="prev">
        <span class="btn-prev-icon carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="btn-next carousel-control-next ms-2" type="button" data-bs-target="#carouselExampleControls4"
        data-bs-slide="next">
        <span class="btn-next-icon carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <div class="ps-4 pe-4">
    <hr class="line">
  </div>

  <div id="carouselExampleControls4" class="carousel slide mb-3 carousel-no-auto-slide">
    <div class="carousel-inner">
      <?php
      $max_items = 8;
      foreach ($response_object3['items'] as $index => $movie):
        if ($index >= $max_items) {
          break;
        } ?>
        <?php if ($index % 4 === 0 && $index <= 8): ?>
          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="row justify-content-center">
            <?php endif; ?>
            <div class="mobile-card d-flex justify-content-center col-5 col-sm-2 col-md-2 col-lg-2 col-xl-2">
              <div class="card">
                <?php
                $movie_poster = $movie['poster_url'];
                if (empty($movie_poster)) {
                  $movie_poster = '/web-film/assets/image/img/img_not_available.jpg';
                } else {
                  $movie_poster = $url_src . '/' . $movie['poster_url'];
                }
                $movie_origin_name = $movie['origin_name'];
                if (empty($movie_origin_name)) {
                  $movie_origin_name = 'Unavailable';
                }
                ?>
                <img loading="lazy" class="card-img-top" src="<?= $movie_poster ?>" alt="<?= $movie_origin_name ?>">
                <div class="book-container">
                  <div class="content">
                    <a href="<?= '?controller=movie&action=filmwatching&slug=' . $movie['slug'] ?>">
                      <button class="btn">Xem ngay</button>
                    </a>
                  </div>
                </div>
                <div class="informations-container">
                  <?php
                  $title = mb_convert_encoding($movie['name'], 'UTF-8');
                  if (mb_strlen($title) > 28) {
                    $title = mb_substr($title, 0, 28) . '..';
                  }
                  $title = mb_strtoupper($title, 'UTF-8');
                  $year = $movie['year'];
                  ?>
                  <h6 class="title-film mt-2"><?= $title ?></h6>
                  <p class="sub-title-film mb-0"><small class="text-muted"><?= $year ?></small></p>
                </div>
              </div>
            </div>
            <?php if ($index % 4 === 3 || $index === count($response_object3['items']) - 1): ?>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- PHIM BỘ -->
  <div class="mt-2 ps-4 d-flex justify-content-between align-items-center">
    <a class="genre-title text-left" href="?controller=movie&action=newseries">Phim bộ mới cập nhật
      <i class="fas fa-angle-right"></i>

    </a>
    <div class="d-flex justify-content-end pe-4">
      <button class="btn-prev carousel-control-prev" type="button" data-bs-target="#carouselExampleControls5"
        data-bs-slide="prev">
        <span class="btn-prev-icon carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="btn-next carousel-control-next ms-2" type="button" data-bs-target="#carouselExampleControls5"
        data-bs-slide="next">
        <span class="btn-next-icon carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <div class="ps-4 pe-4">
    <hr class="line">
  </div>

  <div id="carouselExampleControls5" class="carousel slide mb-3 carousel-no-auto-slide">
    <div class="carousel-inner">
      <?php
      $max_items = 8;
      foreach ($response_object4['items'] as $index => $movie):
        if ($index >= $max_items) {
          break;
        } ?>
        <?php if ($index % 4 === 0 && $index <= 8): ?>
          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="row justify-content-center">
            <?php endif; ?>
            <div class="mobile-card d-flex justify-content-center col-5 col-sm-2 col-md-2 col-lg-2 col-xl-2">
              <div class="card">
                <?php
                $movie_poster = $movie['poster_url'];
                if (empty($movie_poster)) {
                  $movie_poster = '/web-film/assets/image/img/img_not_available.jpg';
                } else {
                  $movie_poster = $url_src . '/' . $movie['poster_url'];
                }
                $movie_origin_name = $movie['origin_name'];
                if (empty($movie_origin_name)) {
                  $movie_origin_name = 'Unavailable';
                }
                ?>
                <img loading="lazy" class="card-img-top" src="<?= $movie_poster ?>" alt="<?= $movie_origin_name ?>">
                <div class="book-container">
                  <div class="content">
                    <a href="<?= '?controller=movie&action=filmwatching&slug=' . $movie['slug'] ?>">
                      <button class="btn">Xem ngay</button>
                    </a>
                  </div>
                </div>
                <div class="informations-container">
                  <?php
                  $title = mb_convert_encoding($movie['name'], 'UTF-8');
                  if (mb_strlen($title) > 28) {
                    $title = mb_substr($title, 0, 28) . '..';
                  }
                  $title = mb_strtoupper($title, 'UTF-8');
                  $year = $movie['year'];
                  ?>
                  <h6 class="title-film mt-2"><?= $title ?></h6>
                  <p class="sub-title-film mb-0"><small class="text-muted"><?= $year ?></small></p>
                </div>
              </div>
            </div>
            <?php if ($index % 4 === 3 || $index === count($response_object4['items']) - 1): ?>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- DOREAMON -->
  <div class="mt-2 ps-4 d-flex justify-content-between align-items-center">
    <a class="genre-title text-left" href="?controller=movie&action=cartoon">Phim hoạt hình
      <i class="fas fa-angle-right"></i>

    </a>
    <div class="d-flex justify-content-end pe-4">
      <button class="btn-prev carousel-control-prev" type="button" data-bs-target="#carouselExampleControls6"
        data-bs-slide="prev">
        <span class="btn-prev-icon carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="btn-next carousel-control-next ms-2" type="button" data-bs-target="#carouselExampleControls6"
        data-bs-slide="next">
        <span class="btn-next-icon carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <div class="ps-4 pe-4">
    <hr class="line">
  </div>

  <div id="carouselExampleControls6" class="carousel slide mb-3 carousel-no-auto-slide">
    <div class="carousel-inner">
      <?php
      $max_items = 8;
      foreach ($response_object5['items'] as $index => $movie):
        if ($index >= $max_items) {
          break;
        } ?>
        <?php if ($index % 4 === 0 && $index <= 8): ?>
          <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
            <div class="row justify-content-center">
            <?php endif; ?>
            <div class="mobile-card d-flex justify-content-center col-5 col-sm-2 col-md-2 col-lg-2 col-xl-2">
              <div class="card">
                <?php
                $movie_poster = $movie['poster_url'];
                if (empty($movie_poster)) {
                  $movie_poster = '/web-film/assets/image/img/img_not_available.jpg';
                } else {
                  $movie_poster = $url_src . '/' . $movie['poster_url'];
                }
                $movie_origin_name = $movie['origin_name'];
                if (empty($movie_origin_name)) {
                  $movie_origin_name = 'Unavailable';
                }
                ?>
                <img loading="lazy" class="card-img-top" src="<?= $movie_poster ?>" alt="<?= $movie_origin_name ?>">
                <div class="book-container">
                  <div class="content">
                    <a href="<?= '?controller=movie&action=filmwatching&slug=' . $movie['slug'] ?>">
                      <button class="btn">Xem ngay</button>
                    </a>
                  </div>
                </div>
                <div class="informations-container">
                  <?php
                  $title = mb_convert_encoding($movie['name'], 'UTF-8');
                  if (mb_strlen($title) > 28) {
                    $title = mb_substr($title, 0, 28) . '..';
                  }
                  $title = mb_strtoupper($title, 'UTF-8');
                  $year = $movie['year'];
                  ?>
                  <h6 class="title-film mt-2"><?= $title ?></h6>
                  <p class="sub-title-film mb-0"><small class="text-muted"><?= $year ?></small></p>
                </div>
              </div>
            </div>
            <?php if ($index % 4 === 3 || $index === count($response_object5['items']) - 1): ?>
            </div>
          </div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</body>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var carousels = document.querySelectorAll('.carousel-no-auto-slide');
    carousels.forEach(function (carousel) {
      new bootstrap.Carousel(carousel, {
        interval: false
      });
    });
  });
</script>