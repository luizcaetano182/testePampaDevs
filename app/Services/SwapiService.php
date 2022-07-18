<?php

namespace App\Services;

use App\Models\ExchangeRate;
use Goutte\Client;
use Illuminate\Support\Facades\Http;
use App\Models\Person;
use App\Models\Planet;
use App\Models\Starship;



class SwapiService
{
    public function fetchAll (){
        $this->fetchPlanets();
        $this->fetchStarships();
        $this->fetchPeople();
    }

    public function fetchPeople(){
        $i = 1;
        do {
            $response =  Http::get('https://swapi.dev/api/people/?page='. $i)->json();
            foreach($response['results'] as $person){
                $id =  array_filter(explode('/',$person['url']));
                $id = end($id);
                $id_planet_externa =  array_filter(explode('/',$person['homeworld']));
                $id_planet_externa = end($id_planet_externa);
                $planet = Planet::where('external_id',$id_planet_externa)->select('id')->first();
                $id_planet = $planet['id'];
                $data = [
                    'name' => $person['name'],
                    'height' => $person['height'],
                    'mass' => $person['mass'],
                    'hair_color' => $person['hair_color'],
                    'skin_color' => $person['skin_color'],
                    'eye_color'=> $person['eye_color'],
                    'birth_year' => $person['birth_year'],
                    'gender' => $person['gender'],
                    'external_id' => $id,
                    'planet_id' => $id_planet
                ];
                $register = Person::updateOrCreate($data);
                $list = [];
                foreach($person['starships'] as $starship){
                    $id =  array_filter(explode('/',$starship));
                    $id = end($id);
                    array_push($list,$id); 
                }
                $register->starships()->sync($list);
            }
            $i++;
        } while($response['next'] != null);
    }

    public function fetchPlanets(){
        $i = 1;
        do {
            $response =  Http::get('https://swapi.dev/api/planets/?page='. $i)->json();
            foreach($response['results'] as $planet){
                $id =  array_filter(explode('/',$planet['url']));
                $id = end($id);
                $data = [
                    'name' => $planet['name'],
                    'rotation_period' => $planet['rotation_period'],
                    'orbital_period' => $planet['orbital_period'],
                    'diameter' => $planet['diameter'],
                    'climate' => $planet['climate'],
                    'gravity' => $planet['gravity'],
                    'terrain' => $planet['terrain'],
                    'surface_water' => $planet['surface_water'],
                    'population' => $planet['population'],
                    'external_id' => $id
                ];
                Planet::updateOrCreate($data);
               
            } 
            $i++;
        } while($response['next'] != null);
    }

    public function fetchStarships(){
        $i = 1;
        do {
            $response =  Http::get('https://swapi.dev/api/starships/?page='. $i)->json();
            foreach($response['results'] as $starship){
                $id =  array_filter(explode('/',$starship['url']));
                $id = end($id);
                $data = [
                    'name' => $starship['name'],
                    'model'  => $starship['model'],
                    'manufacturer'  => $starship['manufacturer'],
                    'cost_in_credits'  => $starship['cost_in_credits'],
                    'length'  => $starship['length'],
                    'max_atmosphering_speed'  => $starship['max_atmosphering_speed'],
                    'crew'  => $starship['crew'],
                    'passengers'  => $starship['passengers'],
                    'cargo_capacity'  => $starship['cargo_capacity'],
                    'hyperdrive_rating'  => $starship['hyperdrive_rating'],
                    'MGLT'  => $starship['MGLT'],
                    'starship_class' => $starship['MGLT'],
                    'external_id' => $id
                ];
                Starship::updateOrCreate($data);
               
            }
            $i++;
        } while($response['next'] != null);
    }
}
