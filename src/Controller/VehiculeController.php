<?php

namespace App\Controller;

use App\Entity\Vehicule;
use App\Form\VehiculeFormType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class VehiculeController extends AbstractController
{
    private $manager;
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    /**
     * @Route("/vehicule", name="create.vehicule")
     */
    public function create()
    {
        $vh = new Vehicule();
        $form = $this->createForm(VehiculeFormType::class,$vh);
        return $this->render('vehicule/create.html.twig',[
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/gestion/vehicule", name="index.vehicule")
     */
    public function index()
    {

        return $this->render('vehicule/index.html.twig',[

        ]);
    }
}
