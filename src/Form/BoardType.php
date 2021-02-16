<?php

namespace App\Form;

use App\Entity\Board;
use App\Entity\Category;
use App\Entity\Owner;
use App\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BoardType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('name', TextType::class)
            ->add('users', EntityType::class, [
                'class' => Owner::class,
                'multiple' => true,
               // 'expanded' => true,
            ])
            ->add('tasks', EntityType::class, [
                'class' => Task::class,
                'multiple' => true,
                //'expanded' => true,
                'choice_label' => 'title'
            ])
            ->add('save', SubmitType::class, ['label' => 'Create Board'])
            ->setMethod('GET')
            ->getForm();
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Board::class,
        ]);
    }
}
