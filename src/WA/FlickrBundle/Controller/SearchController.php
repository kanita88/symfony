<?php
namespace WA\FlickrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use WA\FlickrBundle\Infrastructure\FlickrService;
use WA\FlickrBundle\Infrastructure\FlickrPhoto;


class SearchController extends Controller
{
    private function createSearchForm()
    {
        return $this->createFormBuilder()
            ->add('tags','text')
            ->add('maximum','choice',['choices'=>[10=>10,20=>20,30=>30]])
            ->add('send','submit')
            ->getForm();

    }

    public function indexAction()
    {
        $searchForm=$this->createSearchForm();
        return $this->render('WAFlickrBundle:Search:index.html.twig',
            array('searchForm'=>$searchForm->createView()));
    }

    public function searchAction(Request $request)
    {
        $form=$this->createSearchForm();
        $form->handleRequest($request);
        $photos=array();
        if($form->isValid())
        {
            $formfields=$request->get('form');
            $flickrservice=new FlickrService();
            $photos=$flickrservice->searchPhotos($formfields['tags'],$formfields['maximum']);
        }

        return $this->render('WAFlickrBundle:Search:index.html.twig',
            array('searchForm'=>$form->createView(),
            'photos'=>$photos));
    }

    public function photomoreAction($farm,$id,$server,$secret)
    {
        $flickrservice=new FlickrService();
        $photosinfo=$flickrservice->getPhotoInfos($id,$secret);
        //var_dump($photosinfo);

       //créer un objet flickerphoto avec toutes les informations dont on dispose

        $image_obj=new FlickrPhoto($farm,$id,$secret,$server,"title");
        $image_obj->title = $photosinfo->photo->title->_content;
        $image_obj->description = $photosinfo->photo->description->_content;



        return $this->render('WAFlickrBundle:Search:photomore.html.twig',
            array('photo'=>$image_obj));



    }

    
}



