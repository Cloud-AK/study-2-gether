<?php

spl_autoload_register(function ($nomeClasse) {
    // 1. Define o caminho base da pasta que o professor pediu (app/)
    $baseDir = __DIR__ . '/app/';

    // 2. Se a classe terminar com "Controller", procura na pasta app/controller/
    if (str_ends_with($nomeClasse, 'Controller')) {
        $caminhoArquivo = $baseDir . 'controller/' . $nomeClasse . '.php';
    } 
    // 3. Se a classe terminar com "Repository", procura na pasta app/repository/
    // (Isso vai carregar seu UserRepository e IUserRepository automaticamente!)
    elseif (str_ends_with($nomeClasse, 'Repository')) {
        $caminhoArquivo = $baseDir . 'repository/' . $nomeClasse . '.php';
    } 
    // 4. Se a classe terminar com "Model", procura na pasta app/model/
    elseif (str_ends_with($nomeClasse, 'Model')) {
        $caminhoArquivo = $baseDir . 'model/' . $nomeClasse . '.php';
    } 
    // 5. Caso seja outra classe geral (como a Database)
    else {
        $caminhoArquivo = __DIR__ . '/' . $nomeClasse . '.php';
    }

    // Se o arquivo existir no computador, o PHP inclui ele automaticamente
    if (file_exists($caminhoArquivo)) {
        require_once $caminhoArquivo;
    }
});