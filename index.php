<?php

$page = isset($_GET["page"]) ? $_GET["page"] : "jogos";
$action = isset($_GET["action"]) ? $_GET["action"] : "index";
$id = isset($_GET["id"]) ? $_GET["id"] : null;

switch ($page) {
    case "jogos":
        switch ($action) {
            case "index":
                include __DIR__ . '/../views/jogos/index_game.php';
                break;
            case "create":
                include __DIR__ . '/../views/jogos/create_game.php';
                break;
            case "edit":
                include __DIR__ . '/../views/jogos/edit_game.php';
                break;
            case "delete":
                include_once __DIR__ . '/../controllers/jogoController.php';
                $controller = new jogoController();
                if ($controller->delete($id)) {
                    header("Location: /crud_php/public/index.php?page=jogos");
                    exit();
                } else {
                    echo "<p class=\'error\'>Não foi possível deletar esse jogo.</p>";
                }
                break;
            default:
                include __DIR__ . '/../views/jogos/index_game.php';
                break;
        }
        break;
    case "consoles":
        switch ($action) {
            case "index":
                include __DIR__ . '/../views/consoles/index_console.php';
                break;
            case "create":
                include __DIR__ . '/../views/consoles/create_console.php';
                break;
            case "edit":
                include __DIR__ . '/../views/consoles/edit_console.php';
                break;
            case "delete":
                include_once __DIR__ . '/../controllers/consoleController.php';
                $controller = new ConsoleController();
                if ($controller->delete($id)) {
                    header("Location: /crud_php/public/index.php?page=consoles");
                    exit();
                } else {
                    echo "<p class=\'error\'>Não foi possível deletar esse console.</p>";
                }
                break;
            default:
                include __DIR__ . '/../views/consoles/index_console.php';
                break;
        }
        break;
    default:
        include __DIR__ . '/../views/jogos/index_game.php';
        break;
}

?>