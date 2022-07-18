## About the project
this api consumes data from https://swapi.dev api
records people their planets and their spaceships.

## Stacks
PHP 7.4.23 | Laravel 8.75 | SqlLite | REST

## Installation

1 - git clone https://github.com/luizcaetano182/testePampadevs.git;
2 - navigate to the project folder;
3 - run composer install;
4 - Rename .env.example to .env
Then just run in terminal `php artisan key:generate`
Configure database sqlLite credentials in .env;
4 - run php artisan migrate;   
5 - run php artisan serve;

## Command Scraping Api
php artisan swapi:run  


## REST API routes
 
Person

- List person
GET: /person

-List person id
GET: /person/id

-Delete person id
DELETE: /person/id

-Update person id
PUT: /person/id

BODY :  
{
    "name": "teste",
    "height": "96",
    "mass": "32",
    "hair_color": "n/a",
    "skin_color": "white, blue",
    "eye_color": "red",
    "birth_year": "33BBY",
    "gender": "n/a",
    "planet_id": "8",
    "external_id": "3"
}

Planet

- List planet
GET: /planet

-List planet id
GET: /planet/id

-Delete planet id
DELETE: /planet/id

-Update planet id
PUT: /planet/id

BODY :  
{
    "name": "Tatooine",
    "rotation_period": "23",
    "orbital_period": "304",
    "diameter": "10465",
    "climate": "arid",
    "gravity": "1 standard",
    "terrain": "desert",
    "surface_water": "1",
    "population": "200000",
    "external_id": "1"
}

Starship

- List starship
GET: /starship

-List starship id
GET: /starship/id

-Delete starship id
DELETE: /starship/id

-Update starship id
PUT: /starship/id

BODY :  
{
    "name": "CR90 corvette",
    "model": "CR90 corvette",
    "manufacturer": "Corellian Engineering Corporation",
    "cost_in_credits": "3500000",
    "length": "150",
    "max_atmosphering_speed": "950",
    "crew": "30-165",
    "passengers": "600",
    "cargo_capacity": "3000000",
    "hyperdrive_rating": "2.0",
    "MGLT": "60",
    "starship_class": "60",
    "external_id": "2"
}
