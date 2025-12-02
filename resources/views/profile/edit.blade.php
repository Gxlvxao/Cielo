<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-graphite leading-tight">
            Gestão do Perfil
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
        <!-- Profile Information -->
        <div class="p-6 sm:p-8 bg-white shadow-xl sm:rounded-lg border-t-4 border-accent">
            <div class="max-w-xl">
                <h2 class="text-2xl font-bold text-graphite mb-4">Informações do Perfil</h2>
                <p class="text-gray-600 mb-6">Atualize as informações de perfil e endereço de e-mail da sua conta.</p>
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Update Password -->
        <div class="p-6 sm:p-8 bg-white shadow-xl sm:rounded-lg border-t-4 border-graphite">
            <div class="max-w-xl">
                <h2 class="text-2xl font-bold text-graphite mb-4">Atualizar Senha</h2>
                <p class="text-gray-600 mb-6">Certifique-se de que sua conta está usando uma senha longa e aleatória para se manter segura.</p>
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete Account -->
        <div class="p-6 sm:p-8 bg-white shadow-xl sm:rounded-lg border-t-4 border-red-600">
            <div class="max-w-xl">
                <h2 class="text-2xl font-bold text-red-600 mb-4">Excluir Conta</h2>
                <p class="text-gray-600 mb-6">Depois que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Antes de excluir sua conta, baixe quaisquer dados ou informações que deseje reter.</p>
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</x-app-layout>
