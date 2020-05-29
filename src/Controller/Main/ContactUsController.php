<?php


namespace App\Controller\Main;

use App\Entity\Course;
use Symfony\Component\Routing\Annotation\Route;


class ContactUsController extends BaseController
{
    /**
     * @Route("/contact-us", name="contact_us")
     */
    public function index()
    {


        return $this->render('main/contact.html.twig');

    }


}