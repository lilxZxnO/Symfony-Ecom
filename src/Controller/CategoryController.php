<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    #[Route('/categorie/{slug}', name: 'app_category')]
    public function index(string $slug, CategoryRepository $categoryRepository): Response
    {
        // Recherche de la catégorie avec le slug
        $category = $categoryRepository->findOneBy(['slug' => $slug]);

        // Vérifie si la catégorie existe
        if (!$category) {
            return $this->redirectToRoute('app_home');
        }

        // Rend la vue Twig avec la catégorie
        return $this->render('category/index.html.twig', [
            'category' => $category,
        ]);
    }
}
