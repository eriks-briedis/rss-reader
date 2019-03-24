<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form method="POST" :action="loginUrl">
                            <input type="hidden" name="_token" :value="csrf">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label">Email</label>
                                <div class="col-md-6">
                                    <input id="email"
                                           type="email"
                                           class="form-control"
                                           :class="{'is-invalid': hasError}"
                                           name="email"
                                           :value="email" required autofocus>
                                    <span v-if="hasError" class="invalid-feedback" role="alert">
                                        <strong>Invalid email/password combination</strong>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label">Password</label>
                                <div class="col-md-6">
                                    <input id="password"
                                           type="password"
                                           class="form-control"
                                           name="password" required>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                    <div>
                                        <a class="btn btn-link" :href="registerUrl">
                                            Register here
                                        </a>
                                    </div>
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
        props: ['loginUrl', 'registerUrl', 'hasError', 'email', 'csrf']
    }
</script>
