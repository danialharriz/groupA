<div class="card shadow-sm">
    <div class="card-header">
        <h3 class="card-title">Update Post</h3>
        <div class="card-toolbar">
            <?php if(isLoggedIn()): ?>
            <a href="<?php echo URLROOT;?>/posts" class="btn btn-light-primary">Manage Posts</a>
            <?php endif; ?>
        </div>
    </div>
    <div class="card-body">
        <form action="<?php echo URLROOT; ?>/posts/update/<?php echo $data['post']->id ?>" method="POST">
            <div class="mb-10">
                <label for="exampleFormControlInput1" class="required form-label">Title</label>
                <input type="text" name="title" class="form-control form-control-solid"
                    value="<?php echo $data['post']->title ?>" required />
            </div>

            <div class="mb-10">
                <label for="exampleFormControlInput1" class="form-label">Content</label>
                <div class="position-relative">
                    <div class="required position-absolute top-0"></div>
                    <textarea name="body" class="form-control" aria-label="With textarea"
                        required><?php echo $data['post']->body;?></textarea>
                </div>
            </div>

            <button type="submit" class="btn btn-primary font-weight-bold">Submit</button>

        </form>

    </div>
    <div class="card-footer">
        Footer
    </div>
</div>