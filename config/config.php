<?php

/* Default options */
const DEFAULT_CONTROLLER = "Usuario";
const DEFAULT_ACTION = "login";

const CONTROLLERS_FOLDER = "controller";

const MODELS_FOLDER = "model";

const REPOSITORIES_FOLDER = MODELS_FOLDER . DIRECTORY_SEPARATOR . "repository";
const ENTITIES_FOLDER = MODELS_FOLDER . DIRECTORY_SEPARATOR . "entity";
const SERVICES_FOLDER = MODELS_FOLDER . DIRECTORY_SEPARATOR . "service";

const INCLUDES_FOLDER = "includes";
const TRAITS_FOLDER = MODELS_FOLDER . DIRECTORY_SEPARATOR . "traits";

const IMAGES_FOLDER = "files";

const IMAGE_DEFAULT = "no-picture.jpg";

const LOGIN_ERROR_MSG = "No se ha podido iniciar sesión";

const ADMIN_ROLE = "admin";
const USER_ROLE = "user";
const APP_ROLES = [ADMIN_ROLE, USER_ROLE];
const MAX_TIME = 600;
ini_set("session.cookie.lifetime", MAX_TIME);
?>