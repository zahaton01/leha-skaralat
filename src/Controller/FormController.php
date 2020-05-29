<?php

namespace App\Controller;

use App\Entity\CallBack;
use App\Form\ContactType;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class FormController extends AbstractController
{
    /**
     * @Route("/contact-us", name="form")
     */
    public function index(Request $request)
    {
        $callback = new CallBack();
        $form=$this->createForm(ContactType::class, $callback);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $em= $this ->getDoctrine()->getManager();
            $em->persist($callback);
            $em->flush();
            return $this->redirectToRoute('contact_us');
        }

        return $this->render('main/contact.html.twig', [
            'contact_form' => $form->createView()
        ]);
    }
}
