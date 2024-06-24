<?php
class API_KKPHIM {
    private static $instance = null;
    private $api_response_list_new_films = null;
    private $api_response_list_single_film = null;
    private $api_response_list_single_films = null;
    private $api_response_list_series_film = null;
    private $api_response_list_series_films = null;
    private $api_response_list_nobita_films = null;
    private $api_response_list_harry_potter_films = null;
    private $api_response_list_lat_mat_films = null;
    private $api_response_list_nga_re_tu_than_films = null;
    private $api_response_list_search_films = null;
    private $api_response_list_cartoon = null;
    private $api_response_detail = null;
    private $cache_dir = __DIR__ . '/cache/';

    private function __construct() {}

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function cleanup_cache() {
        $ttl = 7 * 24 * 60 * 60;    
        $files = glob($this->cache_dir . '*');
    
        foreach ($files as $file) {
            if (is_file($file) && (filemtime($file) < (time() - $ttl))) {
                unlink($file);
            }
        }
    }

    private function make_api_request($url, $query_fields) {
        $cache_key = md5($url . serialize($query_fields));
        $cache_file = $this->cache_dir . $cache_key;
        $ttl = 3 * 24 * 60 * 60;
        
        // $this->cleanup_cache();

        if (file_exists($cache_file) && (filemtime($cache_file) > (time() - $ttl))) {
            return json_decode(file_get_contents($cache_file), true);
        }

        if (file_exists($cache_file)) {
            return json_decode(file_get_contents($cache_file), true);
        }

        $curl = curl_init($url . '?' . http_build_query($query_fields));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
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

    public function get_api_list_new_films($page) {
        if ($this->api_response_list_new_films === null) {
            try {
                $url = 'https://phimapi.com/danh-sach/phim-moi-cap-nhat';
                $query_fields = [
                    'page'=> $page
                ];
                $this->api_response_list_new_films = $this->make_api_request($url, $query_fields);
            } catch (Exception $ex) {
                header("Location: /web-film/?controller=page&action=error_500");
                exit();  
            }
        }
        return $this->api_response_list_new_films;   
    }

    public function get_api_list_single_films() {
        if ($this->api_response_list_single_film === null) {
            try {
                $url = 'https://phimapi.com/v1/api/danh-sach/phim-le';
                $this->api_response_list_single_film = $this->make_api_request($url, []);
            } catch (Exception $ex) {
                header("Location: /web-film/?controller=page&action=error_500");
                exit();  
            }
        }
        return $this->api_response_list_single_film;        
    }

    public function get_api_list_new_movies($page) {
        if ($this->api_response_list_single_films === null) {
            try {
                $url = 'https://phimapi.com/v1/api/danh-sach/phim-le';
                $query_fields = [
                    'page'=> $page
                ];
                $this->api_response_list_single_films = $this->make_api_request($url, $query_fields);
            } catch (Exception $ex) {
                header("Location: /web-film/?controller=page&action=error_500");
                exit();  
            }
        }
        return $this->api_response_list_single_films;        
    }

    public function get_api_list_series_films() {
        if ($this->api_response_list_series_film === null) {
            try {
                $url = 'https://phimapi.com/v1/api/danh-sach/phim-bo';
                $this->api_response_list_series_film = $this->make_api_request($url, []);
            } catch (Exception $ex) {
                header("Location: /web-film/?controller=page&action=error_500");
                exit();  
            }
        }
        return $this->api_response_list_series_film;        
    }

    public function get_api_list_new_series($page) {
        if ($this->api_response_list_series_films === null) {
            try {
                $url = 'https://phimapi.com/v1/api/danh-sach/phim-bo';
                $query_fields = [
                    'page'=> $page
                ];
                $this->api_response_list_series_films = $this->make_api_request($url, $query_fields);
            } catch (Exception $ex) {
                header("Location: /web-film/?controller=page&action=error_500");
                exit();  
            }
        }
        return $this->api_response_list_series_films;        
    }

    public function get_api_list_cartoon($page) {
        if ($this->api_response_list_cartoon === null) {
            try {
                $url = 'https://phimapi.com/v1/api/danh-sach/hoat-hinh';
                $query_fields = [
                    'page'=> $page
                ];
                $this->api_response_list_cartoon = $this->make_api_request($url, $query_fields);
            } catch (Exception $ex) {
                header("Location: /web-film/?controller=page&action=error_500");
                exit();  
            }
        }
        return $this->api_response_list_cartoon;        
    }

    public function get_api_list_nobita_films() {
        if ($this->api_response_list_nobita_films === null) {
            try {
                $url = 'https://phimapi.com/v1/api/tim-kiem';
                $query_fields = [
                    'keyword'=> 'nobita'
                ];
                $this->api_response_list_nobita_films = $this->make_api_request($url, $query_fields);
            } catch (Exception $ex) {
                header("Location: /web-film/?controller=page&action=error_500");
                exit();  
            }
        }
        return $this->api_response_list_nobita_films;        
    }

    public function get_api_list_harry_potter_films() {
        if ($this->api_response_list_harry_potter_films === null) {
            try {
                $url = 'https://phimapi.com/v1/api/tim-kiem';
                $query_fields = [
                    'keyword'=> 'harry potter va'
                ];
                $this->api_response_list_harry_potter_films = $this->make_api_request($url, $query_fields);
            } catch (Exception $ex) {
                header("Location: /web-film/?controller=page&action=error_500");
                exit();  
            }
        }
        return $this->api_response_list_harry_potter_films;        
    }

    public function get_api_list_lat_mat_films() {
        if ($this->api_response_list_lat_mat_films === null) {
            try {
                $url = 'https://phimapi.com/v1/api/tim-kiem';
                $query_fields = [
                    'keyword'=> 'lat mat'
                ];
                $this->api_response_list_lat_mat_films = $this->make_api_request($url, $query_fields);
            } catch (Exception $ex) {
                header("Location: /web-film/?controller=page&action=error_500");
                exit();  
            }
        }
        return $this->api_response_list_lat_mat_films;        
    }

    public function get_api_list_nga_re_tu_than_films() {
        if ($this->api_response_list_nga_re_tu_than_films === null) {
            try {
                $url = 'https://phimapi.com/v1/api/tim-kiem';
                $query_fields = [
                    'keyword'=> 'nga re tu than'
                ];
                $this->api_response_list_nga_re_tu_than_films = $this->make_api_request($url, $query_fields);
            } catch (Exception $ex) {
                header("Location: /web-film/?controller=page&action=error_500");
                exit();  
            }
        }
        return $this->api_response_list_nga_re_tu_than_films;        
    }

    public function get_api_list_search_films($keyword) {
        if ($this->api_response_list_search_films === null) {
            try {
                $url = 'https://phimapi.com/v1/api/tim-kiem';
                $query_fields = [
                    'keyword'=> $keyword
                ];
                $this->api_response_list_search_films = $this->make_api_request($url, $query_fields);
            } catch (Exception $ex) {
                header("Location: /web-film/?controller=page&action=error_500");
                exit();  
            }
        }
        return $this->api_response_list_search_films;        
    }

    public function get_api_detail($slug) {
        if ($this->api_response_detail === null) {
            try {
                $url = 'https://phimapi.com/phim/' . $slug;
                $this->api_response_detail = $this->make_api_request($url, []);
            } catch (Exception $ex) {
                header("Location: /web-film/?controller=page&action=error_500");
                exit();  
            }
        }
        return $this->api_response_detail;        
    }
}