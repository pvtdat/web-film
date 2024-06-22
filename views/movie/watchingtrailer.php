<?php
$movie_id = isset($_GET['id']) ? $_GET['id'] : '';
$api = API_TMDB::getInstance();
$movie = $api->get_api_detail_movie($movie_id);

if (isset($movie) && !empty($movie)) {
    $video_trailer = $api->get_api_video_movie($movie_id);
    if(isset($video_trailer) && !empty($video_trailer)) {
        $index =rand(0, count($video_trailer['results']) -1);
        if(isset($video_trailer['results'][$index])) {
            $video = $video_trailer['results'][$index]['key'];
        } else {
            $video_trailer2 = $api->get_api_video_movie_english($movie_id);
            $index =rand(0, count($video_trailer2['results']) -1);
            $video = $video_trailer2['results'][$index]['key'];
        }
    }
    $name = mb_strtoupper($movie['title'], 'UTF-8');
    $poster_url = 'https://image.tmdb.org/t/p/w500/' . $movie['poster_path'];
    $origin_name = $movie['original_title'];
    $created = $movie['release_date'];
    $date = new DateTime($created);
    $formatted_date = $date->format('d/m/Y');
    $year = $date->format('Y');

    $category = $movie['genres'];
    $category_names = array_map(function ($cat) {
        return $cat['name'];
    }, $category);
    $category_string = implode(', ', $category_names);

    $country = $movie['origin_country'];
    $country_names = implode(", ", $country);

    $time = $movie['runtime'] . ' phút';
    $vote_average = round($movie['vote_average']) * 10;
    $status = $movie['status'];
    $overview = $movie['overview'];
} else {
    echo "Movie data not found.";
}
?>
<div class="container">
    <div class="mt-4">
        <div class="video-container">
            <iframe id="video-player" width="100%" height="500" src="<?= 'https://www.youtube.com/embed/' . $video ?>" title="Video Player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>

        <div>
            <hr class="line">
        </div>

        
        <div class="row">
            <div class="col-12 col-xl-3 col-lg-3 col-md-4 col-sm-5 pb-4">
                <img class="mx-auto d-block" height="350" width="200" style="border-radius: 15px;" src="<?= $poster_url ?>" alt="<?= $origin_name ?>">
            </div>
            <div class="movie-description col-12 col-xl-9 col-lg-9 col-md-8 col-sm-7 pb-4">
                <ul>
                    <li>
                        <h1 style="font-family: 'Anton';"><strong><?= $name . ' (' . $year . ')' ?></strong></h1>
                    </li>
                    <li><?= $formatted_date ?> &bull; <?= $category_string ?> &bull; <?= $time ?></li>
                    <li class="d-flex align-items-center">
                        <div class="c100 p70 green m-2">
                            <span style="font-weight: bold;"><?= $vote_average . '%' ?></span>
                            <div class="slice">
                                <div class="bar"></div>
                                <div class="fill"></div>
                            </div>
                        </div>
                        <div class="user-score-container d-flex flex-column">
                            <div class="user-score-text">User</div>
                            <div class="user-score-text">Score</div>
                        </div>
                    </li>
                    <li class="mt-2">
                        <h5><strong>NỘI DUNG PHIM</strong></h5>
                        <p class="sub-content"><?= $overview ?></p>
                    </li>
                    <li class="mt-2"><strong>Tên phim gốc: </strong><a class="sub-content"><?= $origin_name ?></a></li>
                    <li class="mt-2"><strong>Trạng thái: </strong><a class="sub-content"><?= $status ?></a></li>
                    <li class="mt-2"><strong>Quốc gia: </strong><a class="sub-content"><?= $country_names ?></a></li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>