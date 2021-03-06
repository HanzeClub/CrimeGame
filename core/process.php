<?php
/**
 * Process.php
 * 
 * The Process class is meant to simplify the task of processing user submitted 
 * forms, redirecting the user to the correct pages if errors are found, or if 
 * form is successful, either way. Also handles the logout procedure.
 */
function osFighter_autoloader($class) {
    include strtolower($class) . '.php';
}

spl_autoload_register('osFighter_autoloader');
$database = new Database;
$mailer   = new Mailer;
$session  = new Session;
$form     = new Form;

class Process
{
    /* Class constructor */
    public function Process(){
        global $session;
        /* User submitted login form */
        if (isset($_POST['sublogin'])) {
            $this->procLogin();
        }
        /* User submitted registration form */
        else if (isset($_POST['subjoin'])) {
            $this->procRegister();
        }
        /* User submitted forgot password form */
        else if (isset($_POST['subforgot'])) {
            $this->procForgotPass();
        }
        /* User submitted edit account form */
        else if (isset($_POST['subedit'])) {
            $this->procEditAccount();
        }
        /* Admin submitted configuration changes */
        else if(isset($_POST['configedit'])){
            $this->procConfigEdit();
        }
        /**
        * The only other reason user should be directed here
        * is if he wants to logout, which means user is
        * logged in currently.
        */
        else if ($session->logged_in) {
            $this->procLogout();
        }
        /**
        * Should not get here, which means user is viewing this page
        * by mistake and therefore is redirected.
        */
        else {
            header("Location: ../home");
        }
    }

    /**
    * procLogin - Processes the user submitted login form, if errors
    * are found, the user is redirected to correct the information,
    * if not, the user is effectively logged in to the system.
    */
    private function procLogin(){
        global $session, $form;
        /* Login attempt */
        $retval = $session->login($_POST['user'], $_POST['pass'], isset($_POST['remember']));

        /* Login successful */
        if ($retval) {
            header("Location: ../home");
        }
        /* Login failed */
        else {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: ../login");
        }
    }

    /**
    * procLogout - Simply attempts to log the user out of the system
    * given that there is no logout form to process.
    */
    private function procLogout(){
        global $database, $session;
        $config = $database->getConfigs();
        $retval = $session->logout();
        header("Location: ../home");
    }

    /**
    * procRegister - Processes the user submitted registration form,
    * if errors are found, the user is redirected to correct the
    * information, if not, the user is effectively registered with
    * the system and an email is (optionally) sent to the newly
    * created user.
    */
    private function procRegister(){
        global $database, $session, $form;
        $config = $database->getConfigs();

        /* Checks if registration is disabled */
        if ($config['ACCOUNT_ACTIVATION'] == 4) {
            $_SESSION['reguname'] = $_POST['user'];
            $_SESSION['regsuccess'] = 6;
            header("Location: ../register");
        }

        /* Convert username to all lowercase (by option) */
        if ($config['ALL_LOWERCASE'] == 1){
            $_POST['user'] = strtolower($_POST['user']);
        }
        /* Hidden form field captcha deisgned to catch out auto-fill spambots */
        if (!empty($_POST['killbill'])) {
            $retval = 2;
        } else {
            /* Registration attempt */
            $retval = $session->register($_POST['user'], $_POST['pass'], $_POST['conf_pass'], $_POST['email'], $_POST['conf_email']);
        }

        /* Registration Successful */
        if ($retval == 0) {
            $_SESSION['reguname'] = $_POST['user'];
            $_SESSION['regsuccess'] = 0;
            header("Location: ../register");
        }
        /* E-mail Activation */
        else if ($retval == 3) {
            $_SESSION['reguname'] = $_POST['user'];
            $_SESSION['regsuccess'] = 3;
            header("Location: ../register");
        }
        /* Admin Activation */
        else if ($retval == 4) {
            $_SESSION['reguname'] = $_POST['user'];
            $_SESSION['regsuccess'] = 4;
            header("Location: ../register");
        }
        /* No Activation Needed but E-mail going out */
        else if ($retval == 5) {
            $_SESSION['reguname'] = $_POST['user'];
            $_SESSION['regsuccess'] = 5;
            header("Location: ../register");
        }
        /* Error found with form */
        else if ($retval == 1) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: ../register");
        }
        /* Registration attempt failed */
        else if ($retval == 2) {
            $_SESSION['reguname'] = $_POST['user'];
            $_SESSION['regsuccess'] = 2;
            header("Location: ../register");
        }
    }

    /**
    * procForgotPass - Validates the given username then if
    * everything is fine, a new password is generated and
    * emailed to the address the user gave on sign up.
    */
    private function procForgotPass(){
        global $database, $session, $mailer, $form;
        $config = $database->getConfigs();
        /* Username error checking */
        $subuser = $_POST['user'];
        $subemail = $_POST['email'];
        $field = "user";  //Use field name for username
        if (!$subuser || strlen($subuser = trim($subuser)) == 0) {
            $form->setError($field, "* Username not entered<br>");
        } else {
            /* Make sure username is in database */
            $subuser = stripslashes($subuser);
            if (strlen($subuser) < $config['min_user_chars'] || strlen($subuser) > $config['max_user_chars'] ||
                (!$database->usernameTaken($subuser))) {
                    $form->setError($field, "* Username does not exist<br>");
            } else if ($database->checkUserEmailMatch($subuser, $subemail) == 0) {
                $form->setError($field, "* No Match<br>");
            }
        }

        /* Errors exist, have user correct them */
        if ($form->num_errors > 0) {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
        }
        /* Generate new password and email it to user */
        else {
            /* Generate new password */
            $newpass = $session->generateRandStr(8);

            /* Get email of user */
            $usrinf = $database->getUserInfo($subuser);
            $email  = $usrinf->email;

            /* Attempt to send the email with new password */
            if ($mailer->sendNewPass($subuser,$email,$newpass,$config)) {
                /* Email sent, update database */
                $usersalt = $session->generateRandStr(8);
                $newpass = sha1($usersalt.$newpass);
                $database->updateUserField($subuser,"password",$newpass);
                $database->updateUserField($subuser,"usersalt",$usersalt);
                $_SESSION['forgotpass'] = true;
            }
            /* Email failure, do not change password */
            else {
                $_SESSION['forgotpass'] = false;
            }
        }

        header("Location: ../forgot-pass");
    }

    /**
    * procEditAccount - Attempts to edit the user's account
    * information, including the password, which must be verified
    * before a change is made.
    */
    private function procEditAccount(){
        global $session, $form;

        // If the user is demo we need to stop him from editing his account.
        if ($session->username == "demo") {
            $_SESSION['useredit'] = false;
            header("Location: ../personal/user-edit");
            return false;
        }

        /* Account edit attempt */
        $retval = $session->editAccount($_POST['curpass'], $_POST['newpass'], $_POST['conf_newpass'], $_POST['email']);

        /* Account edit successful */
        if ($retval) {
            $_SESSION['useredit'] = true;
            header("Location: ../personal/user-edit");
        }
        /* Error found with form */
        else {
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: ../personal/user-edit");
        }
    }

    /**
     * configEdit - function for updating the website configurations in the
     * configuration table in the database.
     */
    private function procConfigEdit(){
        global $session, $form;
        /* Account edit attempt */
        $retval = $session->editConfigs($_POST['sitename'], $_POST['sitedesc'], $_POST['emailfromname'],
            $_POST['adminemail'], $_POST['webroot'], $_POST['home_page'], $_POST['activation'],
            $_POST['min_user_chars'], $_POST['max_user_chars'], $_POST['min_pass_chars'],
            $_POST['max_pass_chars'], $_POST['send_welcome'], $_POST['enable_login_question'],
            $_POST['enable_capthca'], $_POST['all_lowercase'], $_POST['user_timeout'], $_POST['guest_timeout'],
            $_POST['cookie_expiry'], $_POST['cookie_path'], $_POST['currency'], $_POST['number_format']);

        /* Account edit successful */
        if($retval){
            $_SESSION['configedit'] = true;
            header("Location: ../admin/settings");
        }
        /* Error found with form */
        else{
            $_SESSION['value_array'] = $_POST;
            $_SESSION['error_array'] = $form->getErrorArray();
            header("Location: ../admin/settings");
        }
    }
};

$process  = new Process;