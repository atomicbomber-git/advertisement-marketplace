@foreach(session("messages") ?? [] as $message)
    <template
            wire:key="{{ rand() }}"
            x-data="{ visible: true }"
            x-init="window.setTimeout(() => { visible = false }, 2000)"
            x-if="visible"
    >
        <div
                class="my-3 notification is-{{ $message['state'] ?? \App\Constants\MessageState::STATE_INFO }} is-light"
        >
            <button class="delete"
                    x-on:click="visible = false"
            ></button>

            @switch($message['state'] ?? 'primary')
                @case(\App\Constants\MessageState::STATE_INFO)
                <i class="fas fa-info-circle"></i>
                @break
                @case(\App\Constants\MessageState::STATE_SUCCESS)
                <i class="fas fa-check-circle"></i>
                @break
                @case(\App\Constants\MessageState::STATE_WARNING)
                <i class="fas fa-exclamation-circle"></i>
                @break
                @case(\App\Constants\MessageState::STATE_DANGER)
                <i class="fas fa-times-circle"></i>
                @break
            @endswitch
            {{ $message['content'] ?? 'Default message content.' }}
        </div>
    </template>
@endforeach
