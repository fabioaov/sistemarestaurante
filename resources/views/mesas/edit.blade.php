<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mesas > ') }} {{ $mesa->mesa }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    <!-- Validation Errors -->
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form method="POST" action="{{ route('mesas.atualizar', $mesa->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Mesa -->
                        <div>
                            <x-input-label for="mesa" :value="__('Mesa')" />

                            <x-text-input id="mesa" class="block mt-1 w-full" type="text" name="mesa"
                                value="{{ $mesa->mesa }}" required autofocus />
                        </div>

                        <!-- Vagas -->
                        <div class="mt-4">
                            <x-input-label for="vagas" :value="__('Vagas')" />

                            <x-text-input id="vagas" class="block mt-1 w-full" type="number" name="vagas"
                                value="{{ $mesa->vagas }}" required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Salvar') }}
                            </x-primary-button>
                        </div>
                    </form>
                    <div class="flex items-center justify-end mt-4">
                        <form method="POST" action="{{ route('mesas.deletar', $mesa->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="inline-flex items-center px-4 py-2 bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150 ml-4">
                                {{ __('Deletar mesa') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
