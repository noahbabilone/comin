<?php

namespace AppBundle\Form;

use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//        dump($options["data"]->isEnabled()) or die;
        $builder
            ->add('lastName', TextType::class, array(
                    'label' => 'Nom',
                    'required' => true,
                    'attr' => array(
                        'class' => 'inputLastName',
                        'placeholder' => 'Dupont',
                    ),
                )
            )->add('firstName', TextType::class, array(
                    'label' => 'Prenom',
                    'required' => true,
                    'attr' => array(
                        'class' => 'inputFirstName',
                        'placeholder' => 'Jean',
                    ),
                )
            )
            ->add('phone', TextType::class, array(
                    'label' => 'Téléphone',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control inputPhone',
                        'placeholder' => '06 02 03 04 05',
                    ),
                )
            )
            ->add('homePhone', TextType::class, array(
                    'label' => 'Fix',
                    'required' => false,
                    'attr' => array(
                        'class' => 'form-control inputPhone',
                        'placeholder' => '01 02 03 04 05',
                    ),
                )
            )
            ->add('roles', ChoiceType::class, array(
                    'label' => 'Rôle Utilisateur',
                    'multiple' => true,
                    'required' => true,
//                    'mapped' => false,
                    'choices' => [
//                        'SIMPLE UTILISATEUR' => User::ROLE_USER,
                        'CLIENT' => User::ROLE_CUSTOMER,
                        'ADMIN' => User::ROLE_ADMIN,
                        'SUPER ADMIN' => User::ROLE_SUPER_ADMIN,
                    ],
                    'data' => isset($options['data']) ? $options['data']->getRoles() : null,
                    'attr' => array(
                        'class' => 'form-control hide bs-select',
                    ),
                )
            )
            ->add('enabled', CheckboxType::class, array(
                    'label' => ' ',
                    'required' => false,
                    'required' => false,
//                    'mapped' => false,
                    'attr' => array(
                        'class' => '',
                        'class' => 'hide btn-switch',
                        'data-size' => "mini",
                        'data-on' => "COMPTE ACTIF",
                        'data-off' => "COMPTE DÉSACTIVÉ",
                        'data-onstyle' => "success",
                        'data-offstyle' => "warning",
                        'data-toggle' => "toggle",
                        'data-width'=>"150",
                    ),
                    'data' => isset($options['data']) ? $options['data']->isEnabled() : true,
                )
            );
    }


    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User'
        ));
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }


    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }

}
