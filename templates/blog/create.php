<div class="container">
    <form action="/blog" method="POST">
        <div class="form-group">
            <div>
                <label for="text">Enter blog text</label>
                <textarea name="text"
                          class="form-control"
                          id="text"
                          rows="3"
                          required
                          minlength="5"
                          maxlength="2000"></textarea>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary px-5 border">
                    Create
                </button>
            </div>
        </div>
    </form>
</div>
