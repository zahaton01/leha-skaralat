<?php

namespace App\Form;

use App\Entity\CallBack;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', \Symfony\Component\Form\Extension\Core\Type\TextType::class, [ 'attr' => [
                'placeholder'=>'Ваше имя',
                'class'=> 'col-md-6 mb-3 mb-md-0'
                ],'label'=>'Имя'
            ])


            ->add('phone', TelType::class, [
                'attr' => ['placeholder' => 'Ваш номер телефона',
                    'class'=> 'col-md-6 mb-3 mb-md-0',
                    'type'=>'tel'
                ],'label' => 'Телефон'
            ])


            ->add('message', TextareaType::class, [ 'attr' => [
                'placeholder'=>'Введите сообщение',
                'rows'=>'7'
                ],'label' => 'Сообщение'

            ])
            ->add('submit', SubmitType::class, [
                'attr' => ['class' => 'btn btn-pill btn-primary btn-md text-white'],
                'label' => 'Отправить'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CallBack::class,
        ]);
    }
}
