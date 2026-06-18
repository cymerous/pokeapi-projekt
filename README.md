# Pokemon Project with Pokemon API and custom pokemons database - Zadanie rekrutacyjne

REST API Application made in Laravel (v12.x), for agregation, caching and data managment about Pokemons using official PokeAPI and custom database.

## Installation and running

Requirements: PHP >= 8.2, Composer

1. **Clone repository and enter the directory:**
    ```bash
    git clone https://github.com/cymerous/pokeapi-projekt.git
    cd pokeapi-projekt
    ```
2. **Installing dependencies:**
    ```bash
    composer install
    ```
3. **Preparing env file:**
    ```bash
    cp .env.example .env
    ```
4. **Database configuration (SQLite):**
    IMPORTANT YOUR `.env` FILE MUST HAVE THE FOLLOWING SETTING:
    ```env
    DB_CONNECTION=sqlite
    ```
5. **Run migrations:**
    ```bash
    php artisan migrate
    ```
6. **Configure Admin Auth Key:**
    Add your key at the bottom of `.env` file:
    ```env
    ADMIN_KEY=YourMegaUltraSecretKey123
    ```
    *You'll need to use this in your HTTP requests headers as `X-SUPER-SECRET-KEY`.*

7. **Start the local server:**
    ```bash
    php artisan serve
    ```

## POSTMAN TESTING

You Can import the `postman_testing.json` file into Postman to get ready-use collection of all endpoints.

## API REFERENCE
Most of the endpoints requires authorization header:
`X-SUPER-SECRET-KEY: <value_from_.env>`
### 1. Listing Pokemons Information (Public)
* **Endpoint:** `/api/info`
* **Method:** `POST`
* **Headers:** `Accept: application/json`

**Example JSON Body:**
```json
{
    "pokemon_names": ["pikachu", "charizard", "test-nieistniejacy", "test_pokemon"]
}
```

Possible Responses:
* `200 OK`

Example response:
```json
{
    "count": 2,
    "pokemons": [
        {
            "name": "pikachu",
            "types": [
                "electric"
            ],
            "height": 4,
            "weight": 60,
            "is_custom": false
        },
        {
            "name": "charizard",
            "types": [
                "fire",
                "flying"
            ],
            "height": 17,
            "weight": 905,
            "is_custom": false
        }
    ]
}
```

### 2. Ban Pokemon (Admin)
* **Endpoint:** `/api/banned`
* **Method:** `POST`
* **Headers:** `Accept: application/json`

**Example JSON Body:**
```json
{
    "name": "charizard"
}
```

Possible Responses:
* `201 Created`
* `400 Bad Request`
* `401 Unauthorized`

Example response:
```json
{
    "name": "charizard",
    "updated_at": "2026-06-18T20:25:03.000000Z",
    "created_at": "2026-06-18T20:25:03.000000Z",
    "id": 2
}
```

### 3. Unban Pokemon (Admin)
* **Endpoint:** `/api/banned/{name}`
* **Method:** `DELETE`
* **Headers:** `Accept: application/json`

Possible Responses:
* `204 No Content`
* `404 Not found`

### 4. List banned pokemons (Admin)
* **Endpoint:** `/api/banned/`
* **Method:** `GET`
* **Headers:** `Accept: application/json`

Possible Responses:
* `200 OK`
* `404 Not found`

Example response:
```json
[
    {
        "id": 3,
        "name": "charizard",
        "created_at": "2026-06-18T20:41:44.000000Z",
        "updated_at": "2026-06-18T20:41:44.000000Z"
    }
]
```

### 5. Add Custom Pokemon (Admin)
* **Endpoint:** `/api/pokemon/`
* **Method:** `POST`
* **Headers:** `Accept: application/json`

**Example JSON Body:**
```json
{
    "name": "test_pokemon",
    "types": ["code", "flying"],
    "height": 20,
    "weight": 40
}
```

Possible Responses:
* `200 OK`
* `400 Bad Request`

Example response:
```json
{
    "name": "test_pokemon",
    "types": [
        "code",
        "flying"
    ],
    "height": 20,
    "weight": 40,
    "updated_at": "2026-06-18T20:31:44.000000Z",
    "created_at": "2026-06-18T20:31:44.000000Z",
    "id": 1
}
```
