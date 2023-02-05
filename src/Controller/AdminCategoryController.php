<?php

namespace App\Controller;

use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\src\Entity\Category;

class AdminCategoryController extends AbstractController
{
    #[Route('/admin/category', name: 'app_admin_category')]
    public function index(): Response
    {
        return $this->render('admin_category/index.html.twig', [
            'controller_name' => 'AdminCategoryController',
        ]);
    }

    /**
     * @Route("/gestion_category/afficher", name="category_afficher") 
     */

     public function afficher_category(CategoryRepository $repoCategory)
     {

        $categories = $repoCategory->findAll();

        return $this->render("admin_category/category_afficher.html.twig", [
            "categories" => $categories
        ]);
     }

     /**
      * @Route("/gestion_category/ajouter", name="category_ajouter")
      */

      public function ajouter_category(Request $request, EntityManagerInterface $manager)
      {
  
        // Pour ajouter une categorie, on a besoin de créer un nouvel objet issu de la class/entity Category
        $category = new Category; 
        dump($category);
  
        /**
         * Pour créer un formulaire, on utilise la méthode createForm()
         * 2 arguments obligaroires : 
         * 1e : class du formType 
         * 2e : objet issu de la class/entity 
         * 
         * 3e facultatif : tableau 
         *  
         */
  
         $form = $this->createForm(CategoryType::class, $category);
         // $form est un objet (qui contient ses mééthodes)
  
         $form->handleRequest($request); 
        /**
         * Traitement du formulaire
         * HandleRequest() permet de gérer le traitement de la saisie du formulaire.
         * Lorsque qu'on soumet le formulaire (bouton submit) $_POST est transmis à la meme URL
         * grace à la request, on peut traiter le contenue de la requete 
         */
  
         // si le formulaire a été soumis (clic sur le bouton de type="submit")
         // et si le formulaire a été valider (respect des conditions/contraintes)
            if($form->isSubmitted() && $form->isValid())
            {
                dump($category);
  
                $manager->persist($category); // definir l'objet à envoyer
                $manager->flush(); // envoyer
                
                //dd($category);
  
                /**
                 * addFlash() est une méthode permettant de véiculer sur le navigateur une notification 
                 * 2 arguments : 
                 * 1e OBLIGATOIRE : le nom du flash 
                 * 2e facultatif : c'est un tableau 
                 */

                 $this->addFlash('sucess', "La categorie N°" . $category->getId() . " a bien été ajoutée");
  
                 /**
                  * Redirection 
                  * méthode redirectToRoute()
                  * 2 arguments 
                  * 1e OBLIGATOIRE : name de la route 
                  * 2e facultatif : c'est un tableau 
                  */
                  
                 return $this->redirectToRoute("category_afficher");
            }
  
         return $this->render("admin_category/category_ajouter.html.twig", [
            "formCategory"->$form->createView()
            // dans l'objet form se trouve une méthode createView permettant de créer la structure en html du formulaire
  
         ]);
      }
}
