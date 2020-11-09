<?php

namespace App\Form;

use App\Entity\Campus;
use App\Entity\Sortie;
use App\Entity\User;
use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SortieFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('campus', Entity::class, [
                'class' => Campus::class,
                'choice_Label' => 'nomCampus',
                'label' => false,
                'placeholder' => 'Rechercher par campus',
                'required' => false,

            ])
            ->add('q', TextType::class, [
              'label' => false,
              'required' => false,
              'attr' => [
                  'placeholder' => 'Rechercher par mots...',
              ],

            ])
            ->add('dateStart',  DateType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy,MM,dd',
                'required' => false,
                'label' => "Date de début",
            ])
            ->add('organisateur', CheckboxType::class, [
                'label' => 'Sorties dont je suis l\'organisateur',
                'required' => false,

            ])
            ->add('inscrit',  CheckboxType::class, [
                'label' => 'Sorties auxquelles je suis inscrit/e',
                'required' => false,


            ])
            ->add('inscrit', CheckboxType::class, [
                'label' => 'Sorties auxquelles je ne suis pas inscrit/e',
                'required' => false,

            ])
            ->add('duree', CheckboxType::class ,[
                'label' => 'Sorties passées',
                'required' => false,

                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Sortie::class
        ]);
    }
}
