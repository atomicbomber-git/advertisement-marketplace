<?php

use App\KategoriProduk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriProdukSeeder extends Seeder
{
    public $kategoriProduksData = [
        "all" => "Media Promosi",
        "billboard" => "Billboard",
        "videotron-led" => "Videotron / LED",
        "digital-display" => "Digital Advertising",
        "digital-signage" => "Digital Signage",
        "neon-box" => "Neon Box",
        "wall-branding" => "Wall Branding",
        "wall-sign" => "Wall Sign",
        "pillar" => "Pillar",
        "parking-spot" => "Parking Spot",
        "banner" => "Banner",
        "hanging-banner" => "Hanging Banner",
        "flag" => "Flag",
        "sticker" => "Sticker",
        "lift" => "Lift",
        "escalator" => "Escalator",
        "services" => "Vendor",
        "station" => "Vehicle Branding",
        "custom" => "Custom",
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();

        foreach ($this->kategoriProduksData as $kategoriProdukNama) {
            KategoriProduk::query()->firstOrCreate([
                "nama" => $kategoriProdukNama,
            ]);
        }

        DB::commit();
    }
}
