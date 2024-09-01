<?php

/**
 * @var \App\Kernel\Auth\AuthInterface $auth;
 */

$user = $auth->user();
?>

<?php if($auth->check()){ ?>
<header>
    <h3>user : <?php echo $user->getEmail() ?></h3>
    <form action="/logout" method="post">

    <button>logout</button>
    </form>
    <hr/>
</header>
<?php } ?>
