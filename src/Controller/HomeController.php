<?php
namespace App\Controller;

use App\Entity\Abonnes;
use App\Entity\Rechercher;
use App\Form\LoginAbonnesType;
use App\Form\RechercherType;
use App\Repository\VoyageRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class HomeController extends AbstractController
{
    /**
     * @var Environment
     */
    private $twig;

    /**
     * HomeController constructor.
     * @param Environment $twig
     */
    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route(path="/",name="home")
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index():Response
    {
        return new Response($this->twig->render('pages/index.html.twig'));
    }

    /**
     * @Route(path="/comment_ça_marche",name="faq")
     * @return Response
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function comment():Response
    {
        return new Response($this->twig->render('pages/faq.html.twig'));
    }

    /**
     * @Route(path="/fret-en-direct", name="fret.direct")
     * @param Request $request
     * @param VoyageRepository $repository
     * @return Response
     */
    public function fret(Request $request, VoyageRepository $repository)
    {
        $search = new  Rechercher();
        $voyage = $repository->findListVoyageActif();
        $form = $this->createForm(RechercherType::class , $search);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

        }
        return $this->render('pages/fret-en-direct.html.twig',[
            'form' => $form->createView(),
            'voyages' => $voyage
        ]);
    }
}