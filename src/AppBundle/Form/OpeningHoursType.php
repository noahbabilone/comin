<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
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
                    'choices' => array(
                        "Lundi" => 1,
                        "Mardi" => 2,
                        "Mercredi" => 3,
                        "Jeudi" => 4,
                        "Vendredi" => 5,
                        "Samedi" => 6,
                        "Dimanche" => 7,
                    ),
                    'required' => true,
                    'attr' => array(
                        'class' => 'week-day bs-select',
                    ),
                )
            )
            ->add('morningStartTime', DateTimeType::class, array(
                    'label' => 'De',
                    'widget' => 'single_text',
                    'format' => 'HH:mm',
                    'data' => new \DateTime('01/06/1957 11:30'),
                    'required' => false,
                    'attr' => array(
                        'class' => 'timepicker',
                        'data-provide' => 'timepicker',
                        'data-date-format' => 'HH:ii',
                        'placeholder' => 'Heure:min',
                    ),
                )
            )->add('morningEndTime', DateTimeType::class, array(
                    'label' => 'À',
                    'widget' => 'single_text',
                    'format' => 'HH:mm',
                    'data' => new \DateTime('01/06/1957 14:30'),

                    'required' => false,
                    'attr' => array(
                        'class' => 'timepicker',
                        'data-provide' => 'timepicker',
                        'data-date-format' => 'HH:ii',
                        'placeholder' => 'H:mn',
                    ),
                )
            )
            ->add('eveningStartTime', DateTimeType::class, array(
                    'label' => 'De',
                    'widget' => 'single_text',
                    'format' => 'HH:mm',
                    'data' => new \DateTime('01/06/1957 18:30'),
                    'required' => false,
                    'attr' => array(
                        'class' => 'timepicker',
                        'data-provide' => 'timepicker',
                        'data-date-format' => 'HH:ii',
                        'placeholder' => 'H:mn',
                    ),
                )
            )
            ->add('eveningEndTime', DateTimeType::class, array(
                    'label' => 'À',
                    'widget' => 'single_text',
                    'format' => 'HH:mm',
                    'data' => new \DateTime('01/06/1957 23:30'),
                    'required' => false,
                    'attr' => array(
                        'class' => 'timepicker',
                        'data-provide' => 'timepicker eveningEndTime',
                        'data-date-format' => 'HH:ii',
                        'placeholder' => 'H:mn',
                    ),
                )
            )
//           ->add('open')
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
