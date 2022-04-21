<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\RegisterService;


class RegisterController extends AbstractController
{    
    private $service;
    public function __construct(RegisterService $service)
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
     * @Route("/api/register/list", name="app_register",methods="GET")
     */
    public function index(): JsonResponse
    {
        try{
        return $this->json($this->service->showAll());
        }catch(\Exception $e){
            return $this->json("Erro 1000:(!");
        }
    }

   
    
     /**
     * @Route("/api/register/visualization/{id}", name="app_register_vizualisation",methods="GET")
     */
    public function find(int $id): JsonResponse
    {
        try{
            return $this->json($this->service->find($id));
            }catch(\Exception $e){
                return $this->json("Erro 1001:(!");
            }
    }

     /**
     * @Route("/api/register/create", name="create_register",methods="POST")
     */
    public function create(Request $request): JsonResponse
    {
      try{
      $data = json_decode($request->getContent(), true);
      return $this->json($this->service->create($data));
      }catch(\Exception $e){
        return $this->json($e->getMessage());
      }
    }

     /**
     * @Route("/api/register/update/{id}", name="update_register",methods="PUT")
     */
    public function update(Request $request, int $id): JsonResponse
    {
       
       try{
        $data = json_decode($request->getContent(), true);
        return $this->json($this->service->update($data,$id));
       }catch(\Exception $e){
        return $this->json($e->getMessage());
       }
    }

    /**
     * @Route("/api/register/delete/{id}", name="delete_register",methods="DELETE")
     */
  
    public function delete(int $id): JsonResponse
    {
        try{
        return $this->json($this->service->delete($id));
        }catch(\Exception $e){
            return $this->json("Erro 1004 :(!");
        }
    }
}
