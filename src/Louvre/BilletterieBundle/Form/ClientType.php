<?php

namespace Louvre\BilletterieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
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
            ->add('pays',              TextType::class)
            ->add('dateNaissance',    DateTimeType::class)
            ->add('Tarifreduit',      checkboxType::class, array(
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
