<?php

namespace App\Form;

use App\Entity\Lesson;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;



class LessonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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
            ->add('lesson_number', IntegerType::class, [
                'required' => true,
                'label' => 'Номер урока',
                'attr' => ['class ' => 'form-control mb-2'],
                'constraints' => [
                    new NotBlank(['message' => 'Поле не должно быть пустым!'])],
            ])
            ->add('id_course', HiddenType::class, [
                'data' => null,
                'disabled' => true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Lesson::class,
        ]);
    }
}
