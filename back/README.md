
# Desafio Promobit - Back-end

Este projeto foi desenvolvido com:

- Laravel - 6.2
- PHP - 7.4
- MySQL - 5.7+



## Instalação

Para instalar o projeto, siga os passos abaixo:

1º - Execute o docker (utilizando o laradock do projeto)

2º - Ainda no terminal e dentro da pasta do laradock, execute o seguinte comando:

- 2.1 - Pegue o ip do container mysql utilizando o seguinte comando 
```bash
  docker inspect -f '{{.Name}} - {{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' $(docker ps -aq)
```
- 2.2 - Entre no container workspace para poder prosseguir:

```bash
  docker-compose exec workspace bash
```

3º - Acesse a pasta do Back-end dentro do projeto e instale as dependencias necessárias do projeto:
```bash
  cd back
  composer install
```
4º - Crie o arquivo .env com base no .env.example, pode utilizar o comando:
```bash
  cp .env.example .env
```
5º - Dentro do .env, altere a constante DB_HOST com o ip do container que foi passado na etapa 2.

6º - Rode o seguinte comando para criar as tabelas no banco:
```bash
  php artisan migrate
```

7º - Em seguida, execute o comando:
```bash
  php artisan db:seed
```

6º - API está pronta.

    
## Funcionalidades

- Autenticação de usuário utilizando JWT
- Logout
- Criação, Edição, Leitura e Exclusão de Tags 
- Criação, Edição, Leitura e Exclusão de Produtos
- Criação, Edição, Leitura e Exclusão de Usuários
- Exportação de relatórios em PDF


## Relatório

Script SQL para retirada de relatório por relevancia de produto.
```bash
SELECT t.name, p.name  
FROM product p , product_tag pt ,tag t
WHERE  pt.product_id  = p.id  AND pt.tag_id =t.id 
```