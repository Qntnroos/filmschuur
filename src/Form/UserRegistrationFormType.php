<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Genders;
use App\Entity\Cities;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\IsTrue;

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
                'first_options' => ['attr' => ['placeholder' => 'voorbeeld@email.be']],
                'second_options' => ['attr' => ['placeholder' => 'voorbeeld@email.be']],
            ])
            // don't use password: avoid EVER setting that on a field that might be persisted
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'first_options' => ['attr' => ['placeholder' => 'paswoord']],
                'second_options' => ['attr' => ['placeholder' => 'herhaal paswoord']],
                'attr' => ['style' => 'width: 100%'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Paswoord is vereist'
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Minimaal acht karakters'
                    ])
                ]
            ])
            ->add('user_adress', TextType::class, [
                'attr'=> ['placeholder' => 'straat nr (gescheiden door spatie)'],
            ])
            ->add('city',  EntityType::class, [
                'placeholder' => 'Selecteer jouw woonplaats', 
                'class' => Cities::class,
            ])
            
            ->add('phone', TelType::class, [
                'attr'=> ['placeholder' => '0999 99 99 99 (respecteer spaties)'],
            ])

           ->add('gender' , EntityType::class, [
                'placeholder' => 'Selecteer jouw geslacht',
                'class' => Genders::class,
             ])

            ->add('birthday', DateType::class, [
                'widget' => 'choice',
                // 'attr' => ['class' => 'js-datepicker'], 
                'html5' => false,
                'years' => range(date('Y')-18, date('Y')-100),
              
                ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label'    => 'Ik ga akkoord met de algemene voorwaarden, cookie- en privacybeleid.',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Je dient akkoord te gaan met onze voorwaarden.'
                    ])
                ]
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
