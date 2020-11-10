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
                'choice_label' => 'nomCampus',
                'label' => false,
                'placeholder' => 'Rechercher par campus',
            ])
            ->add('q', TextType::class, [
              'label' => false,
              'attr' => [
                  'placeholder' => 'Rechercher par mots...',
              ],
            ])
            ->add('dateStart',  DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy,MM,dd',
                'label' => "Date de début",
            ])
            ->add('organisateur', CheckboxType::class, [
                'label' => 'Sorties dont je suis l\'organisateur',

            ])
            ->add('inscrit',  CheckboxType::class, [
                'label' => 'Sorties auxquelles je suis inscrit/e',

            ])
            ->add('noInscrit', CheckboxType::class, [
                'label' => 'Sorties auxquelles je ne suis pas inscrit/e',
            ])
            ->add('duree', CheckboxType::class ,[
                'label' => 'Sorties passées',
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FilterSortie::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }
    public function getBlockPrefix()
    {
        return '';
    }
}
