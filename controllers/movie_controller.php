<?php
require_once ('controllers/base_controller.php');
class MovieController extends BaseController
{
  function __construct()
  {
    $this->folder = 'movie';
  }

  public function theatermovies()
  {
    require_once ('models/api_tmdb.php');
    $this->render('theatermovies');
  }

  public function singlemovies()
  {
    require_once ('models/api_phimkk.php');
    $api = API_KKPHIM::getInstance();
    $response_object = $api->get_api_list_single_films()['data'];
    $data = array(
      'response_object'=> $response_object
    );
    $this->render('singlemovies', $data);
  }

  public function newseries()
  {
    require_once ('models/api_phimkk.php');
    $api = API_KKPHIM::getInstance();
    $response_object = $api->get_api_list_series_films()['data'];
    $data = array(
      'response_object'=> $response_object
    );
    $this->render('newseries', $data);
  }

  public function newmovies()
  {
    require_once ('models/api_phimkk.php');
    $this->render('newmovies');
  }

  public function cartoon()
  {
    require_once ('models/api_phimkk.php');
    $api = API_KKPHIM::getInstance();
    $response_object = $api->get_api_list_new_movies('1');
    $data = array(
      'response_object'=> $response_object
    );
    $this->render('cartoon', $data);
  }

  public function kinhdi()
  {
    require_once ('models/genres.php');
    $genre_kinh_di = Genres::getKinhDi();
    $data = array(
      'genre_kinh_di'=> $genre_kinh_di
    );
    $this->render('kinhdi', $data);
  }

  public function searching()
  {
    require_once ('models/api_phimkk.php');
    $this->render('searching');
  }

  public function watchingmovie()
  {
    require_once ('models/api_phimkk.php');
    $this->render('watchingmovie');
  }

  public function watchingtrailer()
  {
    require_once ('models/api_tmdb.php');
    $this->render('watchingtrailer');
  }
}