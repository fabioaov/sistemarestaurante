<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="grid grid-cols-5 gap-4">
                        @foreach ($mesas as $mesa)
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 cursor-pointer" onclick="modalOpener({{ $mesa->id }})">
                                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                    <div class="p-6 bg-white border-b border-gray-200">
                                        <h2 class="text-center font-bold pb-3">{{ $mesa->mesa }}</h2>
                                        <span class="font-semibold">Vagas:</span> {{ $mesa->vagas }}<br>
                                        <span class="font-semibold">Ocupantes:</span> {{ $mesa->ocupantes }}<br>
                                        <h2 class="text-center font-semibold pt-3">
                                            @if ($mesa->condicao === null || $mesa->condicao === 1)
                                                <span class="text-green-500">Mesa livre</span>
                                            @else
                                                <span class="text-red-500">Mesa ocupada</span>
                                            @endif
                                        </h2>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" id="success_code" value="{{ Session::get('success_code') }}">

                            <div class="py-12 transition duration-150 ease-in-out z-10 absolute top-0 right-0 bottom-0 left-0 hidden" id="{{ $mesa->id }}">
                                <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg">
                                    <div class="relative py-8 px-5 md:px-10 bg-white shadow-sm rounded border-b border-gray-200 sm:rounded-lg"">
                                        <h2 class="text-center font-bold pb-3">{{ $mesa->mesa }}</h2>
                                        @if ($mesa->condicao === null || $mesa->condicao === 1)
                                            <!-- Validation Errors -->
                                            <x-auth-validation-errors class="my-4" :errors="$errors" />

                                            <form method="POST" action="{{ route('comandas.salvar') }}">
                                                @csrf

                                                <input type="hidden" name="idMesa" value="{{ $mesa->id }}">

                                                <!-- Ocupantes -->
                                                <div>
                                                    <x-input-label for="ocupantes" :value="__('Ocupantes')" />

                                                    <x-text-input id="ocupantes" class="block mt-1 w-full" type="number" name="ocupantes" :value="old('ocupantes')"
                                                        required autofocus />
                                                </div>

                                                <div class="items-center text-center mt-4">
                                                    <x-primary-button>
                                                        {{ __('Abrir comanda') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>
                                        @else
                                            <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap">
                                                <thead>
                                                    <tr class="text-center font-bold">
                                                        <td class="border px-3 py-2">Produto</td>
                                                        <td class="border px-3 py-2">Quantidade</td>
                                                        <td class="border px-3 py-2">Valor</td>
                                                    </tr>
                                                </thead>
                                                @foreach ($pedidos as $pedido)
                                                    @if ($pedido->id_mesa == $mesa->id)
                                                        <tr>
                                                            <td class="border px-3 py-2">{{ $pedido->produto }}
                                                            </td>
                                                            <td class="border px-3 py-2">{{ $pedido->quantidade }}
                                                            <td class="border px-3 py-2">R$
                                                                {{ $pedido->valor * $pedido->quantidade }}</td>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </table>

                                            <!-- Validation Errors -->
                                            <x-auth-validation-errors class="my-4" :errors="$errors" />

                                            <form method="POST" action="{{ route('pedidos.salvar') }}">
                                                @csrf

                                                <input type="hidden" name="idMesa" value="{{ $mesa->id }}">

                                                <div class="flex">
                                                    <!-- Quantidade -->
                                                    <div class="mt-4 flex-none">
                                                        <x-input-label for="quantidade" :value="__('Quantidade')" />

                                                        <x-text-input id="quantidade" class="block mt-1 w-20" type="number" min="0" name="quantidade"
                                                            :value="old('quantidade')" required />
                                                    </div>

                                                    <!-- Produto -->
                                                    <div class="mt-4 ml-4 flex-auto">
                                                        <x-input-label for="produto" :value="__('Produto')" />

                                                        <select id="produto"
                                                            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                                                            type="number" name="produto" :value="old('produto')" required>
                                                            <option selected disabled>Selecione um produto</option>
                                                            @foreach ($produtos as $produto)
                                                                <option value="{{ $produto->id }}">
                                                                    {{ $produto->produto }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="items-center text-center mt-4">
                                                    <x-primary-button>
                                                        {{ __('Adicionar pedido') }}
                                                    </x-primary-button>
                                                </div>
                                            </form>

                                            <div class="items-center text-center mt-4">
                                                <a class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150"
                                                    href="#">
                                                    {{ __('Fechar comanda') }}
                                                </a>
                                            </div>
                                        @endif
                                        <div class="w-full flex justify-start text-gray-600 mb-3">
                                            <button
                                                class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600"
                                                onclick="modalCloser({{ $mesa->id }})" role="button">X</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            let code = document.getElementById('success_code').value;

            if (code != '') {
                modalOpener(code);
            };
        };

        function modalOpener(id) {
            let modal = document.getElementById(id);

            modal.classList.remove('hidden');
        }

        function modalCloser(id) {
            let modal = document.getElementById(id);

            modal.classList.add('hidden');
        }
    </script>
</x-app-layout>
