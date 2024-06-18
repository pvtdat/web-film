<?php

class API_TMDB
{
    private static $instance = null;
    private $api_response_list_new_films = null;
    private $cache_dir = __DIR__ . '/cache/';

    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function cleanup_cache()
    {
        $ttl = 7 * 24 * 60 * 60;
        $files = glob($this->cache_dir . '*');

        foreach ($files as $file) {
            if (is_file($file) && (filemtime($file) < (time() - $ttl))) {
                unlink($file);
            }
        }
    }

    private function make_api_request($url, $query_fields)
    {
        $cache_key = md5($url . serialize($query_fields));
        $cache_file = $this->cache_dir . $cache_key;
        $ttl = 7 * 24 * 60 * 60;

        if (file_exists($cache_file) && (filemtime($cache_file) > (time() - $ttl))) {
            return json_decode(file_get_contents($cache_file), true);
        }

        $curl = curl_init($url . '?' . http_build_query($query_fields));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1NTg2OWQ3ZjljZGI4NjIyMzc4YWY1ZjY0MGVkMWY1ZCIsInN1YiI6IjY2NjA0YzgyMzk2OWVhNDA0ZGI3NDYyOSIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.PyzWXHzCKJ2AWBY9FaGEq6Ci-Ff8QA8-3dL9tOCyLFE',
            'accept: application/json'
        ]);

        $response_json = curl_exec($curl);
        
        if (curl_errno($curl)) {
            throw new Exception(curl_error($curl));
        }

        $http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        if ($http_code !== 200) {
            header("Location: /web-film/?controller=page&action=error_" . $http_code);
            exit();
        }

        curl_close($curl);

        $response_array = json_decode($response_json, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new Exception('Failed to decode JSON response: ' . json_last_error_msg());
        }

        // Save response to cache
        file_put_contents($cache_file, $response_json);

        return $response_array;
    }

    public function get_api_list_new_movies($page)
    {
        if ($this->api_response_list_new_films === null) {
            try {
                $url = 'https://api.themoviedb.org/3/movie/now_playing';
                $query_fields = [
                    'language' => 'vi-VI',
                    'page' => $page
                ];
                $this->api_response_list_new_films = $this->make_api_request($url, $query_fields);
            } catch (Exception $ex) {
                header("Location: /web-film/?controller=page&action=error_500");
                exit();
            }
        }
        return $this->api_response_list_new_films;
    }
}