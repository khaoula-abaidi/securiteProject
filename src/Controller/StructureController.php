<?php

namespace App\Controller;

use App\Repository\StructureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StructureController extends AbstractController
{
    /**
     * @Route("/", name="structure")
     */
    public function index(StructureRepository $repository):Response
    {
        $structures = $repository->findAll();
        return $this->render('structure/index.html.twig', [
            'structures' => $structures
        ]);
    }
}
