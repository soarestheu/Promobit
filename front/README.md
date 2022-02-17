
# Desafio Promobit - Front-end

Este projeto foi desenvolvido com:

- Vue.JS


## Instalação

Para instalar o projeto, siga os passos abaixo:

1º - Execute o docker (utilizando o laradock do projeto)

2º - Ainda no terminal e dentro da pasta do laradock, entre no container workspace e execute o seguinte comando:

```bash
  docker-compose exec workspace bash
```

3º - Acesse a pasta do Front-end dentro do projeto e instale as dependencias necessárias:
```bash
  cd front
  npm install
```
4º - No arquivo ```http-common.js``` altere a ```"baseURL"``` e coloque a o link da sua api.

    (Nesse projeto foi utilizado no back-end, uma API com Laravel que se encontra disponivel no link -> [API](https://github.com/soarestheu/Promobit/tree/main/back))

5º - Para rodar o projeto, execute os comandos abaixo no terminal:.

```bash
  npm run serve
```
    
## Funcionalidades

- Login
- Logout
- Listagem de usuários
- Cadastro de usuários
- Edição de usuários
- Exclusão de usuários
- Listagem de produtos
- Cadastro de produtos
- Edição de produtos
- Exclusão de produtos
- Listagem de tags
- Cadastro de tags
- Edição de tags
- Exclusão de tags
- Relatório em PDF