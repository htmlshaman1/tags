<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use App\Entity\Tag;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\ArticleType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class TagController extends AbstractController
{

   /**
     * @Route("/", name="index")
     */
    public function index(Request $request)
    {
        $form = $this->createForm(ArticleType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
          $article = $form->getData();
          $dbh = $this->getDoctrine()->getManager();
          $dbh->persist($article);
          $dbh->flush();
          return new Response('You did it mate');      
        }
        return $this->render('index.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/tag", name="tag")
     */
    public function tindex()
    {
       $tag = new Tag();
       $tag->setName('mt1850');
       
       $article = new Article();
       $article->setBody('I farted');
       $article->addTag($tag);
       
       $em = $this->getDoctrine()->getManager();
       $em->persist($tag);
       $em->persist($article);
       $em->flush();
    }
}
