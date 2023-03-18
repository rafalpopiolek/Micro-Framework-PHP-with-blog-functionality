<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title text-center mb-5">Register</h3>

                    <?php include_once VIEW_PATH . '/partials/errors.php'; ?>

                    <form action="/blog/?action=register" method="POST">

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
                            <button type="submit" class="btn btn-outline-primary px-5 my-2">Sign up</button>
                        </div>
                    </form>
                    <div class="d-flex justify-content-between">
                        <a href="/blog/?action=login" class="d-flex mt-3">
                            Already have an account? Login here
                        </a>

                        <a href="/blog" class="d-flex mt-3">
                            Home Page
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
