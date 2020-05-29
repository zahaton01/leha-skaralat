<?php

namespace App\Controller\Main;

use App\Entity\Course;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PaidCoursesController extends AbstractController
{
    /**
     * @Route("/paid-courses", name="paid_courses")
     */
    public function index(EntityManagerInterface $em)
    {
        $courses = $em->getRepository(Course::class)->findBy(['type'=>'paid'],['id'=>'DESC'], 8);


        return $this->render('main/paid-courses.html.twig',[
            'recent_courses'=>$courses,
            'controller_name'=>'PaidCourseController',
        ] );
    }
    /**
     * @Route("/course/single/{course}", name="single_course")
     */
    public function single(Course $course)
    {
        $em = $this->getDoctrine()->getManager();

        return $this->render('main/course-single.html.twig', [
            'course' => $course,
        ]);
    }
}
