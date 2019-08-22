<body class="bg-gradient-custom-login">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-5 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Login Page</h1>
                                    </div>
                                    <form class="user" method="post" action='<?= base_url("auth/") ?>'>
                                        <div class="form-group">
                                            <input autofocus type="text" class="form-control form-control-user"
                                                id="email" name='email' aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." value='<?= set_value('email') ?>'>
                                            <?= form_error('email', '<small class="form-text text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                name='pass' placeholder="Password" value='<?= set_value('pass') ?>'>
                                            <?= form_error('pass', '<small class="form-text text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <button type='submit' href="<?= base_url(); ?>"
                                            class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                        <!-- <hr> -->
                                        <!-- <a href="index.html" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Login with Google
                                        </a>
                                        <a href="index.html" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Login with Facebook
                                        </a> -->
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a href='<?= base_url('auth/forgot'); ?>' class="small">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a href='<?= base_url('auth/registration'); ?>' class="small"
                                            href="register.html">Create
                                            an Account!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <?= $this->session->flashdata('flash'); ?>