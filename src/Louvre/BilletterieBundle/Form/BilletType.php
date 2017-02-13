<?php

namespace Louvre\BilletterieBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BilletType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('date',               DateType::class
                , array(
                    'widget' => 'single_text',
                    'format'=> 'dd/MM/yyyy',
                    'input' => 'datetime',
                    'attr' => [
                        'class' => 'js-datepicker',
                        'readonly' => 'readonly'
                    ],
                    )
            )
            ->add('typebillet',         ChoiceType::class, array(
                'choices' =>array('Journée'=>'1', 'Demi-journée'=>'2'), 'expanded' => true))
            ->add('nbbillet',           IntegerType::class)

            /*->add('date',               DateTimeType::class
                , array(
                    'format'=> 'ddMMMyyyy',
                    'input' => 'datetime',
                    'attr' => ['class' => 'js-datepicker'],
                )
            )*/
      ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Louvre\BilletterieBundle\Model\BilletModel'
        ));
    }
}
