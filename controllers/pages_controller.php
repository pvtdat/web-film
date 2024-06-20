<?php
require_once ('controllers/base_controller.php');
class PagesController extends BaseController
{
  function __construct()
  {
    $this->folder = 'pages';
  }

  public function home()
  {
    require_once ('models/poster.php');
    require_once ('models/genres.php');
    require_once ('models/api_phimkk.php');
    require_once ('models/api_tmdb.php');
    $api = API_KKPHIM::getInstance();
    $api2 = API_TMDB::getInstance();
    $posts = Poster::getPoster();
    $genre_kinh_di = Genres::getKinhDi();
    $response_object = $api2->get_api_list_new_movies('1');
    $response_object3 = $api->get_api_list_single_films()['data'];
    $response_object4 = $api->get_api_list_series_films()['data'];
    $response_object5 = $api->get_api_list_nobita_films()['data'];
    $response_object6 = $api->get_api_list_nga_re_tu_than_films()['data'];
    $response_object7 = $api->get_api_list_lat_mat_films()['data'];
    $response_object8 = $api->get_api_list_harry_potter_films()['data'];
    $data = array(
      'genre_kinh_di' => $genre_kinh_di,
      'posts' => $posts,
      'response_object' => $response_object,
      'response_object3' => $response_object3,
      'response_object4' => $response_object4,
      'response_object5' => $response_object5,
      'response_object6' => $response_object6,
      'response_object7' => $response_object7,
      'response_object8' => $response_object8
    );
    $this->render('home', $data);
  }

  public function error()
  {
    $this->render('error');
  }
}