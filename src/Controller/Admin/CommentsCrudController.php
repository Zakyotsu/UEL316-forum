<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\{ AssociationField, IdField, TextField };

class CommentsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string {
        return Comment::class;
    }

    public function configureFields(string $pageName): iterable {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('text')->setLabel('Texte'),
            AssociationField::new('post')->setLabel('Post'),
            AssociationField::new('user')->setLabel('Créateur du commentaire')
        ];
    }

}
