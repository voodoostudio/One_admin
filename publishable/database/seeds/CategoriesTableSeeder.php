<?php

use Illuminate\Database\Seeder;
use TCG\Voyager\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        /*--- Categories ---*/
        $category = Category::firstOrNew([
            'slug'      => 'maison',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => 'Maison',
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'      => 'appartement',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => 'Appartement',
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'      => 'terrain-constructible',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => 'Terrain constructible',
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'      => 'terrain-non-constructible',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => 'Terrain non-constructible',
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'      => 'surface-commerciale',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => 'Surface commerciale',
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'      => 'immeuble',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => 'Immeuble',
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'      => 'stationnement',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => 'Stationnement',
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'      => 'autre',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'       => 'Autre',
            ])->save();
        }
        /*--- End Categories ---*/

        /*------ SubCategories ------*/

        /*--- subcategory Maison ---*/
        $category = Category::firstOrNew([
            'slug'              => 'bastide',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Bastide',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'bastidon',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Bastidon',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'bungalow',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Bungalow',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'chalet',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Chalet',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'château',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Château',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'chaumière',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Chaumière',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'domaine',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Domaine',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'domaine-de-chasse',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Domaine de chasse',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'domaine-équestre',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Domaine équestre',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'domespace',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Domespace',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'ferme',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Ferme',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'gîte',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Gîte',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'grange',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Grange',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'haras',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Haras',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'hôtel-particulier',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Hôtel particulier',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'maison-d\'hôtes',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Maison d\'hôtes',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'maison-de-maître',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Maison de maître',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'maison-double',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Maison double',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'maison-jumelée',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Maison jumelée',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'maison-mitoyenne',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Maison mitoyenne',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'maison-villageoise',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Maison villageoise',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'manoir',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Manoir',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'marina',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Marina',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'mas',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Mas',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'mobile-home',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Mobile home',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'moulin',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Moulin',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'pavillon',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Pavillon',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'propriété-viticole',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Propriété viticole',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'villa-contiguë',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Villa contiguë',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'villa-individuelle',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Villa individuelle',
                'parent_id'         => 1,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'autre',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Autre',
                'parent_id'         => 1,
            ])->save();
        }
        /*--- End Maison ---*/

        /*--- Apartament ---*/
        $category = Category::firstOrNew([
            'slug'              => 'attique',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Attique',
                'parent_id'         => 2,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'autre',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Autre',
                'parent_id'         => 2,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'chambre',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Chambre',
                'parent_id'         => 2,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'duplex',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Duplex',
                'parent_id'         => 2,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'en-terasse',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'En terasse',
                'parent_id'         => 2,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'loft',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Loft',
                'parent_id'         => 2,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'meublé',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Meublé',
                'parent_id'         => 2,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'rez-jardin',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Rez-jardin',
                'parent_id'         => 2,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'souplex',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Souplex',
                'parent_id'         => 2,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'sous-combles',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Sous combles',
                'parent_id'         => 2,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'sous-le-toit',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Sous le toit',
                'parent_id'         => 2,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'studio',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Studio',
                'parent_id'         => 2,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'triplex',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Triplex',
                'parent_id'         => 2,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'autre',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Autre',
                'parent_id'         => 2,
            ])->save();
        }
        /*--- End Apartament ---*/

        /*--- Terrain constructible ---*/
        $category = Category::firstOrNew([
            'slug'              => 'terrain-à-bâtir',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Terrain à bâtir',
                'parent_id'         => 3,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'terrain-commercial',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Terrain commercial',
                'parent_id'         => 3,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'terrain-viabilisé',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Terrain viabilisé',
                'parent_id'         => 3,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'terrain-industriel',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Terrain industriel',
                'parent_id'         => 3,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'autre',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Autre',
                'parent_id'         => 3,
            ])->save();
        }
        /*--- End Terrain constructible ---*/

        /*--- Terrain non-constructible ---*/
        $category = Category::firstOrNew([
            'slug'              => 'alpage',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Alpage',
                'parent_id'         => 4,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'forêt',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Forêt',
                'parent_id'         => 4,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'montagne',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Montagne',
                'parent_id'         => 4,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'propriété-équestre',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Propriété équestre',
                'parent_id'         => 4,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'propriété-viticole',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Propriété viticole',
                'parent_id'         => 4,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'terrain-agricole',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Terrain agricole',
                'parent_id'         => 4,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'autre',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Autre',
                'parent_id'         => 4,
            ])->save();
        }
        /*--- End Terrain non-constructible ---*/

        /*--- End Surface commerciale ---*/
        $category = Category::firstOrNew([
            'slug'              => 'arcade',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Arcade',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'atelier',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Atelier',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'auberge',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Auberge',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'bar',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Bar',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'bibliothèque',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Bibliothèque',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'boucherie',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Boucherie',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'boulangerie',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Boulangerie',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'boutique',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Boutique',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'bureau',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Bureau',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'cabaret',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Cabaret',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'café/restaurant',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Café/Restaurant',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'casino',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Casino',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'centre-comercial',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Centre comercial',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'centre-de-bien-être',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Centre de bien être',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'cinema',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Cinema',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'commerce',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Commerce',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'dépôt',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Dépôt',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'discothèque',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Discothèque',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'droit-au-bail',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Droit au bail',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'entrepôt',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Entrepôt',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'entreprise',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Entreprise',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'epicerie',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Epicerie',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'espace-publicitaire',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Espace publicitaire',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'exploitation-agricole',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Exploitation agricole',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'fabrique',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Fabrique',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'fitness',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Fitness',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'fond-de-commerce',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Fond de commerce',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'fromagerie',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Fromagerie',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'garage-automobile',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Garage automobile',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'gérance',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Gérance',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'halle-de-sport',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Halle de sport',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'halle-industrielle',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Halle industrielle',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'hangar',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Hangar',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'hôtel',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Hôtel',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'institut-de-beauté',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Institut de beauté',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'jardinerie',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Jardinerie',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'kiosque',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Kiosque',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'laboratoire',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Laboratoire',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'local',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Local',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'local-commercial',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Local commercial',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'magasin',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Magasin',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'menuiserie',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Menuiserie',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'pizzeria',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Pizzeria',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'pressing',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Pressing',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'remise',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Remise',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'salle-de-jeu',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Salle de jeu',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'salon-de-coiffure',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Salon de coiffure',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'sandwicherie',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Sandwicherie',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'snack',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Snack',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'station-service',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Station-service',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'tabac',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Tabac',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'tea-Room',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Tea-Room',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'théâtre',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Théâtre',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'usine',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Usine',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'vitrine',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Vitrine',
                'parent_id'         => 5,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'autre',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Autre1',
                'parent_id'         => 5,
            ])->save();
        }
        /*--- End Surface commerciale ---*/

        /*--- Immeuble ---*/
        $category = Category::firstOrNew([
            'slug'              => 'ensemble-immobilier',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Ensemble immobilier',
                'parent_id'         => 6,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'immeuble-administratif',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Immeuble administratif',
                'parent_id'         => 6,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'immeuble-artisanal',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Immeuble artisanal',
                'parent_id'         => 6,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'immeuble-commercial',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Immeuble commercial',
                'parent_id'         => 6,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'immeuble-de-rendement',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Immeuble de rendement',
                'parent_id'         => 6,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'immeuble-industriel',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Immeuble industriel',
                'parent_id'         => 6,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'immeuble-locatif',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Immeuble locatif',
                'parent_id'         => 6,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'immeuble-mixte',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Immeuble mixte',
                'parent_id'         => 6,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'immeuble-subventionné',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Immeuble subventionné',
                'parent_id'         => 6,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'autre',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Autre',
                'parent_id'         => 6,
            ])->save();
        }
        /*--- End Immeuble ---*/

        /*--- Stationnement ---*/
        $category = Category::firstOrNew([
            'slug'              => 'box/garage-double',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Box/garage double',
                'parent_id'         => 7,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'box/garage-fermé',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Box/garage fermé',
                'parent_id'         => 7,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'box/garage-ouvert',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Box/garage ouvert',
                'parent_id'         => 7,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'hangar-à-bateau',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Hangar à bateau',
                'parent_id'         => 7,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'place-d\'amarrage',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Place d\'amarrage',
                'parent_id'         => 7,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'place-de-parc-extérieur-couverte',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Place de parc extérieur couverte',
                'parent_id'         => 7,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'place-de-parc-extérieure-non-couverte',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Place de parc extérieure non-couverte',
                'parent_id'         => 7,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'place-de-parc-intérieure',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Place de parc intérieure',
                'parent_id'         => 7,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'place-de-parc-surveillé',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Place de parc surveillé',
                'parent_id'         => 7,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'place-pour-moto-extérieure-couverte',
        ]);
        if (!$category->exists) {

            $category->fill([
                'name'              => 'Place pour moto extérieure couverte',
                'parent_id'         => 7,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'place-pour-moto-extérieure-non-couverte',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Place pour moto extérieure non-couverte',
                'parent_id'         => 7,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'place-pour-moto-intérieure',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Place pour moto intérieure',
                'parent_id'         => 7,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'autre',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Autre',
                'parent_id'         => 7,
            ])->save();
        }
        /*--- End Stationnement ---*/

        /*--- End Autre ---*/
        $category = Category::firstOrNew([
            'slug'              => 'catamaran',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Catamaran',
                'parent_id'         => 8,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'cave',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Cave',
                'parent_id'         => 8,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'dépendance',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Dépendance',
                'parent_id'         => 8,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'galetas',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Galetas',
                'parent_id'         => 8,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'grenier',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Grenier ',
                'parent_id'         => 8,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'péniche',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Péniche',
                'parent_id'         => 8,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'sauna',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Sauna',
                'parent_id'         => 8,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'solarium',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Solarium',
                'parent_id'         => 8,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'voilier',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Voilier',
                'parent_id'         => 8,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'yacht',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Yacht',
                'parent_id'         => 8,
            ])->save();
        }

        $category = Category::firstOrNew([
            'slug'              => 'autre',
        ]);
        if (!$category->exists) {
            $category->fill([
                'name'              => 'Autre',
                'parent_id'         => 8,
            ])->save();
        }
        /*--- End Autre ---*/
        /*--- End Subcategories ---*/
    }
}
