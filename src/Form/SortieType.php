<?php

namespace App\Form;

use App\Entity\Sortie;
use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\IntegerType;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
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
            ->add('dateHeureDebut', DateType::class, [
                'label' => 'Date du début de la sortie',
            ])
            ->add('dateLimiteInscription' ,DateType::class,[
                'label' => 'date Limite d\'inscription'
            ])
            ->add('duree', IntegerType::class, [
                'label' => 'durée de la heure en H en min'
            ])
            ->add('nbInscriptionMax',IntegerType::class, [
                'label' => 'Nombre de participants maximum'
            ])
            ->add('infosSortie', TextType::class,[
                'label' => 'Descrition de l\'évènement'
                ])
            ->add('lieu')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class,
        ]);
    }
}
