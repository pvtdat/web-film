<?php
$slug = isset($_GET['slug']) ? $_GET['slug'] : '';
$api = API_KKPHIM::getInstance();
$response = $api->get_api_detail($slug);
if (is_string($response)) {
    $response_object = json_decode($response, true);
} else {
    $response_object = $response;
}

if (isset($response_object['movie']) && !empty($response_object['movie'])) {
    $movie = $response_object['movie'];
    $name = mb_strtoupper($movie['name'], 'UTF-8');
    $poster_url = $movie['poster_url'];
    $origin_name = $movie['origin_name'];
    $year = $movie['year'];
    $created = $movie['created']['time'];
    $date = new DateTime($created);
    $formatted_date = $date->format('d/m/Y');

    $category = $movie['category'];
    $category_names = array_map(function ($cat) {
        return $cat['name'];
    }, $category);
    $category_string = implode(', ', $category_names);

    $country = $movie['country'];
    $country_names = array_map(function ($cat) {
        return $cat['name'];
    }, $country);
    $country_string = implode(', ', $country_names);

    $actors = $movie['actor'];
    $actor_string = implode(", ", $actors);

    $directors = $movie['director'];
    $director_string = implode(", ", $directors);

    $time = $movie['time'];
    $vote_average = mt_rand(60, 100);
    $status = $movie['episode_current'];
    $overview = $movie['content'];
    if (isset($response_object['episodes'][0]['server_data']) && !empty($response_object['episodes'][0]['server_data'])) {
        $episodes = $response_object['episodes'][0]['server_data'];
        $video_film = $episodes[0]['link_embed'];
        $title_episodes = $episodes[0]['filename'];
    } else {
        header("Location: /web-film/?controller=pages&action=error_204");
        exit();
    }
} else {
    header("Location: /web-film/?controller=pages&action=error_400");
    exit();
}
?>
<div class="container">
    <div class="mt-4">
        <div class="video-container">
            <iframe id="video-player" width="100%" height="500" src="<?= $video_film ?>" title="Video Player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>

        <div class="mt-2 d-flex justify-content-between align-items-center">
            <a class="disabled genre-title text-left" id="episode-title" href=""><?= $title_episodes ?></a>
        </div>
        <div>
            <hr class="line">
        </div>

        <ul class="halim-list-eps">
            <?php foreach ($episodes as $index => $episode): ?>
                <li class="halim-episode">
                    <span class="halim-btn halim-btn-2 <?= $index == 0 ? 'active' : '' ?> halim-info-1-1 box-shadow"
                        data-episode="<?= $index + 1 ?>" data-position="<?= $index == 0 ? 'first' : 'not-first' ?>"
                        data-title="<?= $episode['filename'] ?>" data-embed="<?= $episode['link_embed'] ?>">
                        <?= $episode['name'] ?>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
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
                    <li class="mt-2"><strong>Đạo diễn: </strong><a class="sub-content"><?= $director_string ?></a></li>
                    <li class="mt-2"><strong>Diễn viên: </strong><a class="sub-content"><?= $actor_string ?></a></li>
                    <li class="mt-2"><strong>Trạng thái: </strong><a class="sub-content"><?= $status ?></a></li>
                    <li class="mt-2"><strong>Quốc gia: </strong><a class="sub-content"><?= $country_string ?></a></li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const episodeButtons = document.querySelectorAll('.halim-btn');
        const videoPlayer = document.getElementById('video-player');
        const episodeTitle = document.getElementById('episode-title');

        episodeButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                const embedUrl = event.target.getAttribute('data-embed');
                const title = event.target.getAttribute('data-title');
                const position = event.target.getAttribute('data-position');
                const episodeNumber = event.target.getAttribute('data-episode');

                // Update the iframe source
                videoPlayer.src = embedUrl;

                // Update the episode title
                episodeTitle.innerHTML = `${title}`;

                // Update the active class
                episodeButtons.forEach(btn => btn.classList.remove('active'));
                event.target.classList.add('active');

                // Disable the button to block further clicks
                event.target.style.pointerEvents = 'none';
            });
        });
    });
</script>