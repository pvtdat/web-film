<?php
class Poster
{
    public $name;
    public $image;
    public $position;

    function __construct($name, $image, $position)
    {
        $this->name = $name;
        $this->image = $image;
        $this->position = $position;
    }

    static function getPoster()
    {
        $list = [];
        $db = DB::getInstance();
        $req = $db->query('SELECT * FROM poster');

        foreach ($req->fetchAll() as $item) {
            $list[] = new Poster($item['name'], $item['image'], $item['position']);
        }

        return $list;
    }
}