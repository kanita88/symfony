<?php

namespace WA\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BlogController extends Controller
{
    public function indexAction($page)
    {

        return $this->render('WABlogBundle:Blog:index.html.twig',array("page"=>$page));
    }


}
