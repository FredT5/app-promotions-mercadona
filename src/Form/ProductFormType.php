<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use App\Repository\CategoryRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType as TypeDateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', options: [
                'label' => 'Nom'
            ])
            ->add('description')
            ->add('price', MoneyType::class, options: [
                'label' => 'Prix',                
                'scale' => 2,
                'currency' => 'EUR',
                'attr' => [
                    'min' => '0.00',
                    'max' => '1000.00',
                    'step' => '0.01'
                ]
            ])
            ->add('discount', options: [
                'label' => 'Remise (%)'
            ])
            ->add('discount_start', TypeDateType::class, options: [
                'widget' => 'single_text',
                'label' => 'Date de début',
                'required' => false
            ])
            ->add('discount_end', TypeDateType::class, options: [
                'widget' => 'single_text',
                'label' => 'Date d\'expiration',
                'required' => false
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'query_builder' => function (CategoryRepository $cr): QueryBuilder {
                    return $cr->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
            ])
            ->add('image', FileType::class, [
                'label' => 'Image',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // optional so we don't have to re-upload the image file
                // every time we edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so we can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '100k',
                        'maxSizeMessage' => 'Image trop lourde, il ne faut pas dépassé 100 ko.',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                            'image/png',
                            'image/gif'

                        ],
                        'mimeTypesMessage' => 'Format d\'image incorrect. Les formats jpg, jpeg, png et gif sont autorisés.',
                    ])
                ],
            ])
            //->add('created_at')
            //->add('updated_at')
            //->add('slug')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
