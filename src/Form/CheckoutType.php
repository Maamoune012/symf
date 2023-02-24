<?php

namespace App\Form;

use App\Entity\Delivery;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CheckoutType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('address')
            ->add('zipcode')
            ->add('city')
            ->add('price')
            ->add('state')
            ->add('delivered_at')
            ->add('address2')
            ->add('tel')
            ->add('email')
            ->add('name')
            ->add('lastname')
            ->add('country')
            //->add('delivered_by')
           // ->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Delivery::class,
        ]);
    }
}
