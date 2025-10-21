<?php namespace App\Controllers;

class Blog extends BaseController
{
    public function index()
    {
        // O nome passado para a função view() é o nome do arquivo da View
        // (sem a extensão .php, por padrão).
        return view('blog_view'); 
    }

    // No Controller (app/Controllers/Blog.php)
public function post($slug)
{
    $data = [
        'titulo_pagina' => 'Meu Post do Blog',
        'conteudo_post' => 'Este é o conteúdo do post que veio do Controller.'
    ];

    // O segundo parâmetro é o array de dados
    return view('post_detalhe', $data); 
}
}