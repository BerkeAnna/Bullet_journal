<?php

namespace App\Form;

use App\Entity\Habit;
use App\Entity\HabitTracker;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HabitTrackerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('habits', EntityType::class, [
                'class' => Habit::class,
                'multiple' => true,
                'choice_label' => 'name',
                'expanded' => true,
                'by_reference' => false,
                'attr' => [

                ]

            ])
//            ->add('completed', EntityType::class, [
//                'class' => HabitTracker::class,
//                'multiple' => true,
//                'expanded' => true,
//                'choice_label' => 'completed',
//                'by_reference' => false,
//                'attr' => [
//                    'class' => 'check-boxes'
//                ]
//
//            ])

            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn',
                ]
            ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => HabitTracker::class,
        ]);
    }
}
