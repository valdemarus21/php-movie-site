<?php
/**
 * @var \App\Kernel\View\ $view ;
 * @var \App\Kernel\Session\Session $session ;
 */

?>

<?php $view->component('header') ?>

<body>
<h1>admin</h1>
<form action="/admin/movies/add" method="POST" enctype="multipart/form-data">
    <p>Name</p>
    <div>
        <label>
            <input type="text" name="username"/>
        </label>
    </div>
    <?php if ($session->has('username')) { ?>
        <ul>
            <?php foreach ($session->getFlash('username') as $errors) {
                foreach ($errors as $error) {
                    ?>
                    <li style="color: red;"><?php echo $error ?></li>
                <?php }
            } ?>
        </ul>
    <?php } ?>
    <div>
        <input type="file" name="image"/>
    </div>
    <div>
        <button type="submit">Add</button>
    </div>
</form>

</body>


<?php $view->component('footer') ?>
