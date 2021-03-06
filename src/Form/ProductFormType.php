<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\Type\Dropzone\DropzoneType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ProductFormType
 * @package App\Form
 */
class ProductFormType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'images',
                DropzoneType::class,
                [
                    'label' => 'img.add',
                    'attr' => [
                        //Уникальный id нужен будет для загрузки изображений
                        'id' => 'imgProduct',
                    ],
                    'maxFiles' => 3,
                    'addRemoveLinks' => true,
                    'mapped' => false,
                ]
            )
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'product.name',
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'label' => 'product.description',
                ]
            )
            ->add(
                'category',
                EntityType::class,
                [
                    'label' => 'category.name',
                    'class' => Category::class,
                    'choice_label' => 'name',
                ]
            )
            ->add(
                'options',
                CollectionType::class,
                [
                    'entry_type' => ProductOptionFormType::class,
                    'entry_options' => [
                        'label' => false,
                    ],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'label' => 'product.options',
                ]
            )
            ->add(
                'characteristics',
                CollectionType::class,
                [
                    'entry_type' => ProductCharacteristicFormType::class,
                    'entry_options' => [
                        'label' => false,
                    ],
                    'allow_add' => true,
                    'allow_delete' => true,
                    'label' => 'product.characteristic'
                ]
            )
            ->add(
                'submit',
                SubmitType::class,
                [
                    'label' => 'product.add',
                ]
            );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(
            [
                'data_class' => Product::class,
            ]
        );
    }
}
