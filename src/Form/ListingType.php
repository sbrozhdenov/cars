<?php

namespace App\Form;

use App\Entity\Listing;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ListingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mark', TextType::class, [
                'invalid_message' => 'Марката е задължителна',
            ])
            ->add('model', TextType::class, [
                'invalid_message' => 'Модела е задължителна',
            ])
            ->add('odometar', TextType::class, [
                'invalid_message' => 'Километража е задължителен',
            ])
            ->add('gear_box', TextType::class, [
                'invalid_message' => 'Скоростната кутия е задължителна',
            ])
            ->add('fuelf', TextType::class, [
                'invalid_message' => 'Горивото е задължително',
            ])
            ->add('owners', TextType::class, [
                'invalid_message' => 'Собственици е задълцително',
            ])
            ->add('horse_power', TextType::class, [
                'invalid_message' => 'Конски сили',
            ])
            ->add('year', TextType::class, [
                'invalid_message' => 'Година на производство',
            ])
            ->add('path', FileType::class, array(
                'multiple' => true,
                'data_class' => null,
            ))
            ->add('save', SubmitType::class);
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Listing::class,
        ]);
    }
}
