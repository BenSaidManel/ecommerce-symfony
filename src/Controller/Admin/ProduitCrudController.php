<?php

namespace App\Controller\Admin;

use App\Entity\Produit;
use PhpParser\Node\Expr\BooleanNot;
use Doctrine\DBAL\Types\BooleanType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProduitCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Produit::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
           
            IdField::new('id')->hideOnForm(),
            TextField::new('Ref'),
            TextField::new('Nom'),
            TextareaField::new('Description'),
            TextField::new('Size'),
            BooleanField::new('new')->setTextAlign('center'),
            MoneyField::new('Prix')->setCurrency('EUR'),
           
          
           // TextField::new('imageFile')->setFormType(VichImageType::class),
           ImageField::new('image')
           ->setBasePath('/uploads/images')
           ->setUploadDir('public/uploads/images')
           ->setUploadedFileNamePattern('[randomhash].[extension]')
           ->setRequired(false),

            AssociationField::new('catalogue'),


        ];
    }
    
}
