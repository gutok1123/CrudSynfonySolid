<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


use App\Service\StudentService;

class StudentController extends AbstractController
{    
    private $service;
    public function __construct(StudentService $service)
    {
        $this->service = $service;
    }
     
    /**
     * @Route("/api/student/list", name="app_students",methods="GET")
     */
    public function index(): JsonResponse
    {
        try{
        return $this->json($this->service->showAll());
        }catch(\Exception $e){
            return $this->json("Erro 800:(!");
        }
    }
    
    /**
     * @Route("/api/student/vizualisation/{id}", name="app_student_vizualisation",methods="GET")
     */
    public function find(int $id): JsonResponse
    {
        try{
            return $this->json($this->service->find($id));
            }catch(\Exception $e){
                return $this->json("Erro 801:(!");
            }
    }

     /**
     * @Route("/api/student/create", name="create_students",methods="POST")
     */
    public function create(Request $request): JsonResponse
    {
      try{
       $data = json_decode($request->getContent(), true);
      return $this->json($this->service->create($data));
      }catch(\Exception $e){
        return $this->json("Erro 802:(!");
      }
    }

     /**
     * @Route("/api/student/update/{id}", name="update_students",methods="PUT")
     */
    public function update(Request $request, int $id): JsonResponse
    {
       
       try{
         $data = json_decode($request->getContent(), true);
        return $this->json($this->service->update($data,$id));
       }catch(\Exception $e){
        return $this->json("Erro 803:(!");
       }
    }

    /**
     * @Route("/api/student/delete/{id}", name="delete_students",methods="DELETE")
     */
  
    public function delete(int $id): JsonResponse
    {
        try{
        return $this->json($this->service->delete($id));
        }catch(\Exception $e){
            return $this->json("Erro 804 :(!");
        }
    }
}
