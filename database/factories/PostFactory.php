<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {         //para hacer pruebas de que si guardan en la bd
        // (faker) es una libreria muy popular
        return [              //(sentence()  va a crear un enunciado de 5 palabras)
    'titulo' => $this->faker->sentence(5),
    'descripcion' => $this->faker->sentence(20) ,
    'imagen' => $this->faker->uuid().'.jpg' , //me va atomar todo en nombre de la imagen junto con el tipo de archivo si recortar
    'user_id' => $this->faker->randomElement([1,2,3,4,5]) //me va a toamar un id de ususario aliatorio

        ];
    }
}
