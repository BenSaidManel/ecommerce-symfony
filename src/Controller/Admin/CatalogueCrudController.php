<?php

namespace App\Controller\Admin;

use App\Entity\Catalogue;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CatalogueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Catalogue::class;
    }

   
    public function configureFields(string $pageName): iterable
    {
        return [
        
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
           
        ];
    }
    
}
