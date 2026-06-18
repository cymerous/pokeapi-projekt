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
