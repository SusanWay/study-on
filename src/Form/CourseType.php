<?php

namespace App\Form;

use App\Entity\Course;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('character_code', TextType::class, [
                'label' => 'Символьный код',
                'required' => true,
                'empty_data' => '',
                'constraints' => [
                    new Length(['max'=>255, 'maxMessage' => 'Символьный код должен быть не более 255 символов']),
                    new NotBlank(['message' => 'Поле не должно быть пустым!'])],
                ],
            )
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Название',
                'constraints' => [new Length(['min' => 3, 'max'=>255, 'maxMessage' => 'Название должно быть не более 255 символов']),
                    new NotBlank(['message' => 'Поле не должно быть пустым!'])],
                'attr' => ['class ' => 'form-control']
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Описание',
                'attr' => ['class ' => 'form-control'],
                'constraints' => [
                    new Length(['max'=>1000, 'maxMessage' => 'Описание должно быть не более 1000 символов']),
                    new NotBlank(['message' => 'Поле не должно быть пустым!'])],
                ])
            ->add('image', TextareaType::class, [
                'label' => 'Картинка',
                'attr' => ['class ' => 'form-control']])
        ;
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Course::class,
        ]);
    }
}
