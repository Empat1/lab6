<?php

namespace App\Controller;

use App\Pdo\UserPdo;
use App\Validation\Validation;
use \PDOException;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends BaseController
{

    public function register(array $parameters): Response
    {
        $data = $this->request->request->all();

        $errors = Validation::validateRegisterRequest($data);
        if (!empty($errors)) {
            return $this->getErrorResponse($errors);
        }

        try {
            $userPdo = new UserPdo();

            if (!$userPdo->IsEmailUnique($data['email'])) {
                $errors[] = ['Пользователь с данной почтой уже существует!'];
                return $this->getErrorResponse($errors);
            }
            if (!$userPdo->save($data)) {
                $errors[] = ['Не удалось зарегистрировать пользователя. Попробуйте позже.'];
                return $this->getErrorResponse($errors);
            }
        } catch (PDOException $e) {
            $errors[] = ['Не удалось зарегистрировать пользователя. Попробуйте позже.'];
            return $this->getErrorResponse($errors);
        }

        $this->prepareSession($userPdo, $data['email'], $data['login']);

        return $this->getResponse(["success" => true]);
    }

    public function auth(array $parameters): Response
    {
        $data = $this->request->request->all();
        $errors = Validation::validateAuthRequest($data);

        if (!empty($errors)) {
            return $this->getErrorResponse($errors);
        }

        try {
            $userPdo = new UserPdo();

            $user = $userPdo->getUserByLogin($data['login']);
            if (!$user) {
                $errors[] = ['Пользователь с таким логином не найден!'];
                return $this->getErrorResponse($errors);
            }

            if (!$userPdo->getUserIfPasswordVerify($data['login'], $data['password'])) {
                $errors[] = ['Пароль не верный!'];
                return $this->getErrorResponse($errors);
            }
        } catch (PDOException $e) {
            $errors[] = ['Не удалось войти. Попробуйте позже.'];
            return $this->getErrorResponse($errors);
        }

        $this->prepareSession($userPdo, $user['email'], $user['login']);

        return $this->getResponse(["success" => true]);
    }

    public function logout(): Response
    {
        $_SESSION = [];
        $response = new Response();
        $response->headers->set('Refresh', '0; url=/');
        return $response;
    }

    private function prepareSession($userPdo, $email, $login) {
        $_SESSION['userId'] = $userPdo->getUserIdByEmail($email);
        $_SESSION['userLogin'] = $login;
    }
}