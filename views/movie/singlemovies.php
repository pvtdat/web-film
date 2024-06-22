<?php
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $api = API_KKPHIM::getInstance();
    $response_object = $api->get_api_list_new_movies($page)['data'];
    $url_src = $response_object['APP_DOMAIN_CDN_IMAGE'];
?>

<div class="title my-5">
    <h1 class="text-center"><strong>PHIM LẺ MỚI</strong></h1>
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

<?php
function createPaginationButtons($totalPages, $currentPage)
{
    if ($totalPages < 2) {
        return '';
    }
    $pagination = '<div class="pagination">';
    // Nút Previous
    if ($currentPage > 1) {
        $pagination .= '<button class="prev" onclick="goToPage(' . ($currentPage - 1) . ')">Previous</button>';
    }
    // 3 trang đầu tiên
    for ($i = 1; $i <= min(3, $totalPages); $i++) {
        if ($i == $currentPage) {
            $pagination .= '<button class="page active">' . $i . '</button>';
        } else {
            $pagination .= '<button class="page" onclick="goToPage(' . $i . ')">' . $i . '</button>';
        }
    }

    // Dấu ba chấm trước phần giữa
    if ($currentPage > 4) {
        $pagination .= '<span class="dots" style="color: #ffffff;">...</span>';
    }
    // Tính toán vị trí bắt đầu và kết thúc của phần giữa
    $start = max(4, $currentPage - 1);
    $end = min($totalPages - 3, $currentPage + 1);
    // Điều chỉnh để đảm bảo luôn có 3 nút ở giữa
    if ($currentPage <= 4) {
        $start = 4;
        $end = min($totalPages - 3, 6);
    } elseif ($currentPage >= $totalPages - 3) {
        $start = max(4, $totalPages - 5);
        $end = $totalPages - 3;
    }
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $currentPage) {
            $pagination .= '<button class="page active">' . $i . '</button>';
        } else {
            $pagination .= '<button class="page" onclick="goToPage(' . $i . ')">' . $i . '</button>';
        }
    }
    // Dấu ba chấm sau phần giữa
    if ($currentPage < $totalPages - 4) {
        $pagination .= '<span class="dots" style="color: #ffffff;">...</span>';
    }
    // 3 trang cuối cùng
    for ($i = max($totalPages - 2, 4); $i <= $totalPages; $i++) {
        if ($i == $currentPage) {
            $pagination .= '<button class="page active">' . $i . '</button>';
        } else {
            $pagination .= '<button class="page" onclick="goToPage(' . $i . ')">' . $i . '</button>';
        }
    }
    // Nút Next
    if ($currentPage < $totalPages) {
        $pagination .= '<button class="next" onclick="goToPage(' . ($currentPage + 1) . ')">Next</button>';
    }
    $pagination .= '</div>';
    return $pagination;
}

echo '<script>
        function goToPage(pageNumber) {
            window.location.href = "?controller=movie&action=singlemovies&page=" + pageNumber;
        }
        </script>';

    $totalPages = $response_object['params']['pagination']['totalPages'] ?? 1;
    $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;
    echo createPaginationButtons($totalPages, $currentPage);
?>