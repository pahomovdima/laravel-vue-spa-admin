<template>
    <div>
        <h1>
            {{ $t('auth.login.title') }}
        </h1>

        <login-form
            @submit="onSubmit"
            :errors="authErrors"
            :loading="loading"
        />
    </div>
</template>

<script>
    import LoginForm from './LoginForm';

    export default {
        name: 'Login',
        components: {LoginForm},
        data() {
            return {
                authErrors: {},
                loading: false,
            }
        },
        methods: {
            async onSubmit(loginData) {
                this.$auth
                    .login({
                        data: loginData,
                    })
                    .then(() => {
                        // success
                    }, error => {
                        if (error.response.status === 422) {
                            this.authErrors = error.response.data.errors;
                        }
                    })
                    .finally(() => this.loading = false);
            }
        }
    }
</script>
