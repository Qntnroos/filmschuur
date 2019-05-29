<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

use Symfony\Component\OptionsResolver\OptionsResolver;

class UserRegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('user_firstname', TextType::class, [
                'attr'=> ['placeholder' => 'voornaam'],
            ])
            ->add('user_lastname', TextType::class, [
                'attr'=> ['placeholder' => 'naam'],
            ])
            ->add('email', RepeatedType::class, [
                'type'=> EmailType::class,
                'attr'=> ['placeholder' => 'voorbeeld@email.be'],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'attr'=> ['placeholder' => 'Paswoord'],
            ])
            ->add('user_adress', TextType::class, [
                'attr'=> ['placeholder' => 'straat nr (gescheiden door spatie)'],
            ])
            ->add('phone', TelType::class, [
                'attr'=> ['placeholder' => '0999 99 99 99 (respecteer spaties)'],
            ])
            ->add('genderID'/* , ChoiceType:: class, [
                'attr'=> ['placeholder' => 'Selecteer jouw geslacht'],] */
            );
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
