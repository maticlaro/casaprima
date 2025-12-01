<?php

namespace App\Livewire\Booking;

use Livewire\Component;

class CustomerRegistration extends Component
{
    public array $registrationData = [
        'name' => '',
        'email' => '',
        'phone' => '',
        'password' => '',
        'password_confirmation' => '',
    ];

    public function register(): void
    {
        $this->validate([
            'registrationData.name' => 'required|string|max:255',
            'registrationData.email' => 'required|string|email|max:255|unique:users,email',
            'registrationData.phone' => 'required|string|max:20',
            'registrationData.password' => 'required|string|min:8|confirmed',
        ], [
            'registrationData.name.required' => 'El nombre es obligatorio.',
            'registrationData.email.required' => 'El email es obligatorio.',
            'registrationData.email.email' => 'El email debe ser válido.',
            'registrationData.email.unique' => 'Este email ya está registrado.',
            'registrationData.phone.required' => 'El teléfono es obligatorio.',
            'registrationData.password.required' => 'La contraseña es obligatoria.',
            'registrationData.password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'registrationData.password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        try {
            $user = \App\Models\User::create([
                'name' => $this->registrationData['name'],
                'email' => $this->registrationData['email'],
                'password' => bcrypt($this->registrationData['password']),
            ]);

            // Create customer record
            \App\Models\Customer::create([
                'user_id' => $user->id,
                'first_name' => explode(' ', $this->registrationData['name'])[0],
                'last_name' => substr($this->registrationData['name'], strpos($this->registrationData['name'], ' ') + 1) ?: '',
                'phone_number' => $this->registrationData['phone'],
            ]);

            auth()->login($user);
            
            $this->reset(['registrationData']);
            
            // Dispatch event to parent component
            $this->dispatch('customer-registered');

        } catch (\Exception $e) {
            $this->addError('registration', 'Hubo un error al crear tu cuenta. Por favor, inténtalo de nuevo.');
            logger()->error('Error creating user: '.$e->getMessage());
        }
    }

    public function showLoginForm(): void
    {
        $this->redirect(route('login', ['redirect' => request()->url()]));
    }

    public function cancel(): void
    {
        $this->dispatch('registration-cancelled');
    }

    public function render()
    {
        return view('livewire.booking.customer-registration');
    }
}
