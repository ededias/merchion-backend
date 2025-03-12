<?php
// src/EventListener/CorsListener.php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\Response;

class CorsListener
{
    public function onKernelRequest(RequestEvent $event)
    {
        $response = $event->getResponse();
        if (!$response) {
            $response = new Response();
        }

        // Configuração CORS
        $response->headers->set('Access-Control-Allow-Origin', '*');  // Pode restringir a origem em produção
        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Max-Age', '3600');

        // Preflight Request (opcional)
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            $event->setResponse($response);
        }
    }
}
