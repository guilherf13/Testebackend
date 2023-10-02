<div align="center" id="top"> 
  <img src="./.github/app.gif" alt="Ambiente_de_desenvolvimentos_scs" />

  &#xa0;

  <!-- <a href="https://ambiente_de_desenvolvimentos_scs.netlify.app">Demo</a> -->
</div>

<h1 align="center">Teste de backend</h1>

<p align="center">
  <img alt="Github top language" src="https://img.shields.io/github/languages/top/{{YOUR_GITHUB_USERNAME}}/ambiente_de_desenvolvimentos_scs?color=56BEB8">

  <img alt="Github language count" src="https://img.shields.io/github/languages/count/{{YOUR_GITHUB_USERNAME}}/ambiente_de_desenvolvimentos_scs?color=56BEB8">

  <img alt="Repository size" src="https://img.shields.io/github/repo-size/{{YOUR_GITHUB_USERNAME}}/ambiente_de_desenvolvimentos_scs?color=56BEB8">

  <img alt="License" src="https://img.shields.io/github/license/{{YOUR_GITHUB_USERNAME}}/ambiente_de_desenvolvimentos_scs?color=56BEB8">

  <!-- <img alt="Github issues" src="https://img.shields.io/github/issues/{{YOUR_GITHUB_USERNAME}}/ambiente_de_desenvolvimentos_scs?color=56BEB8" /> -->

  <!-- <img alt="Github forks" src="https://img.shields.io/github/forks/{{YOUR_GITHUB_USERNAME}}/ambiente_de_desenvolvimentos_scs?color=56BEB8" /> -->

  <!-- <img alt="Github stars" src="https://img.shields.io/github/stars/{{YOUR_GITHUB_USERNAME}}/ambiente_de_desenvolvimentos_scs?color=56BEB8" /> -->
</p>

<!-- Status -->

<!-- <h4 align="center"> 
	🚧  Ambiente_de_desenvolvimentos_scs 🚀 Under construction...  🚧
</h4> 

<hr> -->

<p align="center">
  <a href="#dart-about">About</a> &#xa0; | &#xa0; 
  <a href="#sparkles-features">Features</a> &#xa0; | &#xa0;
  <a href="#rocket-technologies">Technologies</a> &#xa0; | &#xa0;
  <a href="#white_check_mark-requirements">Requirements</a> &#xa0; | &#xa0;
  <a href="#checkered_flag-starting">Starting</a> &#xa0; | &#xa0;
  <a href="#memo-license">License</a> &#xa0; | &#xa0;
  <a href="https://github.com/{{YOUR_GITHUB_USERNAME}}" target="_blank">Author</a>
</p>

<br>

## :dart: Sobre o Projeto ##

Esse projeto é a resolução de um texte onde foi exigido: Criação de user com autenticação, alteração de senha do user e 
envio de email para alteração de senha. Aproveitei para criar um ambiente em docker com todos os serviços ultilizados na 
aplicação. 

## :rocket: Tecnologias ultilizadas ##

Ferramentas ultilizadas no projeto:

- [Laravel](https://laravel.com/docs/10.x)
- [Postgres](https://www.postgresql.org/)
- [Docker](https://www.docker.com/)
- [MailHog](https://hub.docker.com/r/mailhog/mailhog/)

## :white_check_mark: Requirements ##

Para rodar o projeto, você vai precisar do docker [Docker](https://www.docker.com/).

## :checkered_flag: Subindo o ambiente de desenvolvimento ##

```bash
# Clone o projeto
$ git clone https://github.com/guilherf13/SCS_DevOps

# Executando o ambiente

$ cd teste_backend
$ cd backend
$ cp .env.example .env
$ cd ..
$ cd ..
$ sudo chmod -R 777 teste_backend
$ cd teste_backend
$ docker compose up -d --build
$ docker exec -it backend composer install
$ docker exec -it backend php artisan key:generate

# A aplicação esta rodando nas seguintes rotas:

# laravel <http://localhost:80>
# meilhog (http://localhost:8025>
# postgres port 5432
```
## Documentação da API

```http
  POST /login
```
#### Retorna retorna um objeto json contendo uma mensagem de sucesso e o token criado.

| Parâmetro   | Tipo       | Descrição                           |
| :---------- | :--------- | :---------------------------------- |
| `email` | `json string` | *Obrigatório*. É o email do user |
| `password` | `json string ` | Obrigatório. É o senha do user|
| `device_name` | `json string` | Obrigatório. É o nome do dispositivo do user (Celular, TV..)  |
|  **Rota:** |URL http://localhost:80/api/mail-reset |
|  **Formato:** |{"email": "teste@gmail.com", "password": 12345678, "device_name": "TV"} |

```http
  POST /registry
```
#### Retorna o token criado com codigo 201. 

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `name`      | `json string` | Obrigatório. O nome do user |
| `email`     | `json string` | Obrigatório. O email do user |
| `password`  | `json string` | Obrigatório. A senha do user |
| **Rota:**   | URL http://localhost:80/api/registry  |
| **Formato:** | {"name":"nameTeste, "email":"emailTeste@hotmail.com, "password":12345678} |

```http
  POST /mail-reset
```
#### Envia um formulario com o link de redefinição de senha para o email do user.
#### retorna uma mensagem com testo: 'E-mail de redefinição de senha enviado com sucesso'.

| Parâmetro   | Tipo       | Descrição                                   |
| :---------- | :--------- | :------------------------------------------ |
| `email`     | `json string` | Obrigatório. O email do user |
| **Rota:**   | URL http://localhost:80/api/mail-reset |
| **Formato:** | {"email":"emailTeste@hotmail.com} |

## :memo: License ##

This project is under license from MIT. For more details, see the [LICENSE](LICENSE.md) file.


Made with :heart: by <a href="https://github.com/guilherf13" target="_blank">{{guilherme}}</a>

&#xa0;

<a href="#top">Back to top</a>
