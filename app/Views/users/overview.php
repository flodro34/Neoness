<div class="container flex flex-col mx-auto mt-6 px-4 md:max-w-xl">  
<?php if (! empty($users) && is_array($users)): ?>
    <h3 class=" text-center text-white font-bold bg-red-700 border border-red-700 rounded-lg px-5 py-2.5 mr-2 mb-2"><?= esc($title) ?></h3>
    <div class="flex flex-col mx-auto px-4 md:max-w-xl">
        <button type="button" 
            class="text-gray-900 border border-red-700 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
            Create a new user
        </button>
    </div>
    <br>
    <div class="main">
        <table>
            <tr>
                <th>Users</th>
            </tr>
            <?php foreach ($users as $users_item): ?>
                                        
                <tr class="users">                          
                    <td class="first"><?= esc($users_item['firstname']) ?> <?= esc($users_item['lastname']) ?></td>
                    <td>--------------------------------</td>
                    <td>
                        <button 
                        type="button"
                        class="text-gray-900 bg-gray-300 border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 ml-9 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Edit</button>
                    </td>
                    <td>
                        <button 
                        type="button"
                        class="text-gray-900 bg-gray-300 border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                        Delete</button>
                    </td>
                </tr>
            
            <!-- <p><a href="/users/<?= esc($users_item['id'], 'url') ?>">View Users</a></p> -->        
            <?php endforeach ?>
        </table>
    </div>
<?php else: ?>

    <h3>No Users</h3>
    <p>😩</p>
    <p>Unable to find any user for you.</p>

<?php endif ?>
</div>