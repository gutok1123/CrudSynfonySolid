<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


use App\Service\StudentAccountService;

class StudentAccountController extends AbstractController
{    
    private $service;
    public function __construct(StudentAccountService $service)
    {
        $this->service = $service;
    }
     
    /**
     * @Route("/api/student/account/list", name="app_account_students",methods="GET")
     */
    public function index(): JsonResponse
    {
        try{
        return $this->json($this->service->showAll());
        }catch(\Exception $e){
            return $this->json($e->getMessage());
        }
    }

     /**
     * @Route("/api/student/account/create", name="create_account_students",methods="POST")
     */
    public function create(Request $request): JsonResponse
    {
      try{
      $data = $request->request->all();
      return $this->json($this->service->create($data));
      }catch(\Exception $e){
        return $this->json($e->getMessage());
      }
    }

     /**
     * @Route("/api/student/account/update/{id}", name="update_account_students",methods="PUT")
     */
    public function update(Request $request, int $id): JsonResponse
    {
       
       try{
        $data = $request->request->all();
        return $this->json(["Dado atualizado com sucesso" => $this->service->update($data,$id)]);
       }catch(\Exception $e){
        return $this->json("Erro 902:(!");
       }
    }

    /**
     * @Route("/api/student/account/delete/{id}", name="delete_account_students",methods="DELETE")
     */
  
    public function delete(int $id): JsonResponse
    {
        try{
        return $this->json($this->service->delete($id));
        }catch(\Exception $e){
            return $this->json("Erro 903 :(!");
        }
    }
}
