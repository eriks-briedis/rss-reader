<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Register</div>

                    <div class="card-body">
                        <form method="POST" :action="registerUrl">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                <div class="col-md-6">
                                    <input id="email"
                                           type="email"
                                           class="form-control"
                                           :class="{'is-invalid': hasEmailError || isEmailTaken}"
                                           name="email"
                                           v-model="currentEmail"
                                           required @blur="checkEmail">

                                    <span v-if="isEmailTaken" class="invalid-feedback" role="alert">
                                        <strong>Email already registered</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                <div class="col-md-6">
                                    <input id="password"
                                           type="password"
                                           class="form-control"
                                           :class="{'is-invalid': hasPasswordError}"
                                           name="password" required>

                                    <span v-if="passwordError" class="invalid-feedback" role="alert">
                                        <strong>{{ passwordError }}</strong>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['registerUrl', 'hasEmailError', 'hasPasswordError', 'passwordError', 'email', 'csrf'],
        data: () => {
            return {
                currentEmail: '',
                isEmailTaken: false
            };
        },
        mounted() {
            this.currentEmail = this.email;
        },
        methods: {
            checkEmail() {
                if (!this.currentEmail) {
                    return;
                }
                axios.post('/verify-email', {email: this.currentEmail})
                    .then(response => this.isEmailTaken = response.data);
            }
        }
    }
</script>
