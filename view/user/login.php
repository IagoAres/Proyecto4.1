<?php
ob_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    </head>
    <body>
        <?php
        /* if (isUserLoggedIn()) {
          redirectToNextPage();
          exit;
          } */
        ?>

        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-6">
                    <form method="post">
                        <!-- Email input -->
                        <div class="form-group mb-4 ">
                            <label class="form-label" for="email">Email address</label>
                            <input type="email" id="email" class="form-control" name="email"  required/>

                        </div>

                        <!-- Current Password input -->
                        <div class="form-group mb-4">
                            <label class="form-label" for="currentPwd">Contraseña actual</label>
                            <input type="password" id="currentPwd" class="form-control" name="pwd" required/>

                        </div>

                        <!-- Current Password input -->
                        <div class="form-group mb-4">
                            <label class="form-label" for="rol">Seleccione el rol:</label>

                            <select name="rol" id="rol" required>
                                <?php foreach (APP_ROLES as $key => $value) { ?>


                                    <option value="<?= $key ?>"> <?= $value ?> </option>
                                <?php } ?>
                            </select>              </div>


                        <!-- Submit button -->
                        <input type="submit" class="btn btn-primary btn-block mb-4" value="Iniciar sesión"></button>
                    </form>

                    <?php

                    function redirectToNextPage() {
                        global $app_roles;
                        $roleId = $_SESSION["roleId"];
                        if (APP_ROLES[$roleId] == ADMIN_ROLE) {
                            header('Location: ../admin.php');
                        } elseif (APP_ROLES[$roleId] == USER_ROLE) {
                            header('Location: welcome.php');
                        }
                    }

                    $usuarios = array("user1@edu.es" =>
                        array("pwd" => SessionManager::encryptPwds("abc123."),
                            "pwd-1" => SessionManager::encryptPwds("aBc123."),
                            "pwd-2" => SessionManager::encryptPwds("abC123."),
                            "roles" => [ADMIN_ROLE, USER_ROLE]),
                        "user2@edu.es" =>
                        array("pwd" => SessionManager::encryptPwds("abc123."),
                            "pwd-1" => SessionManager::encryptPwds("123aBc."),
                            "pwd-2" => SessionManager::encryptPwds("123abC."),
                            "roles" => [USER_ROLE]));

                    const USER_DOES_NOT_EXIST = "No existe usuario";
                    const PWD_INCORRECT = "La contraseña no es correcta";
                    const ROLE_PROBLEM = "No es posible iniciar sesión, no posees permisos de rol.";

                    $exito = false;

                    $errors = array();
                    $user = "";

                    if (isset($_POST["email"]) && isset($_POST["pwd"]) && isset($_POST["rol"])) {
                        $user = $_POST["email"];
                        $pwd = $_POST["pwd"];
                        $rolId = (int) $_POST["rol"];

                        if (!SessionManager::UserExists($user, $usuarios)) {
                            array_push($errors, USER_DOES_NOT_EXIST);
                        } elseif (!SessionManager::CheckPwd($usuarios[$user], $pwd)) {
                            array_push($errors, PWD_INCORRECT);
                        } elseif (!SessionManager::isUserInRole($usuarios[$user], $rolId)) {
                            array_push($errors, ROLE_PROBLEM);
                        } else {
                            SessionManager::iniciarSesion();
                            $_SESSION["user"] = $user;
                            $_SESSION["pwd"] = SessionManager::encryptPwds($_POST["pwd"]);
                            $_SESSION["roleId"] = $rolId;
                            $_SESSION["time"] = time();
                            var_dump($_SESSION);
                            redirectToNextPage();
                            exit;
                        }
                    }
                    ?>

                    <?php if (count($errors) > 0) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php
                            foreach ($errors as $error) {
                                echo $error . "<br/>";
                            }
                            ?>
                        </div>
                    <?php } ?>

                    <?php if ($exito) { ?>
                        <div class="alert alert-success" role="alert">
                            Se ha actualizado correctamente la contraseña <?php print_r($usuarios[$user]) ?>
                        </div>
                        <?php
                    }
                    ob_end_flush();
                    ?>
                </div>
            </div>
        </div>


    </body>
</html>