<?php

namespace App\Form;

use App\Entity\AddSortie;
use App\Entity\Lieu;
use App\Entity\Sortie;
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
            ->add('dateHeureDebut', DateTimeType::class, [

                'widget' => 'single_text',
                'label' => 'Date du début de la sortie',
            ])
            ->add('dateLimiteInscription' ,DateType::class,[
                'widget' => 'single_text',
                'label' => 'date Limite d\'inscription'
            ])
            ->add('nbInscriptionMax', IntegerType::class, [
                'label' => 'Nombre de participants maximum'
            ])
            ->add('duree', IntegerType::class, [
                'label' => 'Durée en min'
            ])
            ->add('infosSortie', TextType::class,[
                'label' => 'Descrition de l\'évènement'
                ])
            ->add('lieu', EntityType::class, [
                'class' => Lieu::class,
                'choice_label' => 'nom',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
