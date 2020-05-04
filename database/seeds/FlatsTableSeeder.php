<?php

use Illuminate\Database\Seeder;
use App\Flat;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


class FlatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // 20 appartamenti totali
        $flats = [
            [
                '1',
                'Appartamento al Colosseo',
                'Appartamento nel centro di Roma. Giardino privato, aria condizionata, riscaldamento, WiFi, Netflix, smart TV 50, colazione inclusi nel prezzo!',
                '4',
                '4',
                '4',
                '2',
                '60',
                '50',
                'images/flat-01.jpg',
                '41.90717',
                '12.465',
                '0'
            ],
            [
                '1',
                'Monolocale indipendente con bagno privato',
                'Tutti, senza distinzioni, siete i benvenuti nel mio monolocale con bagno privato in uno dei quartieri più vivaci e centrali della Roma popolare!',
                '3',
                '3',
                '3',
                '1',
                '40',
                '36',
                'images/flat-02.jpg',
                '41.90793',
                '12.46557',
                '0'
            ],
            [
                '1',
                'Suite Termini con Balcone, Wi-Fi e A/C',
                'B&B nel cuore di Roma a soli 5 minuti a piedi dalla Stazione Termini. Bellissima camera con balcone, tv 32", luce per lettura, bagno in camera, materasso in Memory, appendiabiti!',
                '4',
                '4',
                '3',
                '1',
                '60',
                '56',
                'images/flat-03.jpg',
                '41.91455',
                '12.46529',
                '0'
            ],
            [
                '1',
                'Splendido Loft Appartamento',
                'Il mio loft e\' uno spazio ricavato in palazzo del XXVI secolo nel cuore di Roma unico e accogliente',
                '4',
                '3',
                '3',
                '2',
                '67',
                '76',
                'images/flat-04.jpg',
                '41.92127',
                '12.46378',
                '0'
            ],
            [
                '2',
                'The heart of Napoli',
                'Alloggio molto accogliente situato nel cuore di Napoli a pochissimi passi dai più importanti luoghi di interesse come San Gregorio Armeno,il Duomo, Cappella SanSevero e tanti altri ancora e 100metri dalla famosissima pizzeria da Michele',
                '2',
                '2',
                '3',
                '2',
                '53',
                '66',
                'images/flat-05.jpg',
                '40.86081',
                '14.26787',
                '0'
            ],
            [
                '2',
                'Vecchia Napoli - Santa Lucia',
                'Bilocale su 2 livelli nel bellissimo quartiere di Santa Lucia. Camera da letto soppalcata, salone con letto singolo, cucina, bagno e cabina armadio. Ammezzato senza ascensore. Balcone in salone e aria condizionata.',
                '3',
                '3',
                '4',
                '2',
                '63',
                '88',
                'images/flat-06.jpg',
                '40.86228',
                '14.26985',
                '0'
            ],
            [
                '2',
                'Da Dora',
                'L\'appartamento è poco distante dal centro storico, c\'è un bellissimo terrazzo a vostra disposizione.
                Siamo a poca distanza dalla stazione, dal porto e dalle strade principali.',
                '2',
                '3',
                '2',
                '3',
                '63',
                '68',
                'images/flat-07.jpg',
                '40.86482',
                '14.27105',
                '0'
            ],
            [
                '2',
                'A casa di Luisa',
                'La camera in questione si può definire un vero e proprio mini appartamento. Situata al centro storico di Napoli,al quarto piano (senza ascensore) di un palazzo antico. potrete usufruire di un comodo letto matrimoniale con materasso in memory e divano letto.',
                '2',
                '2',
                '2',
                '2',
                '43',
                '58',
                'images/flat-08.jpg',
                '40.86764',
                '14.26429',
                '0'
            ],
            [
                '2',
                'Rossonapoletano B&B Napoli Green',
                'The room includes a double bed and a single bed. Consisting of a desk, cupboard, wardrobe, chair and chest of drawers, air conditioning. the room is chosen by the owner based on the number of people.',
                '3',
                '4',
                '5',
                '3',
                '83',
                '98',
                'images/flat-09.jpg',
                '40.84708',
                '14.26153',
                '0'
            ],
            [
                '2',
                'Appartamento nel cuore di Napoli luminoso e intimo',
                'Appartamento luminoso, intimo e silenziosissimo in posizione centrale, a pochi passi dalla metropolitana, Orto Botanico, tutti i musei e attrazioni principali del centro storico.',
                '4',
                '5',
                '2',
                '3',
                '73',
                '88',
                'images/flat-10.jpg',
                '40.84868',
                '14.26383',
                '0'
            ],
            [
                '3',
                'Suite Monolocale a Rimini Marina Centro',
                'A Rimini Marina Centro c’è una novità: Rimini Bay Suite & Residence. 12 appartamenti, tutti completamente ristrutturati a fine 2019, capaci di ospitare da 2 fino a 7 persone e caratterizzati ognuno da arredi, finiture e servizi esclusivi.',
                '4',
                '4',
                '3',
                '3',
                '63',
                '68',
                'images/flat-11.jpg',
                '44.06474',
                '12.58317',
                '0'
            ],
            [
                '3',
                'Casa nuova con giardino,bici, a 800mt mare/fiera',
                'Appartamento fra mare e verde, rinnovato completamente in casa bifamiliare: cucina abitabile, due matrimoniali, terza camera x gioco o eventuale lettino per bimbi, sala con divano letto singolo, ampi spazi esterni per pranzare, giardino, 2 posti auto.',
                '4',
                '4',
                '4',
                '2',
                '73',
                '88',
                'images/flat-12.jpg',
                '44.06469',
                '12.58184',
                '0'
            ],
            [
                '3',
                'La Casa Rosa',
                'L\'appartamento si trova a pochi passi dal mare (600m), proprio di fronte ad una delle poche spiagge libere della riviera, e a qualche minuto dal centro commerciale "Le Befane".',
                '2',
                '2',
                '3',
                '2',
                '53',
                '68',
                'images/flat-13.jpg',
                '44.06885',
                '12.57731',
                '0'
            ],
            [
                '3',
                'Casa Vacanze Centro di Rimini Palacongressi',
                'L\'appartamento nuovo, perfettamente arredato è situato in zona tranquilla e silenziosa, ottima per una vacanza o per lavoro. Casa vicina al palacongressi di Rimini e al Centro storico (10 min a piedi ).
                La zona è con parcheggio gratuito.',
                '3',
                '3',
                '2',
                '2',
                '43',
                '58',
                'images/flat-14.jpg',
                '44.07395',
                '12.57551',
                '0'
            ],
            [
                '3',
                'Casa nuova con giardino,bici, a 800mt mare/fiera',
                'Appartamento fra mare e verde, rinnovato completamente in casa bifamiliare: cucina abitabile, due matrimoniali, terza camera x gioco o eventuale lettino per bimbi, sala con divano letto singolo, ampi spazi esterni per pranzare.',
                '4',
                '5',
                '3',
                '3',
                '73',
                '78',
                'images/flat-15.jpg',
                '44.06036',
                '12.585',
                '0'
            ],
            [
                '4',
                'Grazioso appartamento sui Navigli in stabile d\'epoca',
                'Immergiti nel mix tra moderno e antico di questo appartamento all\'interno di un tipico palazzo di ringhiera, testimonianza della "Vecchia Milano". Arredato con un particolare gusto per gli accostamenti estrosi, ti avvicinerà al cuore della città.',
                '4',
                '4',
                '2',
                '4',
                '63',
                '58',
                'images/flat-16.jpg',
                '45.47019',
                '9.19407',
                '0'
            ],
            [
                '4',
                'Open Space Loft Navigli Area Milano',
                'Appartamento Loft appena fuori Zona Navigli con Cucina,Soggiorno,Bagno e un soppalco con un letto matrimoniale e un letto singolo per dormire. Il soggiorno è dotato di un grande e comodo divano.',
                '4',
                '4',
                '3',
                '2',
                '62',
                '64',
                'images/flat-17.jpg',
                '45.46948',
                '9.19183',
                '0'
            ],
            [
                '4',
                'Grazioso appartamento ben servito',
                'Grazioso appartamento di recente costruzione situato a Corsico in zona tranquilla composto da sala cucina con divano letto, camera da letto matrimoniale e bagno con doccia.',
                '2',
                '2',
                '2',
                '2',
                '42',
                '54',
                'images/flat-18.jpg',
                '45.46864',
                '9.1902',
                '0'
            ],
            [
                '4',
                'Relax e Design nel Cuore Artistico della Città',
                'Entra in uno spazio che richiama cadenze e ritmi della zona degli artisti con un design curato e moderno, dove i toni morbidi parlano la lingua dell\'ospitalità e della raffinatezza. Spazio alla creatività, dunque: la tua, e quella che qui respirerai.',
                '4',
                '3',
                '4',
                '3',
                '72',
                '94',
                'images/flat-19.jpg',
                '45.46663',
                '9.18753',
                '0'
            ],
            [
                '5',
                'Appartamento a Porta Santi',
                'Appartamento nuovo situato in zona Porta Santi, nel centro storico di Cesena. Zona giorno con cucina, zona notte matrimoniale, bagno con doccia. Può ospitare massimo 4 persone: 2 nel matrimoniale + 2 nei divano/letti.',
                '3',
                '2',
                '4',
                '2',
                '62',
                '64',
                'images/flat-20.jpg',
                '44.14192',
                '12.23137',
                '0'
            ]
        ];

        foreach ($flats as $flat) {
            $newFlat = new Flat;
            $newFlat->user_id = $flat[0];
            $newFlat->title = $flat[1];
            $newFlat->description = $flat[2];
            $newFlat->guest = $flat[3];
            $newFlat->rooms = $flat[4];
            $newFlat->beds = $flat[5];
            $newFlat->bathrooms = $flat[6];
            $newFlat->mq = $flat[7];
            $newFlat->price_day = $flat[8];
            $newFlat->cover = $flat[9];
            $newFlat->lat = $flat[10];
            $newFlat->long = $flat[11];
            $newFlat->slug = Str::finish(Str::slug($newFlat->title), rand(1, 1000));
            $newFlat->hidden = $flat[12];
            $newFlat->save();
        }
    }
}
