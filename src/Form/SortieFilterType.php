<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\FilterSortie;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('campus', EntityType::class, [
                'class' => Campus::class,
                'choice_label' => 'nom',

            ])
            ->add('name', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                  'placeholder' => 'Rechercher le nom de la sortie ',

              ],
            ])
            ->add('dateMax',  DateType::class, [
                'widget' => 'single_text',
                'label' => "Date de début",
                'required' => false

            ])
            ->add('dateMin', DateType::class, [
                'widget' => 'single_text',
                'label' => "Date de fin",
                'required' => false
            ])
            ->add('organisateur', CheckboxType::class, [
                'label' => 'Sorties dont je suis l\'organisateur',
                'required' =>false,

            ])
            ->add('inscrit',  CheckboxType::class, [
                'label' => 'Sorties auxquelles je suis inscrit/e',
                'required' =>false,

            ])
            ->add('noInscrit', CheckboxType::class, [
                'label' => 'Sorties auxquelles je ne suis pas inscrit/e',
                'required' =>false,

            ])
            ->add('past', CheckboxType::class ,[
                'label' => 'Sorties passées',
                'required' =>false,

            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FilterSortie::class,

        ]);
    }
}
