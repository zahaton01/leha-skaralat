<?php

namespace App\Controller\Main;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Comment;
use App\Entity\Course;
use Symfony\Component\HttpFoundation\Request;
use App\Form\CommentType;

class CommentController extends AbstractController
{
    /**
     * @Route("/comments/create/{course}", name="comment_create_form")
     */
    public function create(Request $request, Course $course)
    {
        $comment = new Comment();

        $form = $this->createForm(CommentType::class, $comment, [
            'action' => $this->generateUrl('comment_create_form', [
                'course' => $course->getId()
            ]),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setCreatedAt(new \DateTime('now'));
            $comment->setCourse($course);

            $em = $this->getDoctrine()->getManager();

            $em->persist($comment);
            $em->flush();

            return $this->redirectToRoute('single_course', ['course' => $course->getId()]);
        }

        return $this->render('comments/form.html.twig', [
            'form' => $form->createView(),
            'course' => $course
        ]);
    }

    /**
     * @Route("/comments/update/{course}/{comment}", name="comment_update_form")
     */
    public function update(Request $request, Course $course, Comment $comment)
    {
        $form = $this->createForm(CommentType::class, $comment, [
            'action' => $this->generateUrl('comment_update_form', [
                'course' => $course->getId(),
                'comment' => $comment->getId()
            ]),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comment = $form->getData();
            $comment->setUpdatedAt(new \DateTime('now'));

            $em = $this->getDoctrine()->getManager();
            $em->flush();

            return $this->redirectToRoute('single_course', ['course' => $course->getId()]);
        }

        return $this->render('comments/form.html.twig', [
            'form' => $form->createView(),
            'course' => $course
        ]);
    }

    /**
     * @Route("/comments/delete/{course}/{comment}", name="comment_delete")
     */
    public function delete(Course $course, Comment $comment)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($comment);
        $em->flush();

        return $this->redirectToRoute('single_course', ['course' => $course->getId()]);
    }
}

