<!--  -->

<h2><?=$title?></h2>

<?php if (Core\Session::getInstance()->get("userId")): ?>

<a href="/logout">Sign Out</a>
<?php endif ?>