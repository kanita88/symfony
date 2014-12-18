<?php
namespace WA\FlickrBundle\Infrastructure;


class FlickrPhoto
{

    public $description;
    public $farm;
    public $id;
    public $secret;
    public $server;
    public $title;

    public function __construct($farm,$id,$secret,$server,$title)
    {
        $this->farm=$farm;
        $this->id=$id;
        $this->secret=$secret;
        $this->server=$server;
        $this->title=$title;
        $this->description=null;
    }

    public function getUrl()
    {
        $image_url = "https://farm{$this->farm}.staticflickr.com/{$this->server}/{$this->id}_{$this->secret}_m.jpg";
        return $image_url;
    }

    public function getBigUrl()
    {
        $image_url = "https://farm{$this->farm}.staticflickr.com/{$this->server}/{$this->id}_{$this->secret}_z.jpg";
        return $image_url;
    }




}

