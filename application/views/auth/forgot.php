<body class="bg-gradient-custom-forgot">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-5 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-7">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form class="user" method="post" action="<?= base_url('auth/forgot'); ?>">
                                        <div class="form-group">
                                            <input autofocus type="email" class="form-control form-control-user"
                                                id="email" aria-describedby="emailHelp" name='email'
                                                placeholder="Enter Email Address...">
                                            <?= form_error('email', '<small class="form-text text-danger pl-3">', '</small>'); ?>
                                        </div>
                                        <button type='submit' class="btn btn-primary btn-user btn-block">
                                            Reset Password
                                        </button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth/registration'); ?>">Create an
                                            Account!</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="<?= base_url('auth'); ?>">Already have an account?
                                            Login!</a>
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