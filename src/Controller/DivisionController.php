<?php

namespace App\Controller;

use App\Entity\DivisionCompany;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DivisionCompanyController extends Controller
{
    /**
     * @Route("/divisionCompany", name="divisionCompanyJson")
     * @Method("GET")
     */
    public function index() //Возвращает все компании из бд в формате json
    {
        $repository = $this->getDoctrine()->getRepository(DivisionCompany::class); //получает доступ к доктрине

        $divisionCompanies = $repository->findAllDivisionCompanies();

        $response = new JsonResponse($divisionCompanies);
        $response->setEncodingOptions(JSON_UNESCAPED_UNICODE);

        return $response;
    }

    /**
     * @Route("/divisionCompany", name="divisionCompany")
     * @Method("POST")
     */
    public function add(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();//получает доступ к доктрине

        $divisionCompany = new DivisionCompany();

        $divisionCompany->setName($request->request->get("name"));
        $divisionCompany->setLocation($request->request->get("location"));
        $divisionCompany->setTaxpayerNum($request->request->get("taxpayer_num"));
        $divisionCompany->setEmployeesNum($request->request->get("employees_num"));
        $divisionCompany->setSortActivity($request->request->get("sort_activity"));
        $divisionCompany->setPatentNum($request->request->get("patent_num"));
        $divisionCompany->setPeriod($request->request->get("period"));

        $entityManager->persist($divisionCompany);//отправляем данные в бд
        $entityManager->flush();

        return $this->render('message.html.twig', [ //название шаблона
            'alert' => 'success',//переменные передаем в шаблон
            'head' => 'Успешно!',
            'content' => 'Данные успешно добавлены'
        ]);
    }

    /**
     * @Route("/divisionCompany/{id}", requirements={"id" = "\d+"})//регулярное выражение
     * @Method("DELETE")
     */
    public function delete(Request $request, $id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $divisionCompany = $this->getDoctrine()->getRepository(DivisionCompany::class)->find($id);

        $response = new Response();

        if (!$divisionCompany) {
            $response->setStatusCode(404);//не нашли компанию
            return $response;
        }

        $entityManager->remove($divisionCompany);//удалить компанию из бд
        $entityManager->flush();

        return $response;
    }
}
