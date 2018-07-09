<?php $this->layout('layout', ['menu' => $menu]); ?>

<h2><?php echo $title; ?> page</h2>
<hr>
<form method="post" action="/save<?php if($title === 'edit') echo '/?id=' . $id; ?>">
    <div class="form-group">
        <input name="title" class="form-control" placeholder="title" value="<?php if($title === 'edit') echo $post[0]; ?>">
        <br>
        <input name="position" value="<?php if($title === 'edit') echo $id; else echo count($menu); ?>" class="form-control" type="number" placeholder="position">
        <br>
        <textarea name="content" placeholder="content" class="form-control" rows="3"><?php if($title === 'edit') echo $post[1]; ?></textarea>
        <br>
        <button class="btn btn-primary">Save</button>
    </div>
</form>
