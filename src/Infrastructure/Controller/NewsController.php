<?php

namespace Pasha234\HwArchitecture\Infrastructure\Controller;

use Pasha234\HwArchitecture\Application\DTO\Request\AddNewsMaterialRequestDto;
use Pasha234\HwArchitecture\Application\DTO\Request\GenerateReportRequestDto;
use Pasha234\HwArchitecture\Application\UseCase\AddNewsMaterial;
use Pasha234\HwArchitecture\Application\UseCase\GenerateReport;
use Pasha234\HwArchitecture\Application\UseCase\GetNews;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Pasha234\HwArchitecture\Infrastructure\Dto\NewsItemDto;

class NewsController extends BaseJsonController
{
    #[Route('/api/news/report', name: 'api_news_report_generate', methods: ['POST'])]
    public function generateReport(Request $request, GenerateReport $generateReport): JsonResponse
    {
        return $this->handleRequest(function() use ($request, $generateReport) {
            $data = $request->toArray();
    
            $ids = $data['ids'] ?? null;
    
            if (!is_array($ids) || empty($ids)) {
                return new JsonResponse(
                    ['error' => 'Invalid input. "ids" (array) are required.'],
                    Response::HTTP_BAD_REQUEST
                );
            }
    
            foreach ($ids as $id) {
                if (!is_int($id)) {
                    return new JsonResponse(
                        ['error' => 'Invalid input. All "ids" must be integers.'],
                        Response::HTTP_BAD_REQUEST
                    );
                }
            }
    
            $response = $generateReport->execute(new GenerateReportRequestDto(
                $ids
            ));

            return new JsonResponse(['report_link' => $response->getUrl()], Response::HTTP_OK);
            
        });
    }

    #[Route('/api/news', name: 'api_news_get_all', methods: ['GET'])]
    public function getAllNews(GetNews $getNews): JsonResponse
    {
        return $this->handleRequest(function() use ($getNews) {
            $newsDtos = $getNews->execute();

            return new JsonResponse($newsDtos, Response::HTTP_OK);
        });
    }

    #[Route('/api/news', name: 'api_news_create', methods: ['POST'])]
    public function addNewsMaterial(Request $request, AddNewsMaterial $addNewsMaterial)
    {
        return $this->handleRequest(function() use ($request, $addNewsMaterial) {
            $data = $request->toArray();
    
            $url = $data['url'] ?? null;
    
            if (!is_string($url) || empty($url)) {
                return new JsonResponse(
                    ['error' => 'Invalid input. "url" (string) are required.'],
                    Response::HTTP_BAD_REQUEST
                );
            }

            $response = $addNewsMaterial->execute(new AddNewsMaterialRequestDto(
                $url
            ));

            return new JsonResponse(['id' => $response->getId()], Response::HTTP_CREATED);
        });
    }
}
