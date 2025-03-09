<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class TrainSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        $aziende = ['Trenitalia', 'Italo', 'Frecciarossa', 'Trenord', 'Intercity', 'Regionale'];
        $stazioni = ['Roma Termini', 'Milano Centrale', 'Napoli Centrale', 'Torino Porta Nuova', 'Venezia Santa Lucia', 'Bologna Centrale', 'Bari Centrale', 'Genova Piazza Principe', 'Pisa Centrale', 'Firenze SMN'];

        for ($i = 0; $i < 10; $i++) { // Creiamo 10 treni
            $stazionePartenza = $faker->randomElement($stazioni);
            do {
                $stazioneArrivo = $faker->randomElement($stazioni);
            } while ($stazioneArrivo === $stazionePartenza); // Evitiamo che partenza e arrivo siano uguali

            $orarioPartenza = $faker->dateTimeBetween('now', '+3 days'); // Treni da oggi ai prossimi 3 giorni
            $orarioArrivo = (clone $orarioPartenza)->modify('+' . rand(1, 6) . ' hours'); // Arrivo tra 1 e 6 ore dopo la partenza

            DB::table('trains')->insert([
                'azienda' => $faker->randomElement($aziende),
                'stazione_partenza' => $stazionePartenza,
                'stazione_arrivo' => $stazioneArrivo,
                'orario_partenza' => $orarioPartenza->format('Y-m-d H:i:s'),
                'orario_arrivo' => $orarioArrivo->format('Y-m-d H:i:s'),
                'codice_treno' => strtoupper($faker->bothify('??###')),
                'totale_carrozze' => rand(4, 12),
                'in_orario' => $faker->boolean(80), // 80% dei treni sono in orario
                'cancellato' => $faker->boolean(10), // 10% dei treni sono cancellati
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
