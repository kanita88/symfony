<?php
namespace WA\FlickrBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class ContactController extends Controller
{
    private function createContactForm()
    {
        $formBuilder = $this->createFormBuilder();
        $formBuilder->add('firstname','text');
        $formBuilder->add('lastname','text');
        $formBuilder->add('email','email');
        $formBuilder->add('message','textarea');
        $formBuilder->add('send','submit');

        return $formBuilder->getForm();

    }

    public function indexAction()
    {
        #if($this->get('request')->getMethod()=="POST")#}

        $contactForm=$this->createContactForm();

        return $this->render('WAFlickrBundle:Contact:index.html.twig',array('contactForm'=>$contactForm->createView()));

    }

    public function saveAction(Request $request)
    {
        $form=$this->createContactForm();
        $form->handleRequest($request);
        if($form->isValid())
        {
            $formfields = $request->get('form');

            $message = \Swift_Message::newInstance()
                ->setSubject("formulaire de contact")
                ->setFrom($formfields['email'])
                ->setTo("kanitalim88@gmail.com")
                ->setBody($formfields['message']);
            $this->get('mailer')->send($message);

            $this->get('session')->getFlashBag()->add(
                'notice',
                'votre message a été envoyé'
            );

            //envoyer email
        }
        //rediger vers l'accueil (ou contact)
        return $this->redirect($this->generateUrl('wa_flickr_homepage'));

    }


}



