<?php
/**
 * @var  $view ;
 * @var array<\App\Models\Movie> $movies ;
 */


?>

<?php $view->component('head') ?>


<main>
    <div class="container">
        <h3 class="mt-3">NEW</h3>
        <hr>
        <div class="movies">
            <?php foreach ($movies as $movie): ?>
                <?php $view->component('movie', ['movie' => $movie]) ?>
            <?php endforeach; ?>


        </div>
    </div>
</main>


<?php $view->component('footer') ?>
