<?php

namespace MC\EventBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EvenementType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
         ->add('DateDébut', 'date')
         ->add('DateFin', 'date', array('required' => false))
         ->add('HeureDébut', 'time')
         ->add('HeureFin', 'time', array('required' => false))
         ->add('NomEvénement', 'text')
         ->add('NomOrganisateur', 'text')
         ->add('Descriptif', 'textarea', array('required' => false))
         ->add('image', new ImageType(), array('required' => false))
         ->add('save', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MC\EventBundle\Entity\Evenement'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'mc_eventbundle_evenement';
    }
}