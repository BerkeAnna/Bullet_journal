<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\BookCategory;
use App\Entity\BookTag;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('author', TextType::class)
            ->add('title', TextType::class)
            ->add('opinion', TextType::class)
            ->add('stars', ChoiceType::class,[

                'attr' => [
                    'class' => 'date-input ps-2 pt-1 pb-1 bg-black text-light'
                ],
                'choices' => [
                    '5' => 5,
                    '4.5' => 4.5,
                    '4' => 4,
                    '3.5' => 3.5,
                    '3' => 3,
                    '2.5' => 2.5,
                    '2' => 2,
                    '1.5' => 1.5,
                    '1' => 1,
                    '0.5' => 0.5,
                ]
            ])
            ->add('startDate', DateType::class, [
                'data' => new DateTime('now'),
                'attr' => [
                    'class' => 'date-input ps-2 pt-1 pb-1 '
                ]
            ])
            ->add('endDate', DateType::class, [
                'data' => new DateTime('now'),
                'attr' => [
                    'class' => 'date-input ps-2 pt-1 pb-1'
                ]
            ])
            ->remove('tags', EntityType::class, [
                'class' => BookTag::class,
            ])
            ->remove('category', EntityType::class, [
                'class' => BookCategory::class,
            ])
            ->remove('readingTracker')
            ->remove('owner')
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
