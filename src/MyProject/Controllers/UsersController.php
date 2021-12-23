<?php
namespace MyProject\Controllers;

use Vendor\Controllers\ParentController;
use MyProject\Models\Users\User;
use MyProject\Exceptions\InvalidArgumentException;

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
        }
        if ($user instanceof User) {
            $this->view->renderHtml('signUpSuccesfull.php');
            return;
        }
        $this->view->renderHtml('signUp.php');
    }
}