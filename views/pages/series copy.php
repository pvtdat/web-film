<?php
    $api = API_KKPHIM::getInstance();
    // $url_src = $response_object['APP_DOMAIN_CDN_IMAGE'] . '/';
    $url_src = $response_object->APP_DOMAIN_CDN_IMAGE . '/';

?>



<body>
    <div class="header-container pt-3">
        <div class="title-event-wrapper">
            <div class="title-event">
                <h3 class="text-center"><strong>NEW MOVIES</strong></h3>
            </div>
        </div>
        <div class="search-container">
            <form method="POST" action="?controller=movie&action=searching&page=1" class="d-flex">
                <div class="input-group">
                    <input id="input_search" class="form-control" aria-describedby="button-addon2" type="text" placeholder="Search any movie ..." name="keyword">
                    <div class="input-group-append mr-3" style="height: 35px;">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2" style="font-size: 14px;">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <div id="carouselExampleControls" class="carousel slide mb-4" data-interval="false">
        <div class="carousel-inner">
            <?php foreach ($response_object['items'] as $index => $movie): ?>
                <?php if ($index % 5 === 0): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="row justify-content-center">
                <?php endif; ?>
                            <div class="col-6 col-md-4 col-lg-2 mt-4">
                                <div class="card" style="border-radius: 15px;">
                                    <img class="card-img-top" src="<?= $url_src . $movie['poster_url'] ?>" alt="<?= $movie['origin_name'] ?>" height="350px;">
                                    <div class="book-container">
                                        <div class="content">
                                            <a href="<?= '?controller=movie&action=filmwatching&slug=' . $movie['slug'] ?>"><button class="btn">Watch now</button></a>
                                        </div>
                                    </div>
                                    <div class="informations-container">
                                        <?php 
                                            $title = mb_convert_encoding($movie['name'], 'UTF-8');
                                            $title = mb_strtoupper($title, 'UTF-8');
                                            $year = $movie['year'];    
                                        ?>
                                        <h6 class="title-film mt-2"><?= $title ?></h6>
                                        <p class="sub-title-film mb-0"><small class="text-muted"><?= $year ?></small></p>
                                    </div>
                                </div>
                            </div>
                <?php if ($index % 5 === 4 || $index === count($response_object['items']) - 1): ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <a class="button button-1 mx-auto d-block mt-4" href="?controller=movie&action=newmovies&page=1">Show more</a>

    <div class="title-event pt-5">
        <h3 class="text-center"><strong>NEW SERIES</strong></h3>
    </div>
    
    <div id="carouselExampleControls2" class="carousel slide mb-4" data-interval="false">
        <div class="carousel-inner">
            <?php foreach ($response_object2['items'] as $index => $movie): ?>
                <?php if ($index % 5 === 0): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="row justify-content-center">
                <?php endif; ?>
                            <div class="col-6 col-md-4 col-lg-2 mt-4">
                                <div class="card" style="border-radius: 15px;">
                                    <img class="card-img-top" src="<?= $url_src . $movie['poster_url'] ?>" alt="<?= $movie['origin_name'] ?>" height="350px;">
                                    <div class="book-container">
                                        <div class="content">
                                            <a href="<?= '?controller=movie&action=filmwatching&slug=' . $movie['slug'] ?>"><button class="btn">Watch now</button></a>
                                        </div>
                                    </div>
                                    <div class="informations-container">
                                        <?php 
                                            $title = mb_convert_encoding($movie['name'], 'UTF-8');
                                            $title = mb_strtoupper($title, 'UTF-8');
                                            $year = $movie['year'];    
                                        ?>
                                        <h6 class="title-film mt-2"><?= $title ?></h6>
                                        <p class="sub-title-film mb-0"><small class="text-muted"><?= $year ?></small></p>
                                    </div>
                                </div>
                            </div>
                <?php if ($index % 5 === 4 || $index === count($response_object2['items']) - 1): ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    
        <a class="carousel-control-prev" href="#carouselExampleControls2" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls2" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <a class="button button-1 mx-auto d-block mt-4" href="?controller=movie&action=newseries&page=1">Show more</a>

    <div class="title-event pt-5">
        <h3 class="text-center"><strong>CARTOON</strong></h3>
    </div>
    
    <div id="carouselExampleControls3" class="carousel slide mb-4" data-interval="false">
        <div class="carousel-inner">
            <?php foreach ($response_object3['items'] as $index => $movie): ?>
                <?php if ($index % 5 === 0): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="row justify-content-center">
                <?php endif; ?>
                            <div class="col-6 col-md-4 col-lg-2 mt-4">
                                <div class="card" style="border-radius: 15px;">
                                    <img class="card-img-top" src="<?= $url_src . $movie['poster_url'] ?>" alt="<?= $movie['origin_name'] ?>" height="350px;">
                                    <div class="book-container">
                                        <div class="content">
                                            <a href="<?= '?controller=movie&action=filmwatching&slug=' . $movie['slug'] ?>"><button class="btn">Watch now</button></a>
                                        </div>
                                    </div>
                                    <div class="informations-container">
                                        <?php 
                                            $title = mb_convert_encoding($movie['name'], 'UTF-8');
                                            $title = mb_strtoupper($title, 'UTF-8');
                                            $year = $movie['year'];    
                                        ?>
                                        <h6 class="title-film mt-2"><?= $title ?></h6>
                                        <p class="sub-title-film mb-0"><small class="text-muted"><?= $year ?></small></p>
                                    </div>
                                </div>
                            </div>
                <?php if ($index % 5 === 4 || $index === count($response_object3['items']) - 1): ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    
        <a class="carousel-control-prev" href="#carouselExampleControls3" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls3" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <a class="button button-1 mx-auto d-block mt-4" href="?controller=movie&action=cartoon&page=1">Show more</a>
</body>