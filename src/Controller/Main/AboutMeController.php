<?php


namespace App\Controller\Main;
use Symfony\Component\Routing\Annotation\Route;

class AboutMeController extends BaseController
{
    /**
     * @Route("/about", name="about_me")
     */
    public function index(){
        return $this->render('main/about.html.twig');

    }

}