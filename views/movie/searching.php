<?php
    $keyword = isset($_POST['key']) ? $_POST['key'] : '';
    $key = '""';
    if (!empty($keyword) && ctype_alnum($keyword)) {
        $key = htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8');
    }
    $api = API_KKPHIM::getInstance();
    $response_object = $api->get_api_list_search_films($keyword)['data'];
    $url_src = $response_object['APP_DOMAIN_CDN_IMAGE'];
?>

<div class="mt-2 pt-3 ps-4 d-flex justify-content-between align-items-center">
    <a class="disabled genre-title text-left" href="">Kết quả tìm kiếm cho: <?= $key ?></a>
</div>
<div class="ps-4 pe-4">
    <hr class="line">
</div>

<div>
    <?php
    $counter = 0;
    $max_items = 18;
    foreach ($response_object['items'] as $index => $movie):
        if ($index >= $max_items) {
            break;
        }
        if ($counter % 4 === 0):
            if ($counter > 0):
                echo '</div>';
            endif;
            echo '<div class="row justify-content-center">';
        endif;
        ?>
        <div class="mobile-card-list d-flex justify-content-center col-5 col-sm-2 col-md-2 col-lg-2 col-xl-2">
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
                        <a href="<?= '?controller=movie&action=watchingmovie&slug=' . $movie['slug'] ?>"><button
                                class="btn">Xem ngay</button></a>
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
        <?php
        $counter++;
    endforeach;
    if ($counter % 6 !== 0):
        echo '</div>';
    endif;
    ?>
</div>