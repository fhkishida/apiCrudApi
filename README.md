Regras para rodar a aplicação:
1. Composer Install;
2. cp .env.example .env
3. php artisan jwt:secret para gerar token no .env;
4. rodar php artisan db:seed para gerar as seeds no banco
5. rodar o servidor com php artisan serve
6. acessar a rota de login para receber o token de autenticação
7. adicionar um header authorization com o valor Bearer {{token recebido no passo 5}}
8. be happy!

Rotas:
----------------------------------------------------------------------
    Login:
        localhost:8000/api/login
    Parametros:
        "email": "m2@center.com",
	    "password": 1234
----------------------------------------------------------------------
    Campanhas:       
        list|create
            localhost:8000/api/campaign

        show|update|delete
            localhost:8000/api/campaign/{{id}}   
    parametros:
        create|update
            name: {{nome da campanha}}
----------------------------------------------------------------------
    Grupos:       
        list|create
            localhost:8000/api/group

        show|update|delete
            localhost:8000/api/group/{{id}}   
    parametros:
        create|update
            name: {{nome do grupo}},
            campaign_id: {{id de alguma campanha existente}}
----------------------------------------------------------------------
    Cidades:
        list|create
            localhost:8000/api/city

        show|update|delete
            localhost:8000/api/city/{{id}}   
    parametros:
        create|update
            name: {{nome da cidade}},
            group_id: {{id de algum grupo existente}}
---------------------------------------------------------------------- 
    Produtos:
        list|create
            localhost:8000/api/product

        show|update|delete
            localhost:8000/api/product/{{id}}   
    parametros:
        create|update
            name: {{nome do produto}},
            value: {{valor original do produto}}
----------------------------------------------------------------------

    Descontos:    
        list|create
                localhost:8000/api/productValue

            show|update|delete
                localhost:8000/api/productValue/{{id}}   
    parametros:
        create|update
            product_id: {{id de algum produto existente}},
            campaign_id: {{id de alguma campanha existente}},
            discount: {{valor do desconto aplicado ao produto}}          
----------------------------------------------------------------------

bibliotecas utilizadas:
    JWT-auth;

Instruções:
Desafio M2
Montar uma api RESTful com laravel para alimentar uma SPA com as seguintes funções:
1. Cadastrar/Editar/Listar/Excluir cidades
2. Cadastrar/Editar/Listar/Excluir grupo de cidades
3. Cadastrar/Editar/Listar/Excluir Campanhas para o grupo de cidades onde cada grupo possui somente uma campanha ativa
4. Cadastrar/Editar/Listar/Excluir desconto para os produtos da campanha 
5. Cadastrar/Editar/Listar/Excluir produtos

Obs: As tabelas de relacionamento estão a cargo do desenvolvedor.
Cada cidade possui somente um grupo
Itens extras:

• Montar MER com todos os relacionamentos
Como banco de dados pode ser utilizado ou MySql ou PostgreSQL.
Importante

O projeto deve ser inserido em algum sistema de versionamento, git, bitbucket, etc. 
O banco de dados pode ser somente as migrations com seus respectivos seeders.
No final, enviar as rotas de consulta da api junto com seus respectivos parâmetros

