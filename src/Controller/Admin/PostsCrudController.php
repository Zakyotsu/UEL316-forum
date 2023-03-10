<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{AssociationField, DateField, IdField, TextField};

class PostsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string {
        return Post::class;
    }

    public function configureFields(string $pageName): iterable {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title')->setLabel('Titre'),
            TextField::new('description')->setLabel('Description'),
            TextField::new('content')->setLabel('Contenu'),
            DateField::new('date')->hideOnForm(),
            AssociationField::new('creator')->setLabel('Créateur du post')
        ];
    }

}
