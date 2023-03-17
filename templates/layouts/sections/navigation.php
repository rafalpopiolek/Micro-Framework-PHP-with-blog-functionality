<nav class="navbar navbar-expand-lg navbar-light bg-primary">
    <a class="navbar-brand" href="/">
        Venture Labs - Blog
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Features</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
        </ul>
        <ul class="navbar-nav">
            <?php
            if (! isAuth()): ?>
                <li class="nav-link">
                    <a href="/blog/?action=login" class="text-dark">
                        <button class="btn btn-sm btn-light border border-dark rounded">Login</button>
                    </a>
                    <a href="/blog/?action=register" class="text-dark">
                        <button class="btn btn-sm btn-light border border-dark rounded">Register</button>
                    </a>
                </li>
            <?php
            endif; ?>

            <?php
            if (isAuth()): ?>
                <li class="nav-link">
                    <form action="/blog/?action=logout" method="POST">
                        <button type="submit" class="btn btn-light border border-dark rounded">
                            Logout
                        </button>
                    </form>
                </li>
            <?php
            endif; ?>
        </ul>
    </div>
</nav>
