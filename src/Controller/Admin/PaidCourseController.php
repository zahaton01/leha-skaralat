<?php

namespace App\Controller\Admin;

use App\Entity\Course;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class PaidCourseController extends AdminBaseController
{

    /**
     * @Route("/admin/paid-courses", name = "admin_paid_courses")
     * @return Response
     */
    public function index()
    {
        $courses = $this->getDoctrine()->getRepository(Course::class)->findBy([
            'type'=>'paid'
        ]);
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Платные курсы';
        $forRender['courses'] = $courses;
        return $this->render('admin/paid-courses.html.twig', $forRender);
    }


}