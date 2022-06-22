<?php

namespace App\Form;

use App\Entity\ProductOption;
use App\Form\Type\Dropzone\DropzoneType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProductOptionFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('add', ButtonType::class, [
                'attr' => [
                    'class' => 'option_add',
                ],
                'label_html' => true,
                'label' => '<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>',
            ])
            ->add('img', DropzoneType::class, [
                'label' => 'img.add',
                'attr' => [
                    //Уникальный id нужен будет для загрузки изоброжений
                    'id' => 'imgProductOption',
                ],
                'maxFiles' => 1,
                'addRemoveLinks' => true,
            ])
            ->add('name', TextType::class, [
                'label' => 'product.name',
            ])
            ->add('count', NumberType::class, [
                'label' => 'product.count',
                'constraints' => [
                    new NotBlank(),
                    new GreaterThan([
                        'value' => 0,
                    ]),
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'product.description',
            ])
            ->add('productPrice', ProductPriceFormType::class, [
                'label' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ProductOption::class,
        ]);
    }
}
