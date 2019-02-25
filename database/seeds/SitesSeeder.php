<?php

use Illuminate\Database\Seeder;
use App\Sites;
use App\Links;

class SitesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sites::truncate();

        $sites = [
            'Footlocker',
            'Solebox',
            'BSTN',
            'Adidas'
        ];

        foreach ($sites as $site) {
            Sites::create([
                'name' => $site
            ]);
        }

        

        $links = [
            'https://www.bstn.com/en/p/jordan-wmns-air-jordan-1-high-og-99316',
            'https://www.bstn.com/it/p/nike-the-10-nike-air-max-90-aa7293-200-108469',
            'https://www.bstn.com/en/p/nike-the-10-zoom-fly-101940',
            'https://www.bstn.com/en/p/jordan-air-jordan-1-retro-high-og-88900',
            'https://www.bstn.com/it/p/nike-the-10-nike-air-max-90-aa7293-001-108454',
            'https://www.bstn.com/it/p/nike-air-fear-of-god-ar4237-002-103802',
            'https://www.bstn.com/en/p/nike-air-jordan-1-hi-og-nrg-bv1803-106-99999',
            'https://www.bstn.com/en/p/jordan-air-jordan-1-retro-high-og-555088-302-101879',
            'https://www.bstn.com/en/p/jordan-air-jordan-1-retro-high-og-89793',
            'https://www.bstn.com/en/p/nike-the-10-zoom-fly-101959',
            'https://www.bstn.com/en/p/jordan-air-jordan-1-retro-high-og-109827'
        ];

        foreach ($links as $link) {
            Links::create([
                'site' => 3,
                'value' => $link
            ]);
        }


    }
}
