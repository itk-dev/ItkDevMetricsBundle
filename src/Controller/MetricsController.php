<?php

namespace ItkDev\MetricsBundle\Controller;

use ItkDev\MetricsBundle\Service\MetricsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class MetricsController extends AbstractController
{
    private MetricsService $metricsService;

    public function __construct(MetricsService $metricsService)
    {
        $this->metricsService = $metricsService;
    }

    /**
     * Render metrics collected by the application.
     *
     * @return response
     *   HTTP response to send back to the client
     */
    public function metrics(): Response
    {
        return new Response($this->metricsService->render(), Response::HTTP_OK, ['content-type' => 'text/plain']);
    }
}
