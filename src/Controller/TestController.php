<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test", name="test")
     */
    public function index1(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    /**
     * @Route("/nv-page", name="nv-page")
     */
    public function nvPage(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: ' . $number . '</body></html>'
        );
    }
    /**
     * @Route("/nv-page1/{num}", name="nv-page1")
     */
    public function nvPage1(int $num): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>bonjour ' . $num . ', your Lucky number is: ' . $number . '</body></html>'
        );
    }
    /**
     * @Route("/test2/{nom}/{mincaractere}", name="test2")
     */
    public function index(string $nom, int $mincaractere): Response
    {
        $taille = strlen($nom);
        return $this->render('test/index.html.twig', [
            'nom' => $nom,
            'taille' => $taille,
            'mincaractere' => $mincaractere,
            
        ]);
    }
}
