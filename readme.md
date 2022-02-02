Rozwiązanie zadania rekrutacyjnego

Postawienie środowiska:
- sklonować repozytorium
- przejść do głównego folderu projektu
- uruchomić środowisko komendą docker compose up

Migracja bazy:
- przenieść dump bazy do folderu tymczasowego hosta: docker cp php_api:/var/www/config/dump.sql /tmp
- przenieść dump do kontenera bazy za pomocą kmendy: docker cp /tmp/dump.sql mysql_db:/home/
- przejść do kontenera mysql_db: docker exec -it mysql_db sh
- zdumpować bazę poleceniem mysql -u root -p < /home/dump.sql
- podać hasło ("secret")

Listing wszystkich produktów:
- curl localhost:8080/products/
Dodanie nowego produktu:
- curl -X POST localhost:8080/products/ -H "Content-Type: application/json" -d '{"title": "Another Chocolate", "price": 3.50, "currency": "USD"}'
Zmiana ceny istniejącego produktu:
- curl -X PATCH localhost:8080/products/2 -H "Content-Type: application/json" -d '{"price": 3.50}'

Utworzenie nowego koszyka:
- curl -X POST localhost:8080/cart/
Dodanie produktu do koszyka:
- curl -X POST localhost:8080/cart/1 -H "Content-Type: application/json" -d '{"id": 2}'
Listing produktów w koszyku:
- curl localhost:8080/cart/1 