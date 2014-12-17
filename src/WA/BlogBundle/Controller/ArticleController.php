<?php

namespace WA\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticleController extends Controller
{
    public function indexAction($article)
    {

        return $this->render('WABlogBundle:Blog:article.html.twig', array('article' => $article));
    }

    public function editAction($article)
    {

        return $this->render('WABlogBundle:Blog:edit.html.twig', array('article' => $article));
    }

    public function deleteAction($article)
    {

        return $this->render('WABlogBundle:Blog:delete.html.twig', array('article' => $article));
    }

    public function layoutAction($article)
    {

        return $this->render('WABlogBundle:Blog:layout.html.twig', array('article' => $article));
    }

    public function testAction($article)
    {

        return $this->render('WABlogBundle:Blog:test.html.twig', array('article' => $article));
    }



}
