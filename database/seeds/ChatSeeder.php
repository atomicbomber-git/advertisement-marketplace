<?php

use App\Chat;
use App\Pelanggan;
use App\Penjual;
use Illuminate\Database\Seeder;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pelanggans = Pelanggan::query()->get();
        $penjuals = Penjual::query()->get();

        \Illuminate\Support\Facades\DB::beginTransaction();

        foreach ($pelanggans as $pelanggan) {
            foreach ($penjuals as $penjual) {
                $chat_lines_count = rand(6, 10);
                $pesan_dari_pelanggan = false;

                for ($i = 0; $i < $chat_lines_count; ++$i) {
                    if (rand(1, 3) === 3) { $pesan_dari_pelanggan = !$pesan_dari_pelanggan; }

                    $time = now()->subHour()->addMinutes($i);

                    factory(Chat::class)->create([
                        "pelanggan_id" => $pelanggan->id,
                        "penjual_id" => $penjual->id,
                        "pesan_dari_pelanggan" => $pesan_dari_pelanggan,
                        "created_at" => $time,
                        "updated_at" => $time,
                    ]);
                }
            }
        }

        \Illuminate\Support\Facades\DB::commit();
    }
}
