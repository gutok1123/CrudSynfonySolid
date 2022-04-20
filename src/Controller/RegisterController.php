<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
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
     * @Route("/api/register/list", name="app_register_list",methods="GET")
     */
    public function list()
    {
        try{
            return $this->json($this->service->showAll());
            }catch(\Exception $e){
                return $this->json($e->getMessage());
            }
    }
}
