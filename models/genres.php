<?php
class Genres
{
    public $name;
    public $slug;
    public $origin_name;
    public $poster_url;
    public $thumb_url;
    public $year;

    public function __construct($name, $slug, $origin_name, $poster_url, $thumb_url, $year) {
        $this->name = $name;
        $this->slug = $slug;
        $this->origin_name = $origin_name;
        $this->poster_url = $poster_url;
        $this->thumb_url = $thumb_url;
        $this->year = $year;
    }

    static function getKinhDi() {
        require_once("models/cache.php");
        $cache = new Cache();
        $cacheKey = 'kinh_di_genre';
        $cacheExpiry = 3 * 24 * 60 * 60; // 3 days in seconds

        // Attempt to get data from cache
        $list = $cache->get($cacheKey);
        if ($list === null) {
            // Cache miss, fetch data from database
            $list = [];
            $db = DB::getInstance();
            $req = $db->query('SELECT * FROM kinh_di_genre');

            foreach ($req->fetchAll() as $item) {
                $list[] = new Genres($item['name'], $item['slug'], $item['origin_name'], $item['poster_url'], $item['thumb_url'], $item['year']);
            }

            // Store the data in cache
            $cache->set($cacheKey, $list, $cacheExpiry);
        }

        return $list;
    }
}
