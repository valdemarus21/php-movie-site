<?php
/**
 * @var \App\Kernel\View\ $view ;
 * @var \App\Kernel\Session\Session $session ;
 * @var array<\App\Models\Category> $categories ;
 * @var \App\Models\Movie $movie ;
 */

?>

<?php $view->component('head') ?>

<main>
    <div class="container">
        <h3 class="mt-3">Change movie</h3>
        <hr>
    </div>
    <div class="container">
        <form action="/admin/movies/update" method="post" enctype="multipart/form-data"
              class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
            <input type="hidden" value="<?php echo $movie->id() ?>" name="id">
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                        <input
                                type="text"
                                class="form-control <?php echo $session->has('name') ? 'is-invalid' : '' ?>"
                                id="name"
                                name="name"
                                placeholder="Movie name"
                                value="<?php echo $movie->name() ?>"
                        >
                        <label for="name">Name</label>
                        <?php if ($session->has('name')) { ?>
                            <div id="name" class="invalid-feedback">
                                <?php echo $session->getFlash('name')[0] ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md">
                    <div class="form-floating">
                            <textarea
                                    style="height: 100px"
                                    type="text"
                                    class="form-control <?php echo $session->has('description') ? 'is-invalid' : '' ?>"
                                    id="description"
                                    name="description"

                                    placeholder="Film about ..."
                            ><?php echo $movie->description() ?></textarea>
                        <label for="name">Description</label>
                        <?php if ($session->has('description')) { ?>
                            <div id="name" class="invalid-feedback">
                                <?php echo $session->getFlash('description')[0] ?>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <div class="col-md">
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input class="form-control" type="file" name="image" id="image">
                    </div>
                </div>
            </div>
            <div class="row g-2">
                <select class="form-select" name="category">
                    <option selected>Genre</option>
                    <?php foreach ($categories as $category) { ?>
                        <option value="<?php echo $category->id() ?>" <?php echo $category->id() === $movie->categoryId() ? "selected" : "" ?>>
                            <?php echo $category->name() ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="row g-2">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
</main>


<?php $view->component('footer') ?>
