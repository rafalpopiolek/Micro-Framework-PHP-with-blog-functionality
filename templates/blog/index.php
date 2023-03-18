<h1>Blogs</h1>

<div class="container">
    <?php if(isAuth()): ?>
        <div class="d-flex justify-content-end">
            <a href="/blog/?action=create">
                <button class="btn btn-primary">Create</button>
            </a>
        </div>
    <?php endif; ?>

    <div class="mt-3">
        <table id="blogsTable">
            <thead>
            <tr>
                <th>Username</th>
                <th>Text</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>
