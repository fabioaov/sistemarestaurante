<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Métodos de pagamento') }}
        </h2>
        <h2 class="font-semibold text-l text-gray-800 leading-tight pt-4">
            <x-nav-link :href="route('metodos_pagamento.novo')" :active="request()->routeIs('metodos_pagamento.novo')">
                {{ __('Novo método') }}
            </x-nav-link>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap">
                        <thead>
                            <tr class="text-center font-bold">
                                <td class="border px-2 py-4">Opções</td>
                                <td class="border px-6 py-4">Método</td>
                            </tr>
                        </thead>
                        @foreach ($metodos as $metodo)
                            <tr>
                                <td class="border px-2 py-4"><a href="{{ route('metodos_pagamento.editar', $metodo->id) }}">Ver</a></td>
                                <td class="border px-6 py-4">{{ $metodo->metodo }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
