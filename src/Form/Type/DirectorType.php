<?php
/**
 * Created by PhpStorm.
 * User: Piotr
 * Date: 15.03.2020
 * Time: 16:07
 */

namespace App\Form\Type;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class DirectorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'form.name',
            ])
            ->add('surname', TextType::class, [
                'label' => 'form.surname',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'form.save'
            ])
        ;
    }
}