<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Produtos > Novo produto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('produtos.salvar') }}">
                        @csrf

                        <!-- Produto -->
                        <div>
                            <x-input-label for="produto" :value="__('Produto')" />

                            <x-text-input id="produto" class="block mt-1 w-full" type="text" name="produto"
                                :value="old('produto')" required autofocus />
                        </div>

                        <!-- Valor -->
                        <div class="mt-4">
                            <x-input-label for="valor" :value="__('Valor')" />

                            <x-text-input id="valor" class="block mt-1 w-full" type="number" step=0.01 name="valor"
                                :value="old('valor')" required />
                        </div>

                        <!-- Estoque -->
                        <div class="mt-4">
                            <x-input-label for="estoque" :value="__('Estoque')" />

                            <x-text-input id="estoque" class="block mt-1 w-full" type="number" name="estoque"
                                :value="old('estoque')" required />
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
