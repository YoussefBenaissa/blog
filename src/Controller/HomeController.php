<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;
use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/*
Factorisation de l'injection de dependance
on remarque que l'injection de dependance se repete dans plus qu'une action (ArticleRepository $repoArticle),d'où la nécessité de la factoriser.
la factorisation se fait au niveau du constructeur,dans lequele on fait l 'injection de dépendance une fois pour toutes.
ensuite il faut memoriser cette val dans une var ==> on declare une var privée private $repoArticle;puis on lui affecte la val dans le constructeur
[14:01]
public function __construct(ArticleRepository $repoArticle){
        $this->repoArticle = $repoArticle;
    }*/

class HomeController extends AbstractController
{
    private $repoArticle;
    public function __construct(ArticleRepository $repoArticle, CategoryRepository $repocategory)
    {
        $this->repoArticle = $repoArticle;
        $this->repoCategory = $repocategory;
    }
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        $articles = $this->repoArticle->findAll();
        $Categorys = $this->repoCategory->findAll();
        return $this->render('home/index.html.twig', [
            "articles" => $articles,
            "categorys" => $Categorys,
        ]);
    }
    /**
     * @Route("/show/{id}", name="show")
     */

    public function show(Article $article): Response // je ne suis pas obligé de mettre en paramettre l'id je peux mettre la class (Article $article) dans les paramettre et symfony sera capable de recuperer l'Article
    { // dd($article);
        if (!$article) {
            return $this->redirectToRoute('home');
        }

        return $this->render('home/show.html.twig', [
            "article" => $article
        ]);
    }
    /**
     * @Route("/showArticles/{id}", name="show_article")
     */
    public function showArticle(?Category $categorys): Response
    {
        if ($categorys) {
            $articles = $categorys->getArticles()->getValues();
        } else {

            return $this->redirectToRoute('home');
        }
        $categorys = $this->repoCategory->findAll();

        return $this->render('home/index.html.twig', [
            "articles" => $articles,
            "categorys" => $categorys,
        ]);
    }
    /**
     * @Route("/recherche", name="recherche")
     */
    public function recherche(Request $request): Response
    {
        $datePost = date($request->request->get('date'));
        //$request->request : eq POST (au complet)
        //$request->request->get('date')  : eq POST['date']

        $date = \DateTime::createFromFormat("Y-m-d", $datePost);

        //$date = \DateTime::createFromFormat("Y-m-d", date($request->request->get('date')));
        $title = $request->request->get('title');

        $articles = $this->repoArticle->findByTitleLike($title, $date);

        $categorys = $this->repoCategory->findAll();

        return $this->render('home/recherche.html.twig', [
            "articles" => $articles,
            "categorys" => $categorys,
        ]);
    }
}
