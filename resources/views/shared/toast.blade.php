@php
    $alertStyles = [
        'success' => 'bg-green-100 border-green-400 text-green-800',
        'fail'    => 'bg-red-100 border-red-400 text-red-800',
        'warning' => 'bg-yellow-100 border-yellow-400 text-yellow-800',
        'info'    => 'bg-blue-100 border-blue-400 text-blue-800',
    ];

    $alertIcons = [
        'success' => '✅',
        'fail'    => '❌',
        'warning' => '⚠️',
        'info'    => 'ℹ️',
    ];
@endphp

@foreach (['success', 'fail', 'warning', 'info'] as $type)
    @if (session()->has($type))
        <div class="flex items-start justify-between w-full px-4 py-3 mb-4 border-l-4 rounded-md shadow-md {{ $alertStyles[$type] }}" role="alert">
            <div class="flex items-center space-x-3">
                <span class="text-xl">{{ $alertIcons[$type] }}</span>
                <div>
                    <strong class="capitalize">{{ $type }}:</strong> {{ session($type) }}
                </div>
            </div>
            <button class="text-2xl leading-none hover:opacity-70" onclick="this.parentElement.remove()">&times;</button>
        </div>
    @endif
@endforeach
