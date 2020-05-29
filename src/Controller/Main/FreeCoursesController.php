<?php

namespace App\Controller\Main;

use App\Entity\Course;
use App\Form\CourseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FreeCoursesController extends AbstractController
{
    /**
     * @Route("/free-courses", name="free_courses")
     */
    public function index(EntityManagerInterface $em)
    {
       $courses = $em->getRepository(Course::class)->findBy(['type'=>'free'],['id'=>'DESC'], 8);


        return $this->render('main/free-courses.html.twig',[
            'recent_courses'=>$courses,
            'controller_name'=>'FreeCoursesController',
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
