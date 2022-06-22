<?php

namespace App\Form;

use App\Entity\ProductPrice;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Type;

class ProductPriceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('price', NumberType::class, [
                'label' => 'price',
                'scale' => 2,
                'constraints' => [
                    new NotBlank(),
                    new Type([
                        'type' => 'float',
                    ]),
                    new GreaterThan([
                        'value' => 0,
                    ]),
                ]
            ])
            ->add('discountedPrice', NumberType::class, [
                'label' => 'discountedPrice',
                'scale' => 2,
                'constraints' => [
                    new NotBlank(),
                    new Type([
                        'type' => 'float',
                    ]),
                    new GreaterThan([
                        'value' => 0,
                    ]),
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductPrice::class,
        ]);
    }
}
