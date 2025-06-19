<?php

namespace Pasha234\HwArchitecture\Infrastructure\Http;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use Pasha234\HwArchitecture\Application\DTO\NewsHttpClient\GetTitleRequestDto;
use Pasha234\HwArchitecture\Application\Port\NewsHttpClient;

class GuzzleNewsClient implements NewsHttpClient
{
    private ClientInterface $httpClient;

    public function __construct(ClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function getTitle(GetTitleRequestDto $getTitleRequestDto): string
    {
        try {
            $response = $this->httpClient->request('GET', $getTitleRequestDto->getUrl());

            if ($response->getStatusCode() !== 200) {
                // Or throw a more specific domain exception
                throw new \RuntimeException("Failed to fetch URL: {$getTitleRequestDto->getUrl()}, Status code: {$response->getStatusCode()}");
            }

            return $this->extractTitleFromHtml($response->getBody()->getContents());

        } catch (RequestException $e) {
            // Log the error: $e->getMessage()
            // Or throw a more specific domain exception
            throw new \RuntimeException("Error fetching title for URL: {$getTitleRequestDto->getUrl()}: " . $e->getMessage(), 0, $e);
        } catch (\Exception $e) {
            // Catch any other unexpected errors during title extraction or processing
            throw new \RuntimeException("Unexpected error processing URL: {$getTitleRequestDto->getUrl()}: " . $e->getMessage(), 0, $e);
        }
    }

    private function extractTitleFromHtml(string $htmlContent): string
    {
        if (preg_match('/<title[^>]*>(.*?)<\/title>/is', $htmlContent, $matches)) {
            return trim(html_entity_decode($matches[1]));
        }

        // Or throw a specific exception if title is mandatory
        return 'Title not found';
    }
}