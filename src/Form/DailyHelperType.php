<?php

namespace App\Form;

use App\Entity\DailyHelper;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DailyHelperType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('date')
            ->add('completed')
            ->add('type')
            ->add('dailyNote')
            ->add('owner');

        parent::buildForm($builder, $options);
        if ($options['todo']) {
            $builder
                ->add('name', TextType::class, [
                    'attr' => [
                        'placeholder' => 'Add a new todo here',
                        'class' => 'text-input'
                    ],
                    'label' => false,

                ])
                ->add('submit', SubmitType::class)
                ->remove('description')
                ->remove('date')
                ->remove('completed')
                ->remove('type')
                ->remove('dailyNote')
                ->remove('owner');

        }

    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DailyHelper::class,
            'todo' => true
        ]);
    }
}
