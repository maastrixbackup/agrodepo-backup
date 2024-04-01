<style>
	input{width:30%}
</style>

<div style="float:left">

</div>

<div style="float:left">
	<?php echo @$err_message;?>
	<?php
		echo $this->Form->create('MasterUser',array('url'=>array('controller'=>'Logins','actions'=>'login')));
		echo $this->Form->input('Email',array('autocomplete'=>'off','required'=>'required'));
		echo $this->Form->input('Password',array('type'=>'password','autocomplete'=>'off','required'=>'required'));
		echo $this->Form->input('Login',array('type'=>'submit','div'=>'false','label'=>''));
		echo $this->Form->end();
	?>
</div>
