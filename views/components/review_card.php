<?php
/**
 * @var \App\Models\Review $review
 */
?>

<div class="card">
    <div class="card-header">
        User: <?php echo $review->user()->getName() ?>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <p><?php echo $review->comment() ?></p>
            <footer class="blockquote-footer">Rate <span
                        class="badge bg-warning warn__badge"><?php echo $review->rating() ?></span></footer>
        </blockquote>
    </div>
</div>