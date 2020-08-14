<?php

use App\Penjual;
use App\Produk;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @var Penjual[] $penjuals */
        $penjuals = Penjual::query()->get();

        DB::beginTransaction();

        foreach ($penjuals as $penjual) {
            $penjual->produks()->createMany(
                factory(Produk::class, 50)
                    ->make()
                    ->toArray()
            )->each(function (Produk $produk) {
                $produk->addMedia(
                    $this->generateImage("{$produk->kode}-{$produk->nama}")
                )->toMediaCollection();
            });
        }

        DB::commit();
    }

    private function generateImage($text)
    {
        $image = imagecreate(640, 480);

        if (!$image) {
            throw new \Exception("Failed to create image");
        }

        $imageColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
        $textColor = imagecolorallocate($image, rand(0, 255), rand(0, 255), rand(0, 255));
        imagestring($image, 1, 5, 5,  $text, $textColor);
        $tempImageFilepath = tempnam("/tmp", "tempimage");
        imagepng($image, $tempImageFilepath);
        imagedestroy($image);

        return $tempImageFilepath;
    }
}
