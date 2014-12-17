<?php
namespace WA\FlickrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HelloController extends Controller
{
    public function indexAction($name,$age)
    {
        $url=$this->generateUrl("wa_flickr_helloworld", array("name"=>"Kanita","age"=>"20"));
       return $this->render(
           "WAFlickrBundle:Hello:index.html.twig",
            array("name"=>$name,"age"=>$age,"url"=>$url));

    }
}



