<?php
namespace MyProject\Controllers;

use Vendor\Controllers\ParentController;
use MyProject\Models\Users\User;

class UsersController extends ParentController 
{
    public function signUp() {
        if (!empty($_POST)) {
            $user = User::signUp($_POST);
        }
        $this->view->renderHtml('signUp.php');
    }
}