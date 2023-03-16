<h1>Blogs</h1>

<div class="container">
    <div class="d-flex justify-content-end">
        <a href="/blog/?action=create">
            <button class="btn btn-primary">Create</button>
        </a>
    </div>

    <div class="mt-3">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">UserId</th>
                <th scope="col">Text</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $i = 1;
            foreach ($this->data as $blog): ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $blog['userid'] ?></td>
                    <td><?= $blog['text'] ?></td>
                    <td>Delete</td>
                </tr>
                <?php
                $i++;
            endforeach;
            ?>
            </tbody>
        </table>

    </div>
</div>
