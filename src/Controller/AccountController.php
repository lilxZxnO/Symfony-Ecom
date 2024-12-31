<?php

namespace App\Controller;

use App\Form\PasswordUserType;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AccountController extends AbstractController
{
    #[Route('/compte', name: 'app_account')]
    public function index(OrderRepository $orderRepository): Response
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Récupérer les commandes de cet utilisateur
        $orders = $orderRepository->findBy(['user' => $user], ['createdAt' => 'DESC']);

        return $this->render('account/index.html.twig', [
            'orders' => $orders,
        ]);
    }

    #[Route('/compte/modifier-mot-de-passe', name: 'app_account_modify_pwd')]
    public function password(Request $request, UserPasswordHasherInterface $passwordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        
        $form = $this->createForm(PasswordUserType::class, $user, [
            'passwordHasher' => $passwordHasher
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->addFlash('success', 'Votre mot de passe a bien été modifié');
            $entityManager->flush();
        }

        return $this->render('account/password.html.twig', [
            'modifypwd' => $form->createView(),
        ]);
    }

    #[Route('/compte/commande/{id}', name: 'app_account_order')]
    public function showOrder(int $id, OrderRepository $orderRepository): Response
    {
        // Récupérer la commande par son ID
        $order = $orderRepository->find($id);

        // Vérifier si la commande appartient bien à l'utilisateur connecté
        if (!$order || $order->getUser() !== $this->getUser()) {
            throw $this->createNotFoundException('Cette commande n\'existe pas ou ne vous appartient pas.');
        }

        return $this->render('account/order.html.twig', [
            'order' => $order,
        ]);
    }
}
