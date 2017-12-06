<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminNationalityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_nationality', function (Blueprint $table) {
            $table->integer('reference');
            $table->string('locale');
            $table->string('value');
        });

        DB::table('admin_nationality')->insert(
            [
                [
                    'reference' => 1,
                    'locale'    => 'fr_FR',
                    'value'     => 'Afghanistan',
                ],
                [
                    'reference' => 2,
                    'locale'    => 'fr_FR',
                    'value'     => 'Afrique du Sud',
                ],
                [
                    'reference' => 3,
                    'locale'    => 'fr_FR',
                    'value'     => 'Albanie',
                ],
                [
                    'reference' => 4,
                    'locale'    => 'fr_FR',
                    'value'     => 'Algérie',
                ],
                [
                    'reference' => 5,
                    'locale'    => 'fr_FR',
                    'value'     => 'Allemagne',
                ],
                [
                    'reference' => 6,
                    'locale'    => 'fr_FR',
                    'value'     => 'Andorre',
                ],
                [
                    'reference' => 7,
                    'locale'    => 'fr_FR',
                    'value'     => 'Angola',
                ],
                [
                    'reference' => 8,
                    'locale'    => 'fr_FR',
                    'value'     => 'Anguilla',
                ],
                [
                    'reference' => 9,
                    'locale'    => 'fr_FR',
                    'value'     => 'Antarctique',
                ],
                [
                    'reference' => 10,
                    'locale'    => 'fr_FR',
                    'value'     => 'Antigua-et-Barbuda',
                ],
                [
                    'reference' => 11,
                    'locale'    => 'fr_FR',
                    'value'     => 'Antilles Néerlandaises',
                ],
                [
                    'reference' => 12,
                    'locale'    => 'fr_FR',
                    'value'     => 'Arabie Saoudite',
                ],
                [
                    'reference' => 13,
                    'locale'    => 'fr_FR',
                    'value'     => 'Argentine',
                ],
                [
                    'reference' => 14,
                    'locale'    => 'fr_FR',
                    'value'     => 'Arménie',
                ],
                [
                    'reference' => 15,
                    'locale'    => 'fr_FR',
                    'value'     => 'Aruba',
                ],
                [
                    'reference' => 16,
                    'locale'    => 'fr_FR',
                    'value'     => 'Australie',
                ],
                [
                    'reference' => 17,
                    'locale'    => 'fr_FR',
                    'value'     => 'Autriche',
                ],
                [
                    'reference' => 18,
                    'locale'    => 'fr_FR',
                    'value'     => 'Azerbaïdjan',
                ],
                [
                    'reference' => 19,
                    'locale'    => 'fr_FR',
                    'value'     => 'Bahamas',
                ],
                [
                    'reference' => 20,
                    'locale'    => 'fr_FR',
                    'value'     => 'Bahreïn',
                ],
                [
                    'reference' => 21,
                    'locale'    => 'fr_FR',
                    'value'     => 'Bangladesh',
                ],
                [
                    'reference' => 22,
                    'locale'    => 'fr_FR',
                    'value'     => 'Barbade',
                ],
                [
                    'reference' => 23,
                    'locale'    => 'fr_FR',
                    'value'     => 'Bélarus',
                ],
                [
                    'reference' => 24,
                    'locale'    => 'fr_FR',
                    'value'     => 'Belgique',
                ],
                [
                    'reference' => 25,
                    'locale'    => 'fr_FR',
                    'value'     => 'Belize',
                ],
                [
                    'reference' => 26,
                    'locale'    => 'fr_FR',
                    'value'     => 'Bénin',
                ],
                [
                    'reference' => 27,
                    'locale'    => 'fr_FR',
                    'value'     => 'Bermudes',
                ],
                [
                    'reference' => 28,
                    'locale'    => 'fr_FR',
                    'value'     => 'Bhoutan',
                ],
                [
                    'reference' => 29,
                    'locale'    => 'fr_FR',
                    'value'     => 'Bolivie',
                ],
                [
                    'reference' => 30,
                    'locale'    => 'fr_FR',
                    'value'     => 'Bosnie-Herzégovine',
                ],
                [
                    'reference' => 31,
                    'locale'    => 'fr_FR',
                    'value'     => 'Botswana',
                ],
                [
                    'reference' => 32,
                    'locale'    => 'fr_FR',
                    'value'     => 'Brésil',
                ],
                [
                    'reference' => 33,
                    'locale'    => 'fr_FR',
                    'value'     => 'Brunéi Darussalam',
                ],
                [
                    'reference' => 34,
                    'locale'    => 'fr_FR',
                    'value'     => 'Bulgarie',
                ],
                [
                    'reference' => 35,
                    'locale'    => 'fr_FR',
                    'value'     => 'Burkina Faso',
                ],
                [
                    'reference' => 36,
                    'locale'    => 'fr_FR',
                    'value'     => 'Burundi',
                ],
                [
                    'reference' => 37,
                    'locale'    => 'fr_FR',
                    'value'     => 'Cambodge',
                ],
                [
                    'reference' => 38,
                    'locale'    => 'fr_FR',
                    'value'     => 'Cameroun',
                ],
                [
                    'reference' => 39,
                    'locale'    => 'fr_FR',
                    'value'     => 'Canada',
                ],
                [
                    'reference' => 40,
                    'locale'    => 'fr_FR',
                    'value'     => 'Cap-vert',
                ],
                [
                    'reference' => 41,
                    'locale'    => 'fr_FR',
                    'value'     => 'Chili',
                ],
                [
                    'reference' => 42,
                    'locale'    => 'fr_FR',
                    'value'     => 'Chine',
                ],
                [
                    'reference' => 43,
                    'locale'    => 'fr_FR',
                    'value'     => 'Chypre',
                ],
                [
                    'reference' => 44,
                    'locale'    => 'fr_FR',
                    'value'     => 'Colombie',
                ],
                [
                    'reference' => 45,
                    'locale'    => 'fr_FR',
                    'value'     => 'Comores',
                ],
                [
                    'reference' => 46,
                    'locale'    => 'fr_FR',
                    'value'     => 'Costa Rica',
                ],
                [
                    'reference' => 47,
                    'locale'    => 'fr_FR',
                    'value'     => 'Côte d\'Ivoire',
                ],
                [
                    'reference' => 48,
                    'locale'    => 'fr_FR',
                    'value'     => 'Croatie',
                ],
                [
                    'reference' => 49,
                    'locale'    => 'fr_FR',
                    'value'     => 'Cuba',
                ],
                [
                    'reference' => 50,
                    'locale'    => 'fr_FR',
                    'value'     => 'Danemark',
                ],
                [
                    'reference' => 51,
                    'locale'    => 'fr_FR',
                    'value'     => 'Djibouti',
                ],
                [
                    'reference' => 52,
                    'locale'    => 'fr_FR',
                    'value'     => 'Dominique',
                ],
                [
                    'reference' => 53,
                    'locale'    => 'fr_FR',
                    'value'     => 'Égypte',
                ],
                [
                    'reference' => 54,
                    'locale'    => 'fr_FR',
                    'value'     => 'El Salvador',
                ],
                [
                    'reference' => 55,
                    'locale'    => 'fr_FR',
                    'value'     => 'Émirats Arabes Unis',
                ],
                [
                    'reference' => 56,
                    'locale'    => 'fr_FR',
                    'value'     => 'Équateur',
                ],
                [
                    'reference' => 57,
                    'locale'    => 'fr_FR',
                    'value'     => 'Érythrée',
                ],
                [
                    'reference' => 58,
                    'locale'    => 'fr_FR',
                    'value'     => 'Espagne',
                ],
                [
                    'reference' => 59,
                    'locale'    => 'fr_FR',
                    'value'     => 'Estonie',
                ],
                [
                    'reference' => 60,
                    'locale'    => 'fr_FR',
                    'value'     => 'États Fédérés de Micronésie',
                ],
                [
                    'reference' => 61,
                    'locale'    => 'fr_FR',
                    'value'     => 'États-Unis',
                ],
                [
                    'reference' => 62,
                    'locale'    => 'fr_FR',
                    'value'     => 'Éthiopie',
                ],
                [
                    'reference' => 63,
                    'locale'    => 'fr_FR',
                    'value'     => 'Fédération de Russie',
                ],
                [
                    'reference' => 64,
                    'locale'    => 'fr_FR',
                    'value'     => 'Fidji',
                ],
                [
                    'reference' => 65,
                    'locale'    => 'fr_FR',
                    'value'     => 'Finlande',
                ],
                [
                    'reference' => 66,
                    'locale'    => 'fr_FR',
                    'value'     => 'France',
                ],
                [
                    'reference' => 67,
                    'locale'    => 'fr_FR',
                    'value'     => 'Gabon',
                ],
                [
                    'reference' => 68,
                    'locale'    => 'fr_FR',
                    'value'     => 'Gambie',
                ],
                [
                    'reference' => 69,
                    'locale'    => 'fr_FR',
                    'value'     => 'Géorgie',
                ],
                [
                    'reference' => 70,
                    'locale'    => 'fr_FR',
                    'value'     => 'Géorgie du Sud et les Îles Sandwich du Sud',
                ],
                [
                    'reference' => 71,
                    'locale'    => 'fr_FR',
                    'value'     => 'Ghana',
                ],
                [
                    'reference' => 72,
                    'locale'    => 'fr_FR',
                    'value'     => 'Gibraltar',
                ],
                [
                    'reference' => 73,
                    'locale'    => 'fr_FR',
                    'value'     => 'Grèce',
                ],
                [
                    'reference' => 74,
                    'locale'    => 'fr_FR',
                    'value'     => 'Grenade',
                ],
                [
                    'reference' => 75,
                    'locale'    => 'fr_FR',
                    'value'     => 'Groenland',
                ],
                [
                    'reference' => 76,
                    'locale'    => 'fr_FR',
                    'value'     => 'Guadeloupe',
                ],
                [
                    'reference' => 77,
                    'locale'    => 'fr_FR',
                    'value'     => 'Guam',
                ],
                [
                    'reference' => 78,
                    'locale'    => 'fr_FR',
                    'value'     => 'Guatemala',
                ],
                [
                    'reference' => 79,
                    'locale'    => 'fr_FR',
                    'value'     => 'Guinée',
                ],
                [
                    'reference' => 80,
                    'locale'    => 'fr_FR',
                    'value'     => 'Guinée Équatoriale',
                ],
                [
                    'reference' => 81,
                    'locale'    => 'fr_FR',
                    'value'     => 'Guinée-Bissau',
                ],
                [
                    'reference' => 82,
                    'locale'    => 'fr_FR',
                    'value'     => 'Guyana',
                ],
                [
                    'reference' => 83,
                    'locale'    => 'fr_FR',
                    'value'     => 'Guyane Française',
                ],
                [
                    'reference' => 84,
                    'locale'    => 'fr_FR',
                    'value'     => 'Haïti',
                ],
                [
                    'reference' => 85,
                    'locale'    => 'fr_FR',
                    'value'     => 'Honduras',
                ],
                [
                    'reference' => 86,
                    'locale'    => 'fr_FR',
                    'value'     => 'Hong-Kong',
                ],
                [
                    'reference' => 87,
                    'locale'    => 'fr_FR',
                    'value'     => 'Hongrie',
                ],
                [
                    'reference' => 88,
                    'locale'    => 'fr_FR',
                    'value'     => 'Île Bouvet',
                ],
                [
                    'reference' => 89,
                    'locale'    => 'fr_FR',
                    'value'     => 'Île Christmas',
                ],
                [
                    'reference' => 90,
                    'locale'    => 'fr_FR',
                    'value'     => 'Île de Man',
                ],
                [
                    'reference' => 91,
                    'locale'    => 'fr_FR',
                    'value'     => 'Île Norfolk',
                ],
                [
                    'reference' => 92,
                    'locale'    => 'fr_FR',
                    'value'     => 'Îles (malvinas) Falkland',
                ],
                [
                    'reference' => 93,
                    'locale'    => 'fr_FR',
                    'value'     => 'Îles Åland',
                ],
                [
                    'reference' => 94,
                    'locale'    => 'fr_FR',
                    'value'     => 'Îles Caïmanes',
                ],
                [
                    'reference' => 95,
                    'locale'    => 'fr_FR',
                    'value'     => 'Îles Cocos (Keeling)',
                ],
                [
                    'reference' => 96,
                    'locale'    => 'fr_FR',
                    'value'     => 'Îles Cook',
                ],
                [
                    'reference' => 97,
                    'locale'    => 'fr_FR',
                    'value'     => 'Îles Féroé',
                ],
                [
                    'reference' => 98,
                    'locale'    => 'fr_FR',
                    'value'     => 'Îles Heard et Mcdonald',
                ],
                [
                    'reference' => 99,
                    'locale'    => 'fr_FR',
                    'value'     => 'Îles Mariannes du Nord',
                ],
                [
                    'reference' => 100,
                    'locale'    => 'fr_FR',
                    'value'     => 'Îles Marshall',
                ],
                [
                    'reference' => 101,
                    'locale'    => 'fr_FR',
                    'value'     => 'Îles Mineures Éloignées des États-Unis',
                ],
                [
                    'reference' => 102,
                    'locale'    => 'fr_FR',
                    'value'     => 'Îles Salomon',
                ],
                [
                    'reference' => 103,
                    'locale'    => 'fr_FR',
                    'value'     => 'Îles Turks et Caïques',
                ],
                [
                    'reference' => 104,
                    'locale'    => 'fr_FR',
                    'value'     => 'Îles Vierges Britanniques',
                ],
                [
                    'reference' => 105,
                    'locale'    => 'fr_FR',
                    'value'     => 'Îles Vierges des États-Unis',
                ],
                [
                    'reference' => 106,
                    'locale'    => 'fr_FR',
                    'value'     => 'Inde',
                ],
                [
                    'reference' => 107,
                    'locale'    => 'fr_FR',
                    'value'     => 'Indonésie',
                ],
                [
                    'reference' => 108,
                    'locale'    => 'fr_FR',
                    'value'     => 'Iraq',
                ],
                [
                    'reference' => 109,
                    'locale'    => 'fr_FR',
                    'value'     => 'Irlande',
                ],
                [
                    'reference' => 110,
                    'locale'    => 'fr_FR',
                    'value'     => 'Islande',
                ],
                [
                    'reference' => 111,
                    'locale'    => 'fr_FR',
                    'value'     => 'Israël',
                ],
                [
                    'reference' => 112,
                    'locale'    => 'fr_FR',
                    'value'     => 'Italie',
                ],
                [
                    'reference' => 113,
                    'locale'    => 'fr_FR',
                    'value'     => 'Jamahiriya Arabe Libyenne',
                ],
                [
                    'reference' => 114,
                    'locale'    => 'fr_FR',
                    'value'     => 'Jamaïque',
                ],
                [
                    'reference' => 115,
                    'locale'    => 'fr_FR',
                    'value'     => 'Japon',
                ],
                [
                    'reference' => 116,
                    'locale'    => 'fr_FR',
                    'value'     => 'Jordanie',
                ],
                [
                    'reference' => 117,
                    'locale'    => 'fr_FR',
                    'value'     => 'Kazakhstan',
                ],
                [
                    'reference' => 118,
                    'locale'    => 'fr_FR',
                    'value'     => 'Kenya',
                ],
                [
                    'reference' => 119,
                    'locale'    => 'fr_FR',
                    'value'     => 'Kirghizistan',
                ],
                [
                    'reference' => 120,
                    'locale'    => 'fr_FR',
                    'value'     => 'Kiribati',
                ],
                [
                    'reference' => 121,
                    'locale'    => 'fr_FR',
                    'value'     => 'Koweït',
                ],
                [
                    'reference' => 122,
                    'locale'    => 'fr_FR',
                    'value'     => 'L\'ex-République Yougoslave de Macédoine',
                ],
                [
                    'reference' => 123,
                    'locale'    => 'fr_FR',
                    'value'     => 'Lesotho',
                ],
                [
                    'reference' => 124,
                    'locale'    => 'fr_FR',
                    'value'     => 'Lettonie',
                ],
                [
                    'reference' => 125,
                    'locale'    => 'fr_FR',
                    'value'     => 'Liban',
                ],
                [
                    'reference' => 126,
                    'locale'    => 'fr_FR',
                    'value'     => 'Libéria',
                ],
                [
                    'reference' => 127,
                    'locale'    => 'fr_FR',
                    'value'     => 'Liechtenstein',
                ],
                [
                    'reference' => 128,
                    'locale'    => 'fr_FR',
                    'value'     => 'Lituanie',
                ],
                [
                    'reference' => 129,
                    'locale'    => 'fr_FR',
                    'value'     => 'Luxembourg',
                ],
                [
                    'reference' => 130,
                    'locale'    => 'fr_FR',
                    'value'     => 'Macao',
                ],
                [
                    'reference' => 131,
                    'locale'    => 'fr_FR',
                    'value'     => 'Madagascar',
                ],
                [
                    'reference' => 132,
                    'locale'    => 'fr_FR',
                    'value'     => 'Malaisie',
                ],
                [
                    'reference' => 133,
                    'locale'    => 'fr_FR',
                    'value'     => 'Malawi',
                ],
                [
                    'reference' => 134,
                    'locale'    => 'fr_FR',
                    'value'     => 'Maldives',
                ],
                [
                    'reference' => 135,
                    'locale'    => 'fr_FR',
                    'value'     => 'Mali',
                ],
                [
                    'reference' => 136,
                    'locale'    => 'fr_FR',
                    'value'     => 'Malte',
                ],
                [
                    'reference' => 137,
                    'locale'    => 'fr_FR',
                    'value'     => 'Maroc',
                ],
                [
                    'reference' => 138,
                    'locale'    => 'fr_FR',
                    'value'     => 'Martinique',
                ],
                [
                    'reference' => 139,
                    'locale'    => 'fr_FR',
                    'value'     => 'Maurice',
                ],
                [
                    'reference' => 140,
                    'locale'    => 'fr_FR',
                    'value'     => 'Mauritanie',
                ],
                [
                    'reference' => 141,
                    'locale'    => 'fr_FR',
                    'value'     => 'Mayotte',
                ],
                [
                    'reference' => 142,
                    'locale'    => 'fr_FR',
                    'value'     => 'Mexique',
                ],
                [
                    'reference' => 143,
                    'locale'    => 'fr_FR',
                    'value'     => 'Monaco',
                ],
                [
                    'reference' => 144,
                    'locale'    => 'fr_FR',
                    'value'     => 'Mongolie',
                ],
                [
                    'reference' => 145,
                    'locale'    => 'fr_FR',
                    'value'     => 'Montserrat',
                ],
                [
                    'reference' => 146,
                    'locale'    => 'fr_FR',
                    'value'     => 'Mozambique',
                ],
                [
                    'reference' => 147,
                    'locale'    => 'fr_FR',
                    'value'     => 'Myanmar',
                ],
                [
                    'reference' => 148,
                    'locale'    => 'fr_FR',
                    'value'     => 'Namibie',
                ],
                [
                    'reference' => 149,
                    'locale'    => 'fr_FR',
                    'value'     => 'Nauru',
                ],
                [
                    'reference' => 150,
                    'locale'    => 'fr_FR',
                    'value'     => 'Népal',
                ],
                [
                    'reference' => 151,
                    'locale'    => 'fr_FR',
                    'value'     => 'Nicaragua',
                ],
                [
                    'reference' => 152,
                    'locale'    => 'fr_FR',
                    'value'     => 'Niger',
                ],
                [
                    'reference' => 153,
                    'locale'    => 'fr_FR',
                    'value'     => 'Nigéria',
                ],
                [
                    'reference' => 154,
                    'locale'    => 'fr_FR',
                    'value'     => 'Niué',
                ],
                [
                    'reference' => 155,
                    'locale'    => 'fr_FR',
                    'value'     => 'Norvège',
                ],
                [
                    'reference' => 156,
                    'locale'    => 'fr_FR',
                    'value'     => 'Nouvelle-Calédonie',
                ],
                [
                    'reference' => 157,
                    'locale'    => 'fr_FR',
                    'value'     => 'Nouvelle-Zélande',
                ],
                [
                    'reference' => 158,
                    'locale'    => 'fr_FR',
                    'value'     => 'Oman',
                ],
                [
                    'reference' => 159,
                    'locale'    => 'fr_FR',
                    'value'     => 'Ouganda',
                ],
                [
                    'reference' => 160,
                    'locale'    => 'fr_FR',
                    'value'     => 'Ouzbékistan',
                ],
                [
                    'reference' => 161,
                    'locale'    => 'fr_FR',
                    'value'     => 'Pakistan',
                ],
                [
                    'reference' => 162,
                    'locale'    => 'fr_FR',
                    'value'     => 'Palaos',
                ],
                [
                    'reference' => 163,
                    'locale'    => 'fr_FR',
                    'value'     => 'Panama',
                ],
                [
                    'reference' => 164,
                    'locale'    => 'fr_FR',
                    'value'     => 'Papouasie-Nouvelle-Guinée',
                ],
                [
                    'reference' => 165,
                    'locale'    => 'fr_FR',
                    'value'     => 'Paraguay',
                ],
                [
                    'reference' => 166,
                    'locale'    => 'fr_FR',
                    'value'     => 'Pays-Bas',
                ],
                [
                    'reference' => 167,
                    'locale'    => 'fr_FR',
                    'value'     => 'Pérou',
                ],
                [
                    'reference' => 168,
                    'locale'    => 'fr_FR',
                    'value'     => 'Philippines',
                ],
                [
                    'reference' => 169,
                    'locale'    => 'fr_FR',
                    'value'     => 'Pitcairn',
                ],
                [
                    'reference' => 170,
                    'locale'    => 'fr_FR',
                    'value'     => 'Pologne',
                ],
                [
                    'reference' => 171,
                    'locale'    => 'fr_FR',
                    'value'     => 'Polynésie Française',
                ],
                [
                    'reference' => 172,
                    'locale'    => 'fr_FR',
                    'value'     => 'Porto Rico',
                ],
                [
                    'reference' => 173,
                    'locale'    => 'fr_FR',
                    'value'     => 'Portugal',
                ],
                [
                    'reference' => 174,
                    'locale'    => 'fr_FR',
                    'value'     => 'Qatar',
                ],
                [
                    'reference' => 175,
                    'locale'    => 'fr_FR',
                    'value'     => 'République Arabe Syrienne',
                ],
                [
                    'reference' => 176,
                    'locale'    => 'fr_FR',
                    'value'     => 'République Centrafricaine',
                ],
                [
                    'reference' => 177,
                    'locale'    => 'fr_FR',
                    'value'     => 'République de Corée',
                ],
                [
                    'reference' => 178,
                    'locale'    => 'fr_FR',
                    'value'     => 'République de Moldova',
                ],
                [
                    'reference' => 179,
                    'locale'    => 'fr_FR',
                    'value'     => 'République Démocratique du Congo',
                ],
                [
                    'reference' => 180,
                    'locale'    => 'fr_FR',
                    'value'     => 'République Démocratique Populaire Lao',
                ],
                [
                    'reference' => 181,
                    'locale'    => 'fr_FR',
                    'value'     => 'République Dominicaine',
                ],
                [
                    'reference' => 182,
                    'locale'    => 'fr_FR',
                    'value'     => 'République du Congo',
                ],
                [
                    'reference' => 183,
                    'locale'    => 'fr_FR',
                    'value'     => 'République Islamique d\'Iran',
                ],
                [
                    'reference' => 184,
                    'locale'    => 'fr_FR',
                    'value'     => 'République Populaire Démocratique de Corée',
                ],
                [
                    'reference' => 185,
                    'locale'    => 'fr_FR',
                    'value'     => 'République Tchèque',
                ],
                [
                    'reference' => 186,
                    'locale'    => 'fr_FR',
                    'value'     => 'République-Unie de Tanzanie',
                ],
                [
                    'reference' => 187,
                    'locale'    => 'fr_FR',
                    'value'     => 'Réunion',
                ],
                [
                    'reference' => 188,
                    'locale'    => 'fr_FR',
                    'value'     => 'Roumanie',
                ],
                [
                    'reference' => 189,
                    'locale'    => 'fr_FR',
                    'value'     => 'Royaume-Uni',
                ],
                [
                    'reference' => 190,
                    'locale'    => 'fr_FR',
                    'value'     => 'Rwanda',
                ],
                [
                    'reference' => 191,
                    'locale'    => 'fr_FR',
                    'value'     => 'Sahara Occidental',
                ],
                [
                    'reference' => 192,
                    'locale'    => 'fr_FR',
                    'value'     => 'Saint-Kitts-et-Nevis',
                ],
                [
                    'reference' => 193,
                    'locale'    => 'fr_FR',
                    'value'     => 'Saint-Marin',
                ],
                [
                    'reference' => 194,
                    'locale'    => 'fr_FR',
                    'value'     => 'Saint-Pierre-et-Miquelon',
                ],
                [
                    'reference' => 195,
                    'locale'    => 'fr_FR',
                    'value'     => 'Saint-Siège (état de la Cité du Vatican)',
                ],
                [
                    'reference' => 196,
                    'locale'    => 'fr_FR',
                    'value'     => 'Saint-Vincent-et-les Grenadines',
                ],
                [
                    'reference' => 197,
                    'locale'    => 'fr_FR',
                    'value'     => 'Sainte-Hélène',
                ],
                [
                    'reference' => 198,
                    'locale'    => 'fr_FR',
                    'value'     => 'Sainte-Lucie',
                ],
                [
                    'reference' => 199,
                    'locale'    => 'fr_FR',
                    'value'     => 'Samoa',
                ],
                [
                    'reference' => 200,
                    'locale'    => 'fr_FR',
                    'value'     => 'Samoa Américaines',
                ],
                [
                    'reference' => 201,
                    'locale'    => 'fr_FR',
                    'value'     => 'Sao Tomé-et-Principe',
                ],
                [
                    'reference' => 202,
                    'locale'    => 'fr_FR',
                    'value'     => 'Sénégal',
                ],
                [
                    'reference' => 203,
                    'locale'    => 'fr_FR',
                    'value'     => 'Serbie-et-Monténégro',
                ],
                [
                    'reference' => 204,
                    'locale'    => 'fr_FR',
                    'value'     => 'Seychelles',
                ],
                [
                    'reference' => 205,
                    'locale'    => 'fr_FR',
                    'value'     => 'Sierra Leone',
                ],
                [
                    'reference' => 206,
                    'locale'    => 'fr_FR',
                    'value'     => 'Singapour',
                ],
                [
                    'reference' => 207,
                    'locale'    => 'fr_FR',
                    'value'     => 'Slovaquie',
                ],
                [
                    'reference' => 208,
                    'locale'    => 'fr_FR',
                    'value'     => 'Slovénie',
                ],
                [
                    'reference' => 209,
                    'locale'    => 'fr_FR',
                    'value'     => 'Somalie',
                ],
                [
                    'reference' => 210,
                    'locale'    => 'fr_FR',
                    'value'     => 'Soudan',
                ],
                [
                    'reference' => 211,
                    'locale'    => 'fr_FR',
                    'value'     => 'Sri Lanka',
                ],
                [
                    'reference' => 212,
                    'locale'    => 'fr_FR',
                    'value'     => 'Suède',
                ],
                [
                    'reference' => 213,
                    'locale'    => 'fr_FR',
                    'value'     => 'Suisse',
                ],
                [
                    'reference' => 214,
                    'locale'    => 'fr_FR',
                    'value'     => 'Suriname',
                ],
                [
                    'reference' => 215,
                    'locale'    => 'fr_FR',
                    'value'     => 'Svalbard etÎle Jan Mayen',
                ],
                [
                    'reference' => 216,
                    'locale'    => 'fr_FR',
                    'value'     => 'Swaziland',
                ],
                [
                    'reference' => 217,
                    'locale'    => 'fr_FR',
                    'value'     => 'Tadjikistan',
                ],
                [
                    'reference' => 218,
                    'locale'    => 'fr_FR',
                    'value'     => 'Taïwan',
                ],
                [
                    'reference' => 219,
                    'locale'    => 'fr_FR',
                    'value'     => 'Tchad',
                ],
                [
                    'reference' => 220,
                    'locale'    => 'fr_FR',
                    'value'     => 'Terres Australes Françaises',
                ],
                [
                    'reference' => 221,
                    'locale'    => 'fr_FR',
                    'value'     => 'Territoire Britannique de l\'Océan Indien',
                ],
                [
                    'reference' => 222,
                    'locale'    => 'fr_FR',
                    'value'     => 'Territoire Palestinien Occupé',
                ],
                [
                    'reference' => 223,
                    'locale'    => 'fr_FR',
                    'value'     => 'Thaïlande',
                ],
                [
                    'reference' => 224,
                    'locale'    => 'fr_FR',
                    'value'     => 'Timor-Leste',
                ],
                [
                    'reference' => 225,
                    'locale'    => 'fr_FR',
                    'value'     => 'Togo',
                ],
                [
                    'reference' => 226,
                    'locale'    => 'fr_FR',
                    'value'     => 'Tokelau',
                ],
                [
                    'reference' => 227,
                    'locale'    => 'fr_FR',
                    'value'     => 'Tonga',
                ],
                [
                    'reference' => 228,
                    'locale'    => 'fr_FR',
                    'value'     => 'Trinité-et-Tobago',
                ],
                [
                    'reference' => 229,
                    'locale'    => 'fr_FR',
                    'value'     => 'Tunisie',
                ],
                [
                    'reference' => 230,
                    'locale'    => 'fr_FR',
                    'value'     => 'Turkménistan',
                ],
                [
                    'reference' => 231,
                    'locale'    => 'fr_FR',
                    'value'     => 'Turquie',
                ],
                [
                    'reference' => 232,
                    'locale'    => 'fr_FR',
                    'value'     => 'Tuvalu',
                ],
                [
                    'reference' => 233,
                    'locale'    => 'fr_FR',
                    'value'     => 'Ukraine',
                ],
                [
                    'reference' => 234,
                    'locale'    => 'fr_FR',
                    'value'     => 'Uruguay',
                ],
                [
                    'reference' => 235,
                    'locale'    => 'fr_FR',
                    'value'     => 'Vanuatu',
                ],
                [
                    'reference' => 236,
                    'locale'    => 'fr_FR',
                    'value'     => 'Venezuela',
                ],
                [
                    'reference' => 237,
                    'locale'    => 'fr_FR',
                    'value'     => 'Viet Nam',
                ],
                [
                    'reference' => 238,
                    'locale'    => 'fr_FR',
                    'value'     => 'Wallis et Futuna',
                ],
                [
                    'reference' => 239,
                    'locale'    => 'fr_FR',
                    'value'     => 'Yémen',
                ],
                [
                    'reference' => 240,
                    'locale'    => 'fr_FR',
                    'value'     => 'Zambie',
                ],
                [
                    'reference' => 241,
                    'locale'    => 'fr_FR',
                    'value'     => 'Zimbabwe',
                ]
            ]
        );

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admin_nationality');
    }
}
