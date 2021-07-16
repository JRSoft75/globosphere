<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use App\Exception\BadJsonException;
use App\Exception\AuthenticationException;
use App\Entity\App;
use Exception;
use App\Form\UserSearchType;
use Symfony\Component\HttpFoundation\Response;
use FOS\ElasticaBundle\Manager\RepositoryManagerInterface;
use FOS\ElasticaBundle\Finder\PaginatedFinderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use FOS\ElasticaBundle\Manager\RepositoryManager;


class SearchController extends AbstractController
{
    private $repositoryManager;

    public function __construct(RepositoryManagerInterface $repositoryManager)
    {
        $this->repositoryManager = $repositoryManager;
    }
//    /**
//     * @Route("/search", name="search", methods={"POST"})
//     * @param string $search_query
//     * @param Request $request
//     * @param ApiResponse $response
//     * @return JsonResponse
//     */
//    public function search(
//        string $app_path,
//
//        Request $request,
//        ApiResponse $response
//    ): JsonResponse {
//        try {
//            $app = $ar->findOneBy(['path' => $app_path]);
//            if (!$app) {
//                throw new InvalidAppException();
//            }
//            $data = $this->getArrayFromJsonRequest($request);
//            $token = $us->login($data, $app, $ur, $utr);
//            $utr->flush();
//            $response->setMessage('Successfully authorized.');
//            $response->setToken($token);
//        } catch (Exception $e) {
//            $this->catchBlock($e, $response);
//        }
//
//        return $this->json($response->getContent(), $response->getStatus());
//    }

    /**
     * @Route("/", name="blog_list")
     */
    public function indexAction(Request $request): Response
    {
        $userSearch = new User();

        $form = $this->createForm(UserSearchType::class, $userSearch);
        $form->handleRequest($request);
//        if($request->getMethod() === 'POST'){
        dump('getMethod='.$request->getMethod());
        dump('isSubmitted='.$form->isSubmitted());
        $userSearch = $form->getData();
        dump('$userSearch=');
        dump($userSearch);

//        $elasticaManager = $this->get('fos_elastica.manager');
//        $elasticaManager = $this->container->get('fos_elastica.manager');
//        $results = $this->repositoryManager->getRepository('User')->searchUser($userSearch);
//        $results = $this->repositoryManager->getRepository('user')->searchUser((array)$filter);


//        $elasticaManager = $this->get('fos_elastica.manager');
//        $results = $elasticaManager->getRepository('user')->searchUser($userSearch);
        $results = $this->repositoryManager->getRepository(User::class)->searchUser($userSearch);
        dump($results);
        return $this->render('user/search.html.twig', [
            'form' => $form->createView(),
            'filter' => $userSearch,
            'users' => $results
        ]);

    }
}