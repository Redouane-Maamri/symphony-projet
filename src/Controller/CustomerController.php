<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Etudiant;
use Doctrine\ORM\EntityManagerInterface;
class CustomerController extends AbstractController
{
    #[Route('/home', name: 'app_customer')]
    public function index(): Response
    {
        return $this->render('customer/index.html.twig', [
            'nom' => 'redouane',
            'prenom'=>"maamri",
            'number'=>100,
        ]);
    }


    #[Route('/Home', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('customer/home.html.twig', []);
    }

    //EntityManagerInterface : recuperer les donnes from the databse
    #[Route('/customers', name: 'listcustomers')]
    public function showClients( EntityManagerInterface $entityManager): Response{
    $repo=$entityManager->getRepository(Etudiant::class);
    // $clients=$repo->find($id_etudiant);
    $clients=$repo->findAll();
    
    if(!$clients){
        throw $this->createNotFoundException(
            'No clients here'
        );
    }

    // $entityManager->remove($clients);
    // $entityManager->flush();

    return $this->render('customer/list.html.twig', [
        'data' => $clients,
    ]);
}



}
