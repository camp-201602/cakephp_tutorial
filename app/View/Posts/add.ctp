<h2>Add Title</h2>

<?php debug($this->request->data);?>
<?php
echo $this->Form->create('Post');?>
<h4>title</h4>

<?php
echo $this->Form->imput('title');
echo $this->Form->imput('body',array('rows'=>'3'));
echo $this->Form->end('Save Post');
?>