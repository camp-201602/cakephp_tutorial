<h2>Edit Post</h2>

<?php
echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('body');
echo $this->Form->input('id');
echo $this->Form->end('Save Post');
?>