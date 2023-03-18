<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-5">Login</h3>

                    <?php include_once VIEW_PATH . '/partials/errors.php';  ?>

                    <form action="/blog/?action=login" method="POST">

                        <div class="form-floating mb-3">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" placeholder="Username"
                                   name="username">
                        </div>

                        <div class="form-floating mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password"
                                   name="password">
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-outline-primary px-5 my-2">Log in</button>
                        </div>
                    </form>
                    <a href="/blog/?action=register" class="d-flex mt-3">
                        Don't have an account? Create one
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
