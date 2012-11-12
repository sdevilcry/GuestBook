<?php

namespace My\GuestBookBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', 'text', array(
            'attr'   =>  array(
                'class'   => 'control-label')
                )
            )
            ->add('email')
            ->add('body','textarea', array(
            'attr' => array(
                'class'=>'text-area-text',
                'rows' =>"3"
            )

        ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'My\GuestBookBundle\Entity\Post'
        ));
    }

    public function getName()
    {
        return 'my_guestbookbundle_posttype';
    }
}
