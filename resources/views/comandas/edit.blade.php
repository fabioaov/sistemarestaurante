<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Comanda > ') }} {{ $comanda->id }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <table class="w-full whitespace-no-wrapw-full whitespace-no-wrap mb-4">
                        <thead>
                            <tr class="text-center font-bold">
                                <td class="border px-3 py-2">Produto</td>
                                <td class="border px-3 py-2">Quantidade</td>
                                <td class="border px-3 py-2">Valor</td>
                            </tr>
                        </thead>
                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td class="border px-3 py-2">{{ $pedido->produto }}
                                </td>
                                <td class="border px-3 py-2">{{ $pedido->quantidade }}
                                <td class="border px-3 py-2">R$
                                    {{ $pedido->valor * $pedido->quantidade }}</td>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('comandas.atualizar', $comanda->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Pagantes -->
                        <div>
                            <x-input-label for="pagantes" :value="__('Pagantes')" />

                            <x-text-input id="pagantes" class="block mt-1 w-full" type="text" name="pagantes" :value="old('pagantes')" required autofocus />
                        </div>

                        <!-- Método de pagamento -->
                        <div class="mt-4">
                            <x-input-label for="metodo" :value="__('Produto')" />

                            <select id="metodo"
                                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full"
                                type="number" name="metodo" :value="old('metodo')" required>
                                <option selected disabled>Selecione o método de pagamento</option>
                                @foreach ($metodos as $metodo)
                                    <option value="{{ $metodo->id }}">
                                        {{ $metodo->metodo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Salvar') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
