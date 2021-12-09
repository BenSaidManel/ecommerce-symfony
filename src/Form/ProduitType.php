<?php

namespace App\Form;

use App\Entity\Produit;
use Doctrine\DBAL\Types\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class ProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Ref',TextType::class,)
            ->add('Nom',TextType::class)
            ->add('Description',TextareaType::class)
            ->add('Size',TextType::class)
            ->add('Prix',IntegerType::class)
            /*->add('imageFile',FileType::class,[
                'label' => false,
                'multiple' => true,
                'mapped' => false,
                'required' => false
            ])*/
           ->add('new', CheckboxType::class, [
                'required' => false,
            ])
            ->add('client')
            ->add('panier')
            ->add('catalogue')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Produit::class,
        ]);
    }
}
