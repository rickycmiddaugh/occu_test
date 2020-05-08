<h2>Delete client</h2>

<?php if (isset($this->occu->controller->view_data->success)) { ?>
	<p><strong>Your client has been saved.</strong></p>
<?php } ?>

<p>Are you sure you want to delete client <?=$this->occu->controller->view_data->client->name;?> ?</p>
<p><strong>This action cannot be undone.</strong></p>

<form action="?v=client/delete/<?=$this->occu->controller->view_data->client->name;?>" method="POST">
	<input type="hidden" value="delete" name="delete" />
	<input type="submit" value="Delete Client" />
</form>