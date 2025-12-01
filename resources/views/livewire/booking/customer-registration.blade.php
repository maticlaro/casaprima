<div class="bg-white rounded-lg shadow p-6">
    <h2 class="text-xl font-bold mb-4">Registro requerido</h2>
    <p class="text-gray-600 mb-6">Para agendar una cita necesitas tener una cuenta. Completa el formulario a continuación o inicia sesión si ya tienes una cuenta.</p>
    
    @error('registration')
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ $message }}
        </div>
    @enderror

    <form wire:submit="register">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre completo</label>
                <input type="text" id="name" wire:model="registrationData.name" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('registrationData.name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                <input type="tel" id="phone" wire:model="registrationData.phone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('registrationData.phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
        </div>

        <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" id="email" wire:model="registrationData.email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            @error('registrationData.email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Contraseña</label>
                <input type="password" id="password" wire:model="registrationData.password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                @error('registrationData.password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirmar contraseña</label>
                <input type="password" id="password_confirmation" wire:model="registrationData.password_confirmation" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <button type="submit" class="flex-1 px-6 py-3 bg-[#1C2B4B] text-white rounded-lg hover:bg-[#13213a] transition-colors duration-200">
                Crear cuenta y continuar
            </button>
            <button type="button" wire:click="showLoginForm" class="flex-1 px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors duration-200">
                Ya tengo cuenta
            </button>
        </div>
        
        <div class="mt-4 text-center">
            <button type="button" wire:click="cancel" class="text-gray-500 hover:text-gray-700 text-sm">
                Cancelar
            </button>
        </div>
    </form>
</div>
