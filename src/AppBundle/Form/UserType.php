<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
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
