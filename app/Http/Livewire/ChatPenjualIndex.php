<?php

namespace App\Http\Livewire;

use App\Chat;
use App\Penjual;
use Livewire\Component;

class ChatPenjualIndex extends Component
{
    public $penjual_id;
    public $pesan;

    public function mount($penjualId)
    {
        $this->penjual_id = $penjualId;
    }

    public function submit()
    {
        Chat::query()->create([
            "penjual_id" => $this->getPenjual()->id,
            "pelanggan_id" => $this->getPelanggan()->id,
            "pesan" => $this->pesan
        ]);

        $this->pesan = null;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getPenjual()
    {
        return Penjual::query()->find($this->penjual_id);
    }

    /**
     * @return \App\Pelanggan
     */
    public function getPelanggan(): \App\Pelanggan
    {
        return \Auth::user()->pelanggan;
    }

    public function render()
    {
        $penjual = $this->getPenjual();
        $pelanggan = $this->getPelanggan();

        $chats = Chat::query()
            ->where("pelanggan_id", $pelanggan->id)
            ->where("penjual_id", $penjual->id)
            ->get();

        foreach ($chats as $index => $chat) {
            $alignsRight = $chat->pelanggan->id === $pelanggan->id;
            $next_chat = $chats[$index + 1] ?? null;

            $chat->fill([
                "aligns_right" => $alignsRight,
                "shows_time" => $next_chat === null ?
                    true:
                    ($next_chat->pelanggan->id === $pelanggan->id) !== ($alignsRight)
            ]);
        }

        return view('livewire.chat-penjual-index', [
            "chats" => $chats,
            "penjual" => $penjual,
            "pelanggan" => $pelanggan,
        ]);
    }
}
