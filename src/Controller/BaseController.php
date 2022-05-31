<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BaseController
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function renderTemplate(string $template, array $params = []): Response
    {
        $templateDir = __DIR__ . '/../../templates/';

        if (!file_exists($templateDir . $template)) {
            throw new \Exception("Template '{$template}' not found");
        }

        ob_start();
        require_once $templateDir . $template;
        $content = ob_get_clean();
        return new Response($content);
    }

    protected function getResponse($content): Response
    {
        $response = new Response();
        $response->setContent(json_encode($content))
            ->headers->set('Content-Type', 'application/json');
        return $response;
    }

    protected function getErrorResponse($errors): Response
    {
        $content = [
            "status" => false,
            "errors" => $errors
        ];
        return $this->getResponse($content);
    }
}