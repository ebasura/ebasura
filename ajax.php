    <?php
    include_once 'init.php';

    if (isset($_POST['action'])){

        $action = $_POST['action'];

        switch($action){

            case 'userLogin':
                /** @var $login */
                $response = $login->userLogin($_POST['username'], $_POST['password'], $_POST['token'], $_POST['remember']);
                
                break;

            case 'userRegister':
                adminAccessOnly();
                $register = new Register();
                $response = $register->userRegister($_POST['username'], $_POST['email'], $_POST['password'], $_POST['confirm_password'], $_POST['user_role']);
                break;
            
            case 'deleteUser':
                adminAccessOnly();
                $user = new User(); 
                $user->deleteUser($_POST['user_id']);
                break;

            case 'editUser':
                adminAccessOnly();
                $user = new User(); 
                $user->editUser($_POST['user_id'], $_POST['username'], $_POST['email'], $_POST['role'], $_POST['password']);
                break;

            case 'fetchUser':
                adminAccessOnly();
                $user = new User(); 
                $user->fetchUser($_POST['user_id']);
                break;
            case 'editProfile':
                $user = new User();

                $avatar = !empty($_FILES['avatar']) ? $_FILES['avatar'] : '';
                $response = $user->editProfile($avatar ,$_POST['first_name'], $_POST['last_name']);
              
                break;
            case 'changeEmail':
                $user = new User();
                    $response = $user->changeEmail($_POST['email']);
                break;
            case 'changePassword':
                $user = new User();
                $response = $user->changePassword($_POST['oldPassword'], $_POST['newPassword'], $_POST['confirmPassword']);
           
                break;

            case 'confirmAccount':

                $register = new Register();
                $response = $register->confirmAccount($_POST['key']);
            
                break;

            case 'sendResetCode':

                $reset = new PasswordReset();
                $response = $reset->RequestResetPassword($_POST['email']);

                break;

            case 'resetPassword':

                $reset = new PasswordReset();
                $response = $reset->resetPassword($_POST['new_password'], $_POST['key']);
                break;

            case 'verifyUser':
                $tfa = new TwoFactorAuthentication;
                $tfa->verifyUser($_POST['password']);
                break;
            case 'requestTfa':
                
                $tfa = new TwoFactorAuthentication;
                $tfa->sendTfaResponse();

                break;
            
            case "verifySecretKey":
                $tfa = new TwoFactorAuthentication;
                $tfa->enableTfa($_POST['secret_key'], $_POST['code']);  
                break;

            case 'tfaChallenge':
                $tfa = new TwoFactorAuthentication;

                $tfa->tfaLogin($_POST['code']);
                break;
            
            case 'disableTfa':
                $tfa = new TwoFactorAuthentication;
                $tfa->disableTfa();
                break;

            // Datatables 
            case 'dtFetchLogs':
                $dt = new Datatable();
                $dt->wasteLogs();
                break;

            case 'editCurrentTrashBin':
                $res = new SystemSettings();
                $res->setCurrentTrashBin($_POST['bin_id']);
            default:
                break;

        }
    }

function adminAccessOnly(){
    $user = new User(); 
    if(!$user->adminAccessOnly()){
        echo json_encode(["success"=> false, "message" => "You have no permission to do this"]);
        return false;
    }
    return true;
}