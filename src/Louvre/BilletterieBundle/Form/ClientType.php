<?php

namespace Louvre\BilletterieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ClientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',               TextType::class)
            ->add('prenom',            TextType::class)
            ->add('pays',              CountryType::class, array(
                'preferred_choices' => array('FR')))
            //->add('dateNaissance',     BirthdayType::class, array(
            //        'format'=> 'ddMMMyyyy',)
            //)
            ->add('dateNaissance', BirthdayType::class, array(
                    'label' => 'Date de naissance',
                    'format'=> 'ddMMMyyyy',
                    'placeholder' => array(
                        'year' => 'Année', 'month' => 'Mois', 'day' => 'Jour')
            ))
            ->add('Tarifreduit',       checkboxType::class, array(
                'required' => false,
            ))
        ;
   }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Louvre\BilletterieBundle\Model\ClientModel'
        ));
    }
}
