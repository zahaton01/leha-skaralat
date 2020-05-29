<?php

namespace App\Controller\Main;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Course;

class CourseSingleController extends AbstractController
{
    /**
     * @Route("/course-single", name="course_single")
     */
    public function index(Course $course)
    {
        $posts = $this->manager->em()->getRepository(Course::class)->search();

        return $this->render('course-single.html.twig', [
            'course'=>$course,
        ]);
    }
}
