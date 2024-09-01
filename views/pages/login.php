<?php
/**
 * @var \App\Kernel\View\ $view ;
 * @var \App\Kernel\Session\Session $session ;
 */

?>
<?php $view->component('head') ?>

<main class="form-signin w-100 m-auto">
    <form action="/login" method="post" style="display: flex; flex-direction: column; gap: 10px;">

        <div class="d-flex" style="align-items: start; justify-content: space-between; flex-direction: column">
            <h2>Log in</h2>
            <a href="/" class="d-flex align-items-center mb-5 mb-lg-0 text-white text-decoration-none">
                <h5 class="m-0">PHP-MOVIE-SITE <span class="badge bg-warning warn__badge">made by @valdemarus_dev</span></h5>
            </a>
        </div>
        <?php if ($session->has('error')) { ?>
            <div class="alert alert-danger">
                <?php echo $session->getFlash('error') ?>
            </div>
        <?php } ?>
        <div class="form-floating mt-3">
            <input
                    type="email"
                    class="form-control"
                    name="email"
                    id="floatingInput"
                    placeholder="johndoe@gmail.com"
            >
            <label for="floatingInput">E-mail</label>
        </div>
        <div class="form-floating">
            <input
                    type="password"
                    name="password"
                    class="form-control"
                    id="floatingPassword"
                    placeholder="********"
            >
            <label for="floatingPassword">password</label>
        </div>
        <button class="btn btn-primary w-100 py-2" type="submit">log in</button>
        <p class="mt-5 mb-3 text-body-secondary">&copy; PHP-MOVIE-SITE</p>
    </form>
</main>
<?php $view->component('footer') ?>
