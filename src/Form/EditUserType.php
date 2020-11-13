<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('') PSEUDO
            ->add('prenom')
            ->add('nom')
            ->add('telephone')
            ->add('email', EmailType::class,[
                'constraints'=>[
                    new NotBlank([
                        'message'=> 'Merci d\'entrer un e-mail',
                    ]),
                ],
                'required'=>true,
                'attr'=> ['class'=> 'form-control'],
            ])

            ->add('oldPassword', PasswordType::class, [
                'mapped' => false,
                'label' => 'Mot de passe actuel'

            ])

            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'invalid_message' => 'Les champs des mots de passe doivent correspondre',
                'required' => true,
                'first_options'  => array('label' => 'Nouveau Mot de passe'),
                'second_options' => array('label' => 'Répéter le mot de passe'),
                'mapped' => false,

            ])
            ->add('campus', null, [
                'label' => 'campus',
                'choice_label' => 'nom',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
