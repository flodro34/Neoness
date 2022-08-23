<h2><?= esc($title) ?></h2>

<?php if (! empty($users) && is_array($users)): ?>

    <?php foreach ($users as $users_item): ?>

        <h3><?= esc($users_item['title']) ?></h3>

        <div class="main">
            <?= esc($users_item['fistname']) ?>
            <?= esc($users_item['lastname']) ?>
        </div>
        <p><a href="/users/<?= esc($users_item['slug'], 'url') ?>">View Users</a></p>

    <?php endforeach ?>

<?php else: ?>

    <h3>No Users</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>