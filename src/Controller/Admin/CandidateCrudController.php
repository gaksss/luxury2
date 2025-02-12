<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class CandidateCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Candidate::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextEditorField::new('notes'),
            TextField::new('firstName'),
            TextField::new('lastName'),
            AssociationField::new('gender')->autocomplete(),
            TextField::new('address'),
            TextField::new('country'),
            TextField::new('nationality'),
            TextField::new('currentLocation'),
            TextField::new('birthPlace'),
            TextField::new('description')->hideOnIndex(),
            DateTimeField::new('createdAt')->hideOnForm(),
            DateTimeField::new('deletedAt')->hideOnForm(),
            DateTimeField::new('updatedAt')->hideOnForm(),
            // BooleanField::new('availibility'),
            DateField::new('birthDate'),
            AssociationField::new('experience')->autocomplete(),
            TextField::new('profilePicture'),
            TextField::new('cv'),
            TextField::new('passport'),
        ];
    }
}
