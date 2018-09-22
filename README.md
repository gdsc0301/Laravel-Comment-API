# Laravel-Comment-Platform

* Name: ComMeeting API
* Author: Guilherme dos Santos Carvalho
* Target: BetaLabs
* Date: 17/09/2018

Sumário
 - Introdução
 - Executando a aplicação.
   - Como funciona?
   - Comentários
   - Usuários
 - Considerações finais.


 ## INTRODUÇÃO


Projeto requisitado pelo Diego, para o 
processo seletivo para estágiário para 
Back-End Developer.

Apesar de ter comentado a API inteira
em Inglês, prefiro escrever aqui em
Português, já que se destina a apenas
Brasileiros (eu acho).

Demorei mais do que eu esperava para
desenvolver esta API.

Nunca tinha ouvido falar em Laravel
antes, mas como sou curioso, quando
recebi o desafio de aprender Laravel
enquanto desenvolvia esta aplicação
topei imediatamente.

Tive que refazer o projeto quando descobri que o Laravel
fazia automaticamente muita coisa que
eu estava fazendo manualmente, e não
estava ficando muito bom.

Sei que não precisava fazer a parte
gráfica, mas como eu estava aprendendo,
vi que era uma boa oportunidade para
isso. 

Então acabei desenvolvendo uma
plataforma simples, porém completa,
que permite que os usuários se cadastrem,
loguem, sejam lembrados por token e que
enviem mensagens, e estas sejam exibidas
na página (ao atualizar) e possam ser
atualizadas e excluídas apenas por seus
autores, em uma interface onde é exibido
a data de criação e ultima atualização.

## Executando a aplicação

Fiz o máximo para ser simples a execução em um servidor local. Basta confiurar o .env com a configuração do seu banco de dados,
executar o comando: 

 *php artisan migrate:fresh

Não precisa alterar o local da raíz do servidor, no meu caso utilizo XAMPP, então configurei os HTML 'Post' para ir ao endereço
completo da aplicação, "laravel/public".

## Como funciona?

É muito simples, ao entrar no link "http://localhost/laravel/public" verá a tela básica do Laravel, onde haverá os botões 
"Login" e "Register" no canto superior esquerdo.
Clique no botão "Register" faça seu registro normalmente.

## Comentários

Após dar "submit" nos dados, será redirecionado para o "dashboard", onde haverá um local para digitar seu comentário.
 - Envie um comentário qualquer.
Após clicar em "Enviar" verá o comentário abaixo, e todas as vezes seguintes que acessar.
Todos os comentários são exibidos, inclusive de outros usuários. No entando, só poderão ser editados ou deletados pelos
autores dos mesmos.
Ao lado de todos os comentários criados por você, será exibido dois "botões": edit e drop.
 - edit, habilita uma caixa de texto para que o comentário seja exibido.
 - drop, deleta o comentário.
 
## Usuários

Se quiser pode clicar no nome do Autor do comentário, que estará em azul. Ao clicar exibirá uma página de perfil simples.
Se você estiver logado na conta daquele perfil, será habilitado alguns menus para alteração de seus dados, como
 * Avatar (não funcionando)
 * Nome
 * Email
 * Senha

## Considerações finais
A questão da imagem de perfil do usuário é complicada,
as imagens estão armazenadas na pasta '/public/avatar', e são obtidas usando
'asset("avatar/id-do-usuário.png"), ou seja, apenas se houver uma imagem
no diretório nomeada com o id-do-usuário.png (sim em .png) ela é exibida normalmente
nos comentários que pertencem aos seus respectivos autores.
Para que o usuário pudesse enviar uma foto eu precisaria de um pouco mais
de tempo de estudo, e não quero correr o risco, porque aliás já demorei muito mais
que devia para entregar este projeto.
