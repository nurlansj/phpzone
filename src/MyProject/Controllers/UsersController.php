<?php
namespace MyProject\Controllers;

use Vendor\Controllers\ParentController;
use MyProject\Models\Users\User;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\UserActivationService;
use Vendor\Services\EmailSender;
use MyProject\Exceptions\ActivationException;

class UsersController extends ParentController 
{
    public function signUp() {
        if (!empty($_POST)) {
            try {
                $user = User::signUp($_POST);
            } catch (InvalidArgumentException $e) {
                $this->view->renderHtml('signUp.php', ['error' => $e->getMessage()]);
                return;
            }
            if ($user instanceof User) {
                $code = UserActivationService::createActivationCode($user);
                EmailSender::send($user, 'Активация', 'userActivation.php', [
                    'userId' => $user->getId(),
                    'code' => $code
                ]);
                $this->view->renderHtml('signUpSuccesfull.php');
                return;
            }           
        }
        $this->view->renderHtml('signUp.php');
    }
    public function activate(int $userId, string $activationCode): void {
        try {
            $user = User::getById($userId);
            if ($user === null) {
                throw new ActivationException('Нет такого пользователя');
            }
            if ($user->getIsConfirmed() == 1) {
                throw new ActivationException('Пользователь уже активирован');
            }
            $isCodeValid = UserActivationService::checkActivationCode($user, $activationCode);
            if ($isCodeValid === false) {
                throw new ActivationException('Код активации не верен');
            }
            $user->activate();
            UserActivationService::deleteActivationCode($userId);
            $this->view->renderHtml('ActivationSuccesfull.php');
            return;
        } catch (ActivationException $e) {
            $this->view->renderHtml('../errors/activationError.php', ['message' => $e->getMessage()]);
            return;
        }
    }
}