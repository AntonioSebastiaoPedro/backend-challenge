**Places API**

Este projeto fornece uma API para gerenciar lugares: criar, listar, consultar, atualizar e excluir registros de locais.

---

## Índice

* [Descrição](#descri%C3%A7%C3%A3o)
* [Pré-requisitos](#pr%C3%A9-requisitos)
* [Configuração e execução](#configura%C3%A7%C3%A3o-e-execu%C3%A7%C3%A3o)
* [Servidores Disponíveis](#servidores-dispon%C3%ADveis)
* [Rotas e exemplos de uso](#rotas-e-exemplos-de-uso)

  * [Listar lugares (GET /places)](#listar-lugares-get-places)
  * [Criar lugar (POST /places)](#criar-lugar-post-places)
  * [Obter lugar por ID (GET /places/{id})](#obter-lugar-por-id-get-placesid)
  * [Atualizar lugar (PUT /places/{id})](#atualizar-lugar-put-placesid)
  * [Excluir lugar (DELETE /places/{id})](#excluir-lugar-delete-placesid)

---

## Descrição

A **Places API** permite ao desenvolvedor executar operações CRUD em recursos de lugar (Place). Foi construída em Laravel e documentada com OpenAPI 3.0. Nesta API, cada registro contém `id`, `name`, `slug`, `city`, `state`, além dos timestamps padrão.

---

## Pré-requisitos

* Docker e docker-compose

---

## Configuração e execução

1. **Clonar o repositório**

   ```bash
   git clone https://seu-remote/places-api.git
   cd places-api
   ```

2. **Subir o container:**
   ```
   docker-compose up -d
   ```

3. **Entrar no container da aplicação:**
   ```
   docker exec -it laravel-app bash
   ```

4. **Instalar dependências**

   ```bash
   composer install
   ```

5. **Configurar variáveis de ambiente**
   ```
   cp .env.example .env
   php artisan key:generate
   ```


6. **Executar migrações e seeds (se houver)**

   ```bash
   php artisan migrate
   php artisan db:seed
   ```

Pronto! A API estará disponível em `http://localhost:8080/api`.

---

## Servidores Disponíveis

| URL                                | Descrição                   |
| ---------------------------------- | --------------------------- |
| `http://localhost:8080/api/places`        | Servidor de desenvolvimento |

---

## Rotas e exemplos de uso

### Listar lugares (GET /places)

* **O que faz:** Retorna uma lista paginada de lugares cadastrados.
* **Parâmetros de query (opcionais):**

  * `page` (integer): página a retornar (padrão: 1)
  * `per_page` (integer): itens por página (padrão: 15)

#### Passos para executar

1. Faça um GET para:

   ```plaintext
   GET http://localhost:8080/api/places?page=1&per_page=15
   ```
2. Defina o header:

   ```http
   Accept: application/json
   ```
3. Analise a resposta:

   * `data`: array de objetos `Place`.
   * `links`: URLs para navegar entre páginas.
   * `meta`: informações de paginação (current\_page, total, etc.)

#### Exemplo de resposta 200

```json
{
  "data":
  [
    {
        "id": 1,
        "name": "Praça da Sé",
        "slug": "praca-da-se",
        "city": "São Paulo",
        "state": "SP",
        "created_at": "2025-05-14T20:14:09.000000Z",
        "updated_at": "2025-05-14T20:14:09.000000Z"
    },
    {
        "id": 3,
        "name": "Museu do Amanhã",
        "slug": "museu-do-amanha",
        "city": "Rio de Janeiro",
        "created_at": "2025-05-14T20:14:09.000000Z",
        "updated_at": "2025-05-14T20:14:09.000000Z"
    }
  ],
  "links": {
        "first": "http://localhost:8080/api/places?page=1",
        "last": "http://localhost:8080/api/places?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "links": [
            {
                "url": null,
                "label": "&laquo; Previous",
                "active": false
            },
            {
                "url": "http://localhost:8080/api/places?page=1",
                "label": "1",
                "active": true
            },
            {
                "url": null,
                "label": "Next &raquo;",
                "active": false
            }
        ],
        "path": "http://localhost:8080/api/places",
        "per_page": 50,
        "to": 10,
        "total": 10
    }
}
```

### Criar lugar (POST /places)

* **O que faz:** Insere um novo lugar no banco de dados.
* **Body (JSON):**

  * `name` (string, obrigatório)
  * `city` (string, obrigatório)
  * `state` (string, obrigatório)

#### Passos para executar

1. Faça um POST para:

   ```plaintext
   POST http://localhost:8080/api/places
   ```
2. Headers:

   ```http
   Accept: application/json
   Content-Type: application/json
   ```
3. Body de exemplo:

   ```json
   {
     "name": "Museu do Amanhã",
     "city": "Rio de Janeiro",
     "state": "RJ"
   }
   ```
4. Verifique o status:

   * `201`: sucesso (retorna o recurso criado).
   * `422`: erro de validação (campos obrigatórios, slug duplicado).

#### Exemplo de resposta 200

```json
{
   "data":
   {
      "id": 3,
      "name": "Museu do Amanhã",
      "slug": "museu-do-amanha",
      "city": "Rio de Janeiro",
      "created_at": "2025-05-14T20:14:09.000000Z",
      "updated_at": "2025-05-14T20:14:09.000000Z"
   }
}
```

### Obter lugar por ID (GET /places/{id})

* **O que faz:** Retorna detalhes de um único lugar pelo `id`.
* **Parâmetros de path:**

  * `id` (string, obrigatório)

#### Passos para executar

1. Faça um GET para:

   ```plaintext
   GET http://localhost:8080/api/places/3
   ```
2. Header:

   ```http
   Accept: application/json
   ```
3. Respostas possíveis:

   * `200`: retorna o objeto `Place`.
   * `404`: lugar não encontrado.

#### Exemplo de resposta 200

```json
{
  "data":
   {
      "id": 3,
      "name": "Museu do Amanhã",
      "slug": "museu-do-amanha",
      "city": "Rio de Janeiro",
      "created_at": "2025-05-14T20:14:09.000000Z",
      "updated_at": "2025-05-14T20:14:09.000000Z"
   }
}
```

### Atualizar lugar (PUT /places/{id})

* **O que faz:** Modifica um lugar existente.
* **Parâmetros de path:**

  * `id` (string, obrigatório)
* **Body (JSON):** mesmos campos de criação (`name`, `slug`, `city`, `state`)

#### Passos para executar

1. Faça um PUT para:

   ```plaintext
   PUT http://localhost:8080/api/places/1
   ```
2. Headers:

   ```http
   Accept: application/json
   Content-Type: application/json
   ```
3. Body de exemplo:

   ```json
   {
     "name": "Praça da Sé Atualizada",
     "city": "São Paulo",
     "state": "SP"
   }
   ```
4. Respostas possíveis:

   * `200`: lugar atualizado (mensagem + dados atualizados).
   * `404`: lugar não encontrado.
   * `422`: erro de validação.

#### Exemplo de resposta 200

```json
{
  "message": "Place updated successfully",
  "data":
  {
      "id": 3,
      "name": "Museu do Amanhã",
      "slug": "museu-do-amanha",
      "city": "Rio de Janeiro",
      "created_at": "2025-05-14T20:14:09.000000Z",
      "updated_at": "2025-05-14T20:14:09.000000Z"
   }
}
```

### Excluir lugar (DELETE /places/{id})

* **O que faz:** Remove o lugar especificado pelo `id`.
* **Parâmetros de path:**

  * `id` (string, obrigatório)

#### Passos para executar

1. Faça um DELETE para:

   ```plaintext
   DELETE http://localhost:8080/api/places/1
   ```
2. Header:

   ```http
   Accept: application/json
   ```
3. Respostas possíveis:

   * `204`: excluído com sucesso (sem conteúdo).
   * `404`: lugar não encontrado.

---
