<?php
namespace MyProject\Controllers;

use Vendor\Controllers\ParentController;
use MyProject\Models\Users\User;
use MyProject\Exceptions\InvalidArgumentException;
use MyProject\Models\Users\UserActivationService;
use Vendor\Services\EmailSender;

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
    public function activate(): void {
        
    }
}