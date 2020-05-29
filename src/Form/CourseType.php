<?php

namespace App\Form;

use App\Entity\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',  TextareaType::class, [ 'attr' => [
                'placeholder'=>'Введите название (до 255 символов)',
            ],'label' => 'Название курса'

            ])
            ->add('description', TextareaType::class, [ 'attr' => [
                'placeholder'=>'Введите краткое описание',
                'rows'=>'7'
            ],'label' => 'Краткое описание (до 255 символов)'

            ])
            ->add('content', TextareaType::class, [ 'attr' => [
                'placeholder'=>'Введите контент',
                'rows'=>'25'
            ],'label' => 'Полный контент'

            ])

            ->add('keywords', TextareaType::class, [ 'attr' => [
                'placeholder'=>'Введите ключевые слова',
                'rows'=>'2'
            ],'label' => 'Ключевые слова (до 255 символов) '

            ])
            ->add('youtube', TextareaType::class, [ 'attr' => [
                'placeholder'=>'Нужно ввести символы из ссылки на видео после v=  . Например, ссылка на видео https://www.youtube.com/watch?v=Vhly2OZqZ8E. Соответсвенно нужно ввести Vhly2OZqZ8E ',
                'rows'=>'2'
            ],'label' => 'Ccылка на видео ютуб'

            ])
            ->add('type',ChoiceType::class, [
                'choices'  => [
                    'Бесплатный' => 'free',
                    'Платный' => 'paid',
                ], 'label' => 'Тип курса'
            ])


//            ->add('created_at')
            ->add('imageFilename', FileType::class, [
                'label' => 'Картинка курса (Аватар)',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypesMessage' => 'Картинка должна быть в формате jpg или png',
                    ])
                ],
            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-pill btn-primary btn-md text-white'],
                'label' => 'Отправить'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
