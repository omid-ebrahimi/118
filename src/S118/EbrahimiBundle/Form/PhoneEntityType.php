<?php

namespace S118\EbrahimiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PhoneEntityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('status')
            ->add('number')
            ->add('PersonEntity')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'S118\EbrahimiBundle\Entity\PhoneEntity'
        ));
    }

    public function getName()
    {
        return 's118_ebrahimibundle_phoneentitytype';
    }
}
