<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    // public function up(Schema $schema): void
    // {
    //     // this up() migration is auto-generated, please modify it to your needs
    //     $this->addSql('ALTER TABLE category CHANGE nom name VARCHAR(255) NOT NULL');
    // }

   /**
      * @Route("/gestion_category/ajouter", name="category_ajouter")
      */

      public function ajouter_category(CategoryRepository $repoCategory)
      {
  
        $categories = $repoCategory->findAll();

        return $this->render("admin_category/category_afficher.html.twig", [
            "categories" => $categories
  
         ]);

      }
    }