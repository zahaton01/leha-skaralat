<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('author',TextType::class, [ 'attr' => [
        'placeholder'=>'Введите Имя',
                'class'=> 'col-md-6 mb-3 mb-md-0'
    ],'label' => 'Ваше имя'

    ])
            ->add('content', TextareaType::class, [ 'attr' => [
        'placeholder'=>'Введите комментарий',
        'rows'=>'7'
    ],'label' => 'Комментарий'

    ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
