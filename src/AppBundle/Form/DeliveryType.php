<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeliveryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('takeAway', ChoiceType::class, array(
                    'label' => 'À emporter',
                    'required' => true,
                    'choices' => [
                        'Oui' => true,
                        'Non' => false,
                    ],
                    'data' => true,
                    'attr' => array(
                        'class' => 'bs-select',
                        'placeholder' => 'Restaurant',
                    ),
                )
            )
            ->add('deliveryPrice', NumberType::class, array(
                    'label' => 'Frais de livraison',
                    'required' => true,
                    'data' => 0,
                    'attr' => array(
                        'placeholder' => '0.00',
                    ),
                )
            )
            ->add('takeAwayOrderMin', NumberType::class, array(
                    'label' => 'Minimum de commande',
                    'required' => true,
                    'data' => 0,
                    'attr' => array(
                        'placeholder' => 'Min',
                    ),
                )
            )
            ->add('takeAwayDurationMin', NumberType::class, array(
                    'label' => 'Min',
                    'required' => true,
                    'attr' => array(
                        'placeholder' => 'Min',
                    ),
                )
            )
            ->add('takeAwayDurationMax', NumberType::class, array(
                    'label' => 'Min',
                    'required' => true,
                    'attr' => array(
                        'placeholder' => 'Max',
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
            'data_class' => 'AppBundle\Entity\Delivery'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_delivery';
    }


}
