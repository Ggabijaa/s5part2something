<?php

namespace App\Form;

use App\Entity\Board;
use App\Entity\Category;
use App\Entity\Owner;
use App\Entity\Task;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class)
            ->add('owner', EntityType::class, [
                'class' => Owner::class,
                'choice_label' => 'name',
            ])
            ->add('board', EntityType::class, [
                'class' => Board::class,
                'choice_label' => 'name',
            ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    Task::STATUS_NOT_STARTED => Task::STATUS_NOT_STARTED,
                    Task::STATUS_IN_PROGRESS => Task::STATUS_IN_PROGRESS,
                    Task::STATUS_COMPLETED => Task::STATUS_COMPLETED,
                ]])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
            ])
            ->add('timeSpent', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('startDate', DateType::class, [
                'widget' => 'single_text'
            ])
            ->add('save', SubmitType::class, ['label' => 'Create Task']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
