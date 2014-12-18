<?php
namespace WA\FlickrBundle\Infrastructure;


class FlickrService
{
    const API_KEY = '814772198ec9aa500687da8dcc184605';

    public function searchPhotos($tags,$maximum=10)
    {
        //1 creer url à appeler chez flikr
        //->api.flickr.com/rest....
        //2 recuperer les informations
        //3 parser les informations (json)
        //4 retourner les photos

        //http_build_query()

        $queryFields=array(
            'api_key'=> FlickrService::API_KEY,
            'format'=>'json',
            'method'=> 'flickr.photos.search',
            'nojsoncallback'=>true,
            'content_type'=>7,
            'per_page'=>$maximum,
            'tags'=>$tags,
        );
        $query="https://api.flickr.com/services/rest/?".http_build_query($queryFields);
        //var_dump($query);

        $content=file_get_contents($query);
        //var_dump($content);

        $content=json_decode($content);
        $images=array();

        foreach($content->photos->photo as $photo)
        {
            $image_obj=new FlickrPhoto($photo->farm,$photo->id,$photo->secret,$photo->server,$photo->title);
            array_push($images,$image_obj);
        }

            return $images;


    }
    public function getPhotoInfos($photoId,$secret)
    {
        //appeler API flickr pour obtenir des informations sur image (description+title)
        $queryFields=array(
            'api_key'=> FlickrService::API_KEY,
            'format'=>'json',
            'method'=> 'flickr.photos.getInfo',
            'nojsoncallback'=>true,
            'photo_id'=>$photoId,
            'secret'=>$secret,
        );

        $query="https://api.flickr.com/services/rest/?".http_build_query($queryFields);

        $content=file_get_contents($query);

        $content=json_decode($content);
        return $content;

    }
}