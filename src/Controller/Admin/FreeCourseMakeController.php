<?php

namespace App\Controller\Admin;

use App\Entity\Course;
use App\Form\CourseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class FreeCourseMakeController extends AdminBaseController
{

    /**
     * @Route("/admin/free-courses", name = "admin_courses")
     * @return Response
     */
    public function index()
    {
        $courses = $this->getDoctrine()->getRepository(Course::class)->findBy([
            'type'=>'free'
        ]);
        $forRender = parent::renderDefault();
        $forRender['title'] = 'Бесплатные курсы';
        $forRender['courses'] = $courses;
        return $this->render('admin/courses.html.twig', $forRender);
    }

    /**
     * @param Request $request
     * @Route("/admin/course-create", name="free_course_make")
     */
    public function create(Request $request, SluggerInterface $slugger)
    {
        $course = new Course();
        $form=$this->createForm(CourseType::class, $course);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $imageFile = $form->get('imageFilename')->getData();
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);

                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('courseimages_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }

                $course->setImageFilename($newFilename);
            }

            $em= $this ->getDoctrine()->getManager();
            $course->setCreatedAt(new \DateTime('now'));


            $em->persist($course);
            $em->flush();
            return $this->redirectToRoute('free_course_make');
        }
        return $this->render('admin/free-course-make.html.twig',[
                'course_form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/admin/course/update/{course}", name="update_course")
     */
    public function update(Request $request, Course $course)
    {
        $form = $this->createForm(CourseType::class, $course, [
            'action' => $this->generateUrl('update_course', [
                'course' => $course->getId()
            ]),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $course = $form->getData();
            $course->setCreatedAt(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('admin_courses');
        }

        return $this->render('admin/free-course-make.html.twig',[
            'course_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/admin/course/delete/{course}", name="course_delete")
     */
    public function delete(Course $course)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($course);
        $em->flush();

        return $this->redirectToRoute('admin_courses');
    }


}
