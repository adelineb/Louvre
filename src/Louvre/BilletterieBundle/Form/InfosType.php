<?php

namespace Louvre\BilletterieBundle\Form;

use Louvre\BilletterieBundle\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class InfosType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $client = new ClientModel();
        $form = $this->get('form.factory')->create(InfosType::class, $client);
        $builder
            ->add('Etapesuivante',      SubmitType::class, array('label'=>'Etape suivante >'))
            ->add('Etapeprec',          SubmitType::class, array('label'=>'< Etape précédente'))
            ->add('Annuler',            SubmitType::class)
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