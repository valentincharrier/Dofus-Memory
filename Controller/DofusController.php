<?php

namespace App\Controller;

use App\Entity\Dofus;
use App\Form\DofusType;
use App\Repository\DofusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FooterDescriptionRepository;
use App\Service\ResponseService;
use Symfony\Component\String\Slugger\SluggerInterface;


class DofusController extends AbstractController
{
    private $dofusRepository;
    private $footerDescriptionRepository;
    private $responseService;

    public function __construct(FooterDescriptionRepository $footerDescriptionRepository, DofusRepository $dofusRepository, ResponseService $responseService){
        $this->dofusRepository = $dofusRepository;
        $this->footerDescriptionRepository = $footerDescriptionRepository;
        $this->responseService = $responseService;
    }


    /**
     *  @Route("/dofus", name="dofus")
     * ▬▬▬▬ Les Dofus ▬▬▬▬
     * @param Request $request
     * @return Response
     */
    public function dofus(Request $request): Response
    {
        return $this->render('Dofus/dofus.html.twig', [
            'title' => 'Les Dofus',
            'descriptions' => $this->footerDescriptionRepository->affichage('Les Dofus'),
            'equipements' => $this->dofusRepository->affichage($request->get('recherche')),
        ]);
    }


    /**
     * @Route("/ajax-dofus", name="ajaxDofus")
     * ▬▬▬▬ Ajax Dofus ▬▬▬▬ Récupération des Dofus + Response Json
     * @param Request $request
     * @return Response
     */
    public function ajaxDofus(Request $request): Response
    {
        $data = $this->dofusRepository->filtrageDofus($request->get('parametres'));
        return $this->responseService->responseJson([
            'status' => 'Done',
            'affichage' => $this->renderView('Dofus/searchDofus.html.twig', [
                'equipements' => $data,
                'nbrResult' => count($data)
            ])
        ]);
    }


//▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬
//                    CRUD des Dofus
//▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬▬
    /**
     * @Route("/dofus-editeur", name="dofus_index", methods={"GET"})
     */
    public function index(DofusRepository $dofusRepository): Response
    {
        return $this->render('Dofus/index.html.twig', [
            'dofuses' => $dofusRepository->findAll(),
            'title' => 'Edition Des Dofus'
        ]);
    }

    /**
     * @Route("/dofus-editeur/new", name="dofus_new", methods={"GET","POST"})
     */
    public function new(Request $request, SluggerInterface $slugger): Response
    {
        $dofu = new Dofus();
        $form = $this->createForm(DofusType::class, $dofu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if($image){
                if($image->guessExtension() == 'png'){
                    $orginalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($orginalFilename);
                    $newFilename = $safeFilename.'-'.uniqid();

                    try {
                        $image->move(
                            'photos/dofus',
                            $newFilename.'.'.$image->guessExtension()
                        );
                    } catch (FileException $e) {
                    }
                    $dofu->setImage($newFilename);
                }

            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dofu);
            $entityManager->flush();

            return $this->redirectToRoute('dofus_index');
        }

        return $this->render('Dofus/new.html.twig', [
            'dofu' => $dofu,
            'form' => $form->createView(),
            'title' => 'Création d\'un Dofus'
        ]);
    }

    /**
     * @Route("/dofus-editeur/{id}", name="dofus_show", methods={"GET"}, requirements={"id"="\d+"})
     */
    public function show(Dofus $dofu): Response
    {
        return $this->render('Dofus/show.html.twig', [
            'dofu' => $dofu,
            'title' => $dofu->getNom()
        ]);
    }

    /**
     * @Route("/dofus-editeur/{id}/edit", name="dofus_edit", methods={"GET","POST"}, requirements={"id"="\d+"})
     */

    public function edit(Request $request, Dofus $dofu, SluggerInterface $slugger): Response
    {
        $form = $this->createForm(DofusType::class, $dofu);
        $form->handleRequest($request);
        $oldImage = $form->get('image')->getData();

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();

            if($image){
                if($image->guessExtension() == 'png'){
                    $orginalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($orginalFilename);
                    $newFilename = $safeFilename.'-'.uniqid();

                    // Move the file to the directory where brochures are stored
                    try {
                        $image->move(
                            'photos/dofus',
                            $newFilename.'.'.$image->guessExtension()
                        );
                    } catch (FileException $e) {
                        // ... handle exception if something happens during file upload
                    }

                    // updates the 'brochureFilename' property to store the PDF file name
                    // instead of its contents
                    $dofu->setImage($newFilename);
                }

            }

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dofus_index');
        }

        return $this->render('Dofus/edit.html.twig', [
            'dofu' => $dofu,
            'title' => 'Modification '.$dofu->getNom(),
            'form' => $form->createView(),
            'oldImage' => $oldImage,
        ]);
    }

    /**
     * @Route("/dofus-editeur/{id}", name="dofus_delete", methods={"DELETE"}, requirements={"id"="\d+"})
     */
    public function delete(Request $request, Dofus $dofu): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dofu->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dofu);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dofus_index');
    }
}
