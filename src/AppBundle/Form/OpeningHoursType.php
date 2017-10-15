<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpeningHoursType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('day', ChoiceType::class, array(
                    'label' => 'Jour',
                    'choices' => array(1, 2),
                    'required' => true,
                    'attr' => array(
                        'class' => '',
                    ),
                )
            )
//            ->add('morningStartTime')
//            ->add('morningEndTime')
//            ->add('eveningStartTime')
//            ->add('eveningEndTime')
//            ->add('open')
//            ->add('noOpeningStartTime')
//            ->add('noOpeningEndTime')
//            ->add('created')
//            ->add('updated')
//            ->add('visible')
//            ->add('restaurant')
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\OpeningHours'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_openinghours';
    }


}
