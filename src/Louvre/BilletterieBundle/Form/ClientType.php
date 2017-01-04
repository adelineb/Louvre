<?php

namespace Louvre\BilletterieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ClientType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        for ($i=0; $i<2; $i++ ){
        $builder
            ->add('nom'.$i,            TextType::class)
            ->add('prenom'.$i,         TextType::class)
            ->add('pays'.$i,           TextType::class)
            ->add('date_Naissance'.$i,  DateTimeType::class)
            //->add('Tarif_réduit',    checkboxType::class)
        ;
        }

        $builder
            ->add('Etape suivante',     SubmitType::class)
            ->add('Etape précédente',   SubmitType::class)
            ->add('Annuler',            SubmitType::class)
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Louvre\BilletterieBundle\Entity\Client'
        ));
    }
}
