<body class="bg-gradient-custom-regis">

    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                    </div>
                                    <form class="user" method='post' action='<?= base_url('auth/registration/') ?>'>
                                        <div class="form-group">
                                            <input autofocus type="text" class="form-control form-control-user"
                                                id="username" name='username' placeholder="Username"
                                                value='<?= set_value('username') ?>'>
                                            <?= form_error('username', '<small class="form-text text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="email"
                                                name='email' placeholder="Email Address"
                                                value='<?= set_value('email') ?>'>
                                            <?= form_error('email', '<small class="form-text text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user" id="pass"
                                                    name='pass' placeholder="Password">
                                                <?= form_error('pass', '<small class="form-text text-danger pl-3">', '</small>'); ?>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user"
                                                    id="pass-conf" name='pass-conf' placeholder="Repeat Password">
                                                <?= form_error('pass-conf', '<small class="form-text text-danger pl-3">', '</small>'); ?>
                                            </div>
                                        </div>
                                        <button type='submit' class="btn btn-primary btn-user btn-block">
                                            Register Account
                                        </button>

                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/forgot'); ?>">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url(); ?>">Already have an account? Login!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>