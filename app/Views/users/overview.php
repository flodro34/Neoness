<div class="container flex flex-col mx-auto px-4 md:max-w-xl">  
<?php if (! empty($users) && is_array($users)): ?>
    <h3><?= esc($title) ?></h3>
    <br>
    <?php foreach ($users as $users_item): ?>

        <div class="main">
            <?= esc($users_item['firstname']) ?>
            <?= esc($users_item['lastname']) ?>
        </div>
        <!-- <p><a href="/users/<?= esc($users_item['id'], 'url') ?>">View Users</a></p> -->

    <?php endforeach ?>

<?php else: ?>

    <h3>No Users</h3>
    <p>😩</p>
    <p>Unable to find any user for you.</p>

<?php endif ?>
</div>