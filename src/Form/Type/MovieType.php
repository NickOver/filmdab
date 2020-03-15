<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 15.03.2020
 * Time: 16:47
 */

namespace App\Form\Type;


use App\Entity\Director;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class MovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.name',
            ])
            ->add('release_date', DateType::class, [
                'label' => 'form.release_date',
                'years' => range(1950, date('Y')),
            ])
            ->add('director', EntityType::class, [
                'class' => Director::class,
                'choice_label' => 'name',
                'label' => 'form.director',
            ])
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'name',
                'label' => 'form.genre',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'form.save'
            ])
        ;
    }
}