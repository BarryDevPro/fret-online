<?php

namespace App\Controller;

use App\Entity\Abonnes;
use App\Entity\Entreprise;
use App\Form\FormAbonneType;
use App\Form\FormEntrepriseType;
use App\Repository\AbonnesRepository;
use App\Repository\EntrepriseRepository;
use App\Repository\MessagesRepository;
use App\Repository\ZoneInterventionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\User;

class AbonneController extends AbstractController
{
    /**
     * @var ObjectManager
     */
    private $manager;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;
    /**
     * @var AbonnesRepository $repository
     */
    private $repository;
    /**
     * @var EntrepriseRepository
     */
    private $entrepriseRepo;
    /**
     * @var
     */
    private $messageRepo;

    public function __construct(ObjectManager $manager, UserPasswordEncoderInterface $encoder, AbonnesRepository $repository, EntrepriseRepository $entrepriseRepo, MessagesRepository $messageRepo)
    {
        $this->manager = $manager;
        $this->encoder = $encoder;
        $this->repository = $repository;
        $this->entrepriseRepo = $entrepriseRepo;
        $this->messageRepo = $messageRepo;
    }

    /**
     * @Route(path="/mon_espace",name="user_espace")
     * @param Security $security
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function index(Security $security)
    {
        $abonnes = $security->getUser();
        $lastMessage = $this->messageRepo->findLastMessage($abonnes->getId());
        $ab = new Abonnes();
        if ($abonnes == null) {
            return $this->redirectToRoute("login");
        }
        return $this->render('abonne/index.html.twig', [
            'user' => $abonnes,
            'messages' => $lastMessage,
            'abonnes' => $ab
        ]);
    }

    /**
     * @Route(path="/creer_compte",name="create_compte")
     * @param Request $request
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(Request $request,\Swift_Mailer $mailer)
    {
        $ab = new Abonnes();
        $form = $this->createForm(FormAbonneType::class, $ab);
        $form->handleRequest($request);
        $sub_error = array();
        $sub_error['image'] = "";
        $sub_error['tel'] = "";
        $sub_error['ninea'] = "";
        $sub_error['email'] = "";
        if ($form->isSubmitted()) {
            $ninea = $this->repository->findOneBy([
                'ninea' => $ab->getNinea()
            ]);
            $tel = $this->repository->findOneBy([
               'telephone' => $ab->getTelephone()
            ]);
            $email = $this->repository->findOneBy([
                'email' => $ab->getEmail()
            ]);
            $file = $ab->getFile();
            $ch = $ab->getTelephone();
            $type = array("jpg", "jpeg");
            $ext = explode(".", $file);
            if (!empty($ninea)) {
                $sub_error['ninea'] = "Un utilisateur avec le meme ninea existe";
            }
            if (!empty($tel)) {
                $sub_error['tel'] = "le meme numero existe dejà";
            }
            if (!empty($email)) {
                $sub_error['email'] = "Un utilisateur avec le meme email existe";
            }
            if (!in_array(end($ext), $type) && !empty($file)) {
                $sub_error['image'] = "type d'image non autorisé";
            }
            if ($ch[0] != '7' || ($ch[1] != '6' && $ch[1] != '7' && $ch[1] != '8' && $ch[1] != '0')) {
                $sub_error['tel'] = "Veuillez choisir un bon numero";
            }
            if ($sub_error['tel'] == "" && $sub_error['image'] == "" && $sub_error['ninea'] == "" && $sub_error['email'] =="") {
                if ($form->isValid()) {
                    $message = (new \Swift_Message('Hello Email'))
                        ->setFrom('yaranagoresekou@gmail.com')
                        ->setTo($ab->getEmail());

                    $mailer->send($message);
                    $ab->setPassword($this->encoder->encodePassword($ab, $ab->getPassword()));
                    $ab->setCreatedAt(new \DateTime('now'));
                    $this->manager->persist($ab);
                    $this->manager->flush();
                    $this->addFlash('success', 'votre compte a été créé avec succes');
                    $token = new UsernamePasswordToken($ab, null, 'main', ['ROLE_USER']);
                    $this->get('security.token_storage')->setToken($token);
                    return $this->redirectToRoute('abonne.create.entreprise');
                }

            }
        }
        return $this->render("abonne/create.html.twig", [
            'form' => $form->createView(),
            'sub_error' => $sub_error
        ]);
    }

    /**
     * @Route(path="/edit",name="abonnes.edit")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function edit(Request $request)
    {
        $abonnes = $this->getUser();
        $form = $this->createForm(FormAbonneType::class, $abonnes);
        $form->handleRequest($request);
        $sub_error = array();
        $sub_error['image'] = "";
        $sub_error['tel'] = "";
        if ($form->isSubmitted() && $form->isValid()) {
            $file = $abonnes->getFile();
            $ch = $abonnes->getTelephone();
            $type = array("jpg", "jpeg");
            $ext = explode(".", $file);
            if (!in_array(end($ext), $type) && !empty($file)) {
                $sub_error['image'] = "type d'image non autorisé";
            }
            if ($ch[0] != '7' || ($ch[1] != '6' && $ch[1] != '7' && $ch[1] != '8' && $ch[1] != '0')) {
                $sub_error['tel'] = "Veuillez choisir un bon numero";
            }
            if (empty($sub_error['tel'])) {
                $abonnes->setPassword($this->encoder->encodePassword($abonnes, $abonnes->getPassword()));
                $this->manager->persist($abonnes);
                $this->manager->flush();
                $this->addFlash('succes', 'Modification effectuée aves succès');
                return $this->redirectToRoute('user_espace');
            }
        }
        return $this->render("abonne/edit.html.twig", [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route(path="/create_entreprise",name="abonne.create.entreprise")
     * @param ZoneInterventionRepository $repository
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create_entreprise(ZoneInterventionRepository $repository, Request $request)
    {
        $ent = new Entreprise();
        $form = $this->createForm(FormEntrepriseType::class, $ent);
        $form->handleRequest($request);
        $errors = array();
        $errors['ninea'] = "";
        $errors['logo'] = "";
        $errors['tel'] = "";
        $errors['email'] = "";
        if ($form->isSubmitted()) {
            $ninea = $this->entrepriseRepo->findOneBy([
                'ninea'=> $ent->getNinea()
            ]);
            $tel = $this->entrepriseRepo->findOneBy([
                'Tel'=>$ent->getTel()
            ]);
            if (!empty($tel)) {
                $errors['tel'] = "le meme numero existe";
            }
            if ($ninea != null && 10 >= $ninea->getNbreAbonne()) {
                $errors['ninea'] = "Cette entreprise a plus de 10 utilisateurs";
            }
            $file = $ent->getImg();
            $ch = $ent->getTel();
            $type = array("jpg", "jpeg");
            $ext = explode(".", $file);
            if (!in_array(end($ext), $type) && !empty($file)) {
                $errors['logo'] = "type d'image non autorisé";
            }
            if ($ch[0] != '7' || ($ch[1] != '6' && $ch[1] != '7' && $ch[1] != '8' && $ch[1] != '0')) {
                $errors['tel'] = "Veuillez choisir un bon numero";
            }
            if (empty($errors['tel']) && empty($errors['logo']))
            {
                if ($form->isValid()){
                    /** @var TYPE_NAME $ninea */
                    if ($ninea == null){
                        $this->manager->persist($ent);
                        $ent->setCreateAt(new \DateTime('now'));
                        $user = $this->getUser();
                        $user->setIdEntreprise($ent);
                        $this->manager->persist($user);
                        foreach ($_POST['zone'] as $value)
                        {
                            $ent->addListeZone($repository->find(($value)));
                        }
                        $ent->setNbreAbonne(1);
                        $this->manager->persist($ent);
                        $this->manager->flush();
                        return $this->redirectToRoute("user_espace");
                    }
                    if ($ninea != null && $ninea->getNbreAbonne() < 10){
                        $user = $this->getUser();
                        $user->setIdEntreprise($ninea);
                        $ninea->setNbreAbonne($ninea->getNbreAbonne()+1);
                        $this->manager->persist($ninea);
                        $this->manager->persist($user);
                        $this->manager->flush();
                        return $this->redirectToRoute("user_espace");
                    }
                }
            }
        }
        return $this->render('abonne/create_entreprise.html.twig', [
            'form' => $form->createView(),
            'zones' => $repository->findAll(),
            'sub_error' =>$errors
        ]);
    }
}