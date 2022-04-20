<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\CoursesService;


class CoursesController extends AbstractController
{    
    private $service;
    public function __construct(CoursesService $service)
    {
        $this->service = $service;
    }

     /**
     * @Route("/api/login_check", name="app_login",methods="POST")
     */
    public function login()
    {
       dd("Não deu certo :(!");
    }
     
    /**
     * @Route("/api/course/list", name="app_courses",methods="GET")
     */
    public function index(): JsonResponse
    {
        try{
        return $this->json($this->service->showAll());
        }catch(\Exception $e){
            return $this->json("Erro 700:(!");
        }
    }

   
    
     /**
     * @Route("/api/course/vizualisation/{id}", name="app_courses_vizualisation",methods="GET")
     */
    public function find(int $id): JsonResponse
    {
        try{
            return $this->json($this->service->find($id));
            }catch(\Exception $e){
                return $this->json("Erro 701:(!");
            }
    }

     /**
     * @Route("/api/course/create", name="create_courses",methods="POST")
     */
    public function create(Request $request): JsonResponse
    {
      try{
      $data = json_decode($request->getContent(), true);
      return $this->json(["Dado criado com sucesso" => $this->service->create($data)]);
      }catch(\Exception $e){
        return $this->json("Erro 702:(!");
      }
    }

     /**
     * @Route("/api/course/update/{id}", name="update_courses",methods="PUT")
     */
    public function update(Request $request, int $id): JsonResponse
    {
       
       try{
        $data = json_decode($request->getContent(), true);
        return $this->json(["Dado atualizado com sucesso" => $this->service->update($data,$id)]);
       }catch(\Exception $e){
        return $this->json("Erro 703:(!");
       }
    }

    /**
     * @Route("/api/course/delete/{id}", name="delete_courses",methods="DELETE")
     */
  
    public function delete(int $id): JsonResponse
    {
        try{
        return $this->json($this->service->delete($id));
        }catch(\Exception $e){
            return $this->json("Erro 704 :(!");
        }
    }
}
