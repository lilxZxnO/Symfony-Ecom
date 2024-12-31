<?php

// src/Controller/Admin/ProductCrudController.php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('produit')
            ->setEntityLabelInPlural('produits');
    }

    public function configureFields(string $pageName): iterable
    {
        $required = true;

        if ($pageName == 'edit') {
            $required = false;
        }
        return [
            // Champs du produit
            TextField::new('name')->setLabel('Nom')->setHelp('Nom du produit'),
            BooleanField::new('isHomepage')->setLabel('produit a la une')->setHelp('vous permet de mettre en avant un produit sur la page d\'accueil'),
            SlugField::new('slug')->setTargetFieldName('name')->setHelp('URL du produit'),
            TextEditorField::new('description')->setLabel('Description')->setHelp('Description du produit'),
            ImageField::new('illustration')->setLabel('Image')->setHelp('Image du produit en 600x600')->setUploadedFileNamePattern('[year]-[mounth]-[day]-[contenthash].[extension]')->setBasePath('/uploads')->setUploadDir('public/uploads')->setRequired($required),
            NumberField::new('price')->setLabel('Prix H.T')->setHelp('Prix du produit hors taxe'),
            ChoiceField::new('tva')->setLabel('T.V.A')->setChoices([
                '5,5%' => '5.5',
                '10%' => '10',
                '20%' => '20',
            ]),
            // Association avec la catégorie
            AssociationField::new('category')
                ->setLabel('Catégorie associée')
                ->setFormTypeOption('choice_label', 'name') // Remplacez 'name' par le champ à afficher dans Category
        ];
    }
}


