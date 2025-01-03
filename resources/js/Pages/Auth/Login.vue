<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="background-container">
        <div class="content-container">
            <Head title="Log in" />
            <AuthenticationCard>
                <div class="logo-container">
                    <img src="img/logoSalon.png" class="imageFull"> 
                </div>

                <div v-if="status" class="status-message">
                    {{ status }}
                </div>

                <form @submit.prevent="submit">
                    <div class="form-group">
                        <InputLabel for="email" value="Correo electrónico" />
                        <TextInput
                            id="email"
                            v-model="form.email"
                            type="email"
                            class="input-field"
                            required
                            autofocus
                            autocomplete="username"
                        />
                        <InputError class="error-message" :message="form.errors.email" />
                    </div>

                    <div class="form-group">
                        <InputLabel for="password" value="Contraseña" />
                        <TextInput
                            id="password"
                            v-model="form.password"
                            type="password"
                            class="input-field"
                            required
                            autocomplete="current-password"
                        />
                        <InputError class="error-message" :message="form.errors.password" />
                    </div>

                    <div class="remember-me">
                        <label class="checkbox-label">
                            <!-- <Checkbox v-model:checked="form.remember" name="remember" /> -->
                            <!-- <span>Remember me</span> -->
                        </label>
                    </div>

                    <div class="form-actions flex justify-center">
                        <Link
                            v-if="canResetPassword"
                            :href="route('password.request')"
                            class="forgot-password"
                        >
                       
                        </Link>
                        <PrimaryButton
                            class="login-button"
                            :class="{ 'processing': form.processing }"
                            :disabled="form.processing"
                        >
                            Ingresar
                        </PrimaryButton>
                    </div>
                </form>
            </AuthenticationCard>
        </div>
    </div>
</template>


<style scoped>
/* Fondo principal */
.background-container {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    position: relative;
    background: url('/img/mainbg.png') no-repeat center center;
    background-size: cover;
    background-position: center;
}

.background-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(195, 179, 174, 0.5); /* Overlay */
    z-index: 1;
}

.content-container {
    position: relative;
    max-width: 600px; /* Aumenta el tamaño del cuadro */
    width: 100%;
    border-radius: 16px;
    background: linear-gradient(145deg, #ffffff, #f8e8f2);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    padding: 48px 32px; /* Añadí más espacio dentro del cuadro */
    z-index: 2;
    animation: fadeIn 1s ease-in-out; /* Animación */
}

.content-container:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

/* Espacio para el logo */
.logo-container {
    display: flex;
    justify-content: center;
    margin-bottom: 24px;
}

/* Estilos del formulario */
.status-message {
    text-align: center;
    font-size: 14px;
    color: #4caf50;
    margin-bottom: 16px;
}

.form-group {
    margin-bottom: 20px;
}

.input-field {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    transition: all 0.3s;
}

.input-field:focus {
    border-color: #c89fa5;
    box-shadow: 0 0 0 4px rgba(200, 159, 165, 0.2);
    outline: none;
}

.error-message {
    font-size: 12px;
    color: #e63946;
    margin-top: 4px;
}

/* Checkbox */
.remember-me {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 14px;
    color: #555;
}

/* Botón de login */
.login-button {
    background-color: #c89fa5;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 12px 20px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.login-button:hover {
    background-color: #a8818a;
}

.processing {
    opacity: 0.7;
    cursor: not-allowed;
}

/* Forgot password */
.forgot-password {
    font-size: 14px;
    color: #6b7280;
    text-decoration: underline;
    margin-right: 16px;
}

.forgot-password:hover {
    color: #444;
}

/* Animación de entrada */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Ajustes responsivos */
@media (max-width: 768px) {
    .content-container {
        padding: 32px;
    }
}
</style>
