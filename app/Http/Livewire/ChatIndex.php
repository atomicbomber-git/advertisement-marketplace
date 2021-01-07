<?php

namespace App\Http\Livewire;

use App\Chat;
use App\Pelanggan;
use App\Penjual;
use Livewire\Component;

class ChatIndex extends Component
{
    public $penjual_id;
    public $pelanggan_id;

    public $user_is_pelanggan;
    public $pesan;

    public function mount($pesanDariPelanggan, $penjualId = null, $pelangganId = null)
    {
        $this->penjual_id = !$pesanDariPelanggan ? \Auth::user()->penjual->id : $penjualId;
        $this->pelanggan_id = $pesanDariPelanggan ? \Auth::user()->pelanggan->id : $pelangganId;
        $this->user_is_pelanggan = $pesanDariPelanggan;
    }

    public function submit()
    {
        Chat::query()->create([
            "penjual_id" => $this->getPenjual()->id,
            "pelanggan_id" => $this->getPelanggan()->id,
            "pesan" => $this->pesan,
            "pesan_dari_pelanggan" => $this->user_is_pelanggan,
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
        return Pelanggan::query()->find($this->pelanggan_id);
    }

    public function render()
    {
        $penjual = $this->getPenjual();
        $pelanggan = $this->getPelanggan();

        $chats = Chat::query()
            ->where("pelanggan_id", $pelanggan->id)
            ->where("penjual_id", $penjual->id)
            ->get();

        $previous_chat = null;

        foreach ($chats as $index => $chat) {
            $next_chat = $chats[$index + 1] ?? null;

            $chat->fill([
                "shows_time" => $next_chat === null ? true: ($next_chat->pesan_dari_pelanggan) !== ($chat->pesan_dari_pelanggan),
                "shows_name" => $previous_chat === null ? true : ($previous_chat->pesan_dari_pelanggan) !== ($chat->pesan_dari_pelanggan),
            ]);

            $previous_chat = $chat;
        }

        return view('livewire.chat-index', [
            "chats" => $chats,
            "penjual" => $penjual,
            "pelanggan" => $pelanggan,
            "user_is_pelanggan" => $this->user_is_pelanggan,
        ]);
    }
}
