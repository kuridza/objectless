<?php $this->layout('layout', ['menu' => $menu]); ?>

<h2>Manage pages</h2>
<hr>
<?php foreach($menu as $i => $item): ?>
    <a class="p-2 text-muted" href="<?php echo $item; ?>">
        <?php echo urldecode($item); ?>
    </a>
    <a class="p-2 text-info" href="/edit?id=<?php echo $i; ?>">edit</a>
    <a class="p-2 text-danger" href="/delete?id=<?php echo $i; ?>" onclick="return confirm('Are you sure?')">delete</a>
    <hr>
<?php endforeach; ?>
<a class="p-2 text-info" href="/add">add page</a>
<hr>
