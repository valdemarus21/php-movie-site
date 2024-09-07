<?php
/**
 * @var \App\Kernel\View\ViewInterface $view
 * @var array<\App\Models\Category> $categories
 */
?>

<?php $view->component('head') ?>

    <main>
        <div class="container">
            <h3 class="mt-3">Genres</h3>
            <hr>

            <div class="movies">
                <?php foreach ($categories as $category) { ?>
                    <a href="#" class="card text-decoration-none movies__item">
                        <img src="https://s.studiobinder.com/wp-content/uploads/2022/02/What-is-Genre-TV-and-Film-Genre-Definition-and-Examples-of-Genre-Conventions-scaled.jpg" height="200px" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $category->name() ?></h5>
                            <p class="card-text">Movies<span class="badge bg-info warn__badge">10</span></p>
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </main>

<?php $view->component('footer') ?>