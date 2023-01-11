<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Animal;
use Doctrine\Persistence\ManagerRegistry;

class AnimalController extends AbstractController
{
    #[Route('/animal', name: 'app_animal')]
    public function index(): Response
    {
        return $this->render('animal/index.html.twig', [
            'controller_name' => 'AnimalController',
        ]);
    }

    /**
     * @Route("/animal/add",name="add_animal")
     */
    public function createAnimal(ManagerRegistry $doctrine): Response

    {
        $entityManager = $doctrine->getManager();
        $animal = new Animal();
        $animal->setName('Kiki');
        $animal->setWeight(356);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($animal);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Saved new animal with id '.$animal->getId());

    }
    /**
     * @Route("/animal/{id}",name="read_animal")
     */
    public function get_animal(Animal $id){
        return $this->render('animal/show.html.twig', [
            'animal' => $id,
        ]);   
     }
}
