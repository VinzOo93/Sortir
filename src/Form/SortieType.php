<?php

namespace App\Form;

use App\Entity\AddSortie;
use App\Entity\Lieu;
use App\Entity\Ville;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class SortieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de la sortie',
                ])
            ->add('dateDebut', DateTimeType::class, [
                'label' => 'Date du début de la sortie',
            ])
            ->add('dateLimInscr' ,DateType::class,[
                'label' => 'date Limite d\'inscription'
            ])
            ->add('placeMax', IntegerType::class, [
                'label' => 'Nombre de participants maximum'
            ])
            ->add('duree', IntegerType::class, [
                'label' => 'Durée en min'
            ])
            ->add('infos', TextType::class,[
                'label' => 'Descrition de l\'évènement'
                ])
            ->add('ville', EntityType::class, [
                'class' => Ville::class,
                'choice_label' => 'nom',
            ])
            ->add('lieu', EntityType::class, [
                'class' => Lieu::class,
                'choice_label' => 'nom',
            ])
            ->add('latitue', null, [
                'label' => 'latitude',
                'required' => false,

            ])
            ->add('longitude',null,[
                'label' => 'longitude',
                'required' => false,
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AddSortie::class,
        ]);
    }
}
