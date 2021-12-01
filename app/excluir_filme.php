<?php

    $id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
    $foto = filter_input(INPUT_POST, "foto", FILTER_SANITIZE_STRING);

    require_once("conexao.php");

    try{
        $comandoSQL = $conexao->prepare("DELETE FROM filme WHERE id=:id");
        $comandoSQL->bindParam(":id", $id);
        $comandoSQL->execute();

        if($comandoSQL->rowCount() > 0){
            header("location:../administracao_filmes.php");

            $dir_imagens = "../imagens/filmes/";

            if ($foto != null) {
                if ($foto != '') {
                    unlink($dir_imagens . $foto);
                }
            }
        }
        else{
            header("location:../administracao_filmes.php");
        }
    }
    catch(PDOException $erro){
        echo $erro->getMessage();
    }