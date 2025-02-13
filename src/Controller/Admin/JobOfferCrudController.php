<?php

namespace App\Controller\Admin;

use App\Entity\JobOffer;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class JobOfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return JobOffer::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
           
            TextField::new('title'),
            TextareaField::new('description'),
            TextField::new('location'),
            TextField::new('salary'),
            DateTimeField::new('endOfContract'),
            AssociationField::new('type')->autocomplete(),
            AssociationField::new('recruiter')->autocomplete(),
            AssociationField::new('category')->autocomplete(),
            BooleanField::new('activated'),
            DateTimeField::new('createdAt')->hideOnForm(),
            // DateTimeField::new('updatedAt')->hideOnForm(),
           
        ];
    }

    // public function updateEntity(EntityManagerInterface $entityManager, $entityInstance): void
    // {
    //     /** @var JobOffer $entityInstance */
    //     $entityInstance->setUpdatedAt(new DateTimeImmutable());
    //     $entityManager->persist($entityInstance);
    //     $entityManager->flush();
    // }
}
