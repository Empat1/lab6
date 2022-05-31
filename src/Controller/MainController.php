<?php

namespace App\Controller;

use App\Pdo\ScreenshotPdo;
use App\Validation\NewScreenshotValidation;
use Symfony\Component\HttpFoundation\Response;


class MainController extends BaseController
{

    public function showFirstScreenshots(array $parameters): Response
    {
        $pdo = new ScreenshotPdo();

        $cards = $pdo->getScreenshots(1);

        return $this->renderTemplate(
            'start.php',
            [
                'session' => $this->request->getSession(),
                'cards' => $cards
            ]
        );
    }

    public function getScreenshots(array $parameters): Response
    {
        $id = $this->request->get('id');
        if (!is_numeric($id)) {
            return new Response('', 400);
        }

        $pdo = new ScreenshotPdo();

        $cards = $pdo->getScreenshots($id);

        return $this->renderTemplate(
            'cards.php',
            ['cards' => $cards]
        );
    }

    public function showDetails(array $parameters): Response
    {
        $uuid = $this->request->get('uuid');
        $pdo = new ScreenshotPdo();

        $screenshot = $pdo->getScreenshotByUuid($uuid);

        return $this->renderTemplate(
            'details.php',
            [
                'screenshot' => $screenshot,
                'session' => $this->request->getSession()
            ]
        );
    }

    public function showForm(): Response
    {
        return $this->renderTemplate(
            'new_screenshot.php',
            ['session' => $this->request->getSession()]
        );
    }

    public function saveScreen(array $parameters): Response
    {
        $data = $this->request->request->all();

        $screenshot = $_FILES['screenshot'];

        $validator = new NewScreenshotValidation($data, $screenshot);
        if (!$validator->isValid()) {
            return $this->getErrorResponse($validator->getErrors());
        }

        $name = $data['name'];

        $screenshot_pdo = new ScreenshotPdo();

        $pathInfo = pathinfo($screenshot['name']);
        $extension = $pathInfo['extension'] ?? "";
        $newPath = '../img/' . uniqid() . '.' . $extension;

        if (!move_uploaded_file($screenshot['tmp_name'], $_SERVER['DOCUMENT_ROOT'].$newPath)) {
            return $this->getErrorResponse(["Ошибка при загрузке скриншота!"]);
        }

        $screenshot_uuid = $screenshot_pdo->saveScreenshot($newPath, $_SESSION["userId"], $name);

        return $this->getResponse([
            'success' => true,
            'uuid' => $screenshot_uuid
        ]);
    }
}