<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CoursesEntityRepository;
use App\Entity\CoursesEntity;
use Doctrine\Persistence\ManagerRegistry;

use App\Service\CoursesService;

class CoursesController extends AbstractController
{    
    private $service;
    public function __construct(CoursesService $service)
    {
        $this->service = $service;
    }
     
    #[Route("/courses", name: "app_courses",methods:"GET")]
    public function index(): JsonResponse
    {
        return $this->json($this->service->showAll());
    }

    #[Route("/coursecreate", name: "create_courses", methods:"POST")]
    public function create(Request $request, ManagerRegistry $cour ): JsonResponse
    {
      $data = $request->request->all();
       
      return $this->json(["Dado criado com sucesso" => $this->service->create($data)]);
    }

    #[Route("/courseupdate/{id}", name: "update_course", methods:"PUT")]
    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->request->all();

        return $this->json(["Dado atualizado com sucesso" => $this->service->update($data,$id)]);
    }

    #[Route("/coursedelete/{id}", name: "delete_course", methods:"DELETE")]
    public function delete(int $id): JsonResponse
    {
        return $this->json($this->service->delete($id));
    }
}
