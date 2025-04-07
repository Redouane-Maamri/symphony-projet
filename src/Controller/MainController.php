<?php

namespace App\Controller;

use App\Form\PostType;
use App\Entity\Crud;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;

class MainController extends AbstractController
{
    #[Route('/main', name: 'app_main')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $posts=$entityManager->getRepository(Crud::class)->findAll();
        return $this->render('main/index.html.twig', [
            'post' => $posts ,
        ]);

        if(!$post){
            addFlash('message',"Posts does not exists");
        }
    }
    
    #[Route('/form', name: 'app_form')]
public function form(Request $request, EntityManagerInterface $entityManager): Response
{
    // Récupérer les données du formulaire
    $username = $request->request->get('username');
    $password = $request->request->get('password');

    // Vérification des identifiants
    if($request->isMethod('POST')){

        if($username=="admin" && $password==1234){
            return $this->redirectToRoute('app_main');
            
        }else{
            $this->addFlash('error', 'Nom d\'utilisateur ou mot de passe incorrect.');
        }
    }

    // Rendre la page du formulaire avec les messages d'erreur si existants
    return $this->render('main/form.html.twig');
}

    


#[Route('/accueil', name: 'app_accueil')]
public function accueil(Security $security): Response
{
    $user = $security->getUser(); // Get the currently logged-in user

    return $this->render('main/accueil.html.twig', [
        'userEmail' => $user ? $user->getEmail() : null,
    ]);
}

    #[Route('/posts', name: 'app_post')]
    public function posts(Request $request,EntityManagerInterface $entityManager): Response{
        $post=new Crud();
        $form=$this->createForm(PostType::class,$post);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            // dd($post); just affiche it to check
            $entityManager->persist($post);
            $entityManager->flush();

            $this->addFlash('success', 'Post enregistré avec succès!');
            return $this->redirectToRoute('app_main');

        }
        return $this->render('main/post.html.twig', [
            'form' => $form->createView()
        ]);
    }


    #[Route('/posts/{id}', name: 'edit_post')]
    public function editpost(int $id, Request $request,EntityManagerInterface $entityManager) : Response {
        // dd($id);
        // repository il est responsable a recuperer les donnes a travers la base de donnes .
        $post=$entityManager->getRepository(Crud::class)->find($id);
        $form=$this->createForm(PostType::class,$post);
        $form->handleRequest($request);

        if(!$post){
            createNotFoundException("Id of post don't exist");
        }

        if($form->isSubmitted() && $form->isValid()){
            //entity manager responsable a la cycle de vie des entites  . l'enregistrement,supprssion.... , excuter des operation dans Database
            
            // persist : save
            $entityManager->persist($post);
            $entityManager->flush();

            $this->addFlash('update', 'Post Updated successfully!');
            return $this->redirectToRoute('app_main');
        }

        return $this->render('main/post.html.twig',[
        'form'=>$form->createView()
        ]);
    }


    #[Route('/delete_post/{id}', name: 'delete_post')]
    public function deletePost(Request $request,EntityManagerInterface $entityManager,int $id) :Response {
        // dd($id);
        $post=$entityManager->getRepository(Crud::class)->find($id);

        if(!$post){
            createNotFoundException("Id of post don't exist");
        }

        $entityManager->remove($post);
        $entityManager->flush();

        $this->addFlash('delete',"post deleted succesfully");
        return $this->redirectToRoute('app_main');

    }



}
