<h2>Create client</h2>

<?php if (isset($this->occu->controller->view_data->success)) { ?>
	<p><strong>Your client has been saved.</strong></p>
<?php } ?>

<?php if (isset($this->occu->controller->view_data->validation_errors)) { ?>
	<p><strong>ERROR:</strong> The following fields must be unique: <?php print implode(', ', $this->occu->controller->view_data->validation_errors); ?> </p>
<?php } ?>

<span style="color:red">*</span> - This field is required.
<form action="?v=client/create" method="POST">
	<label for="name">Name</label> <span style="color:red">*</span>
	<input name="name" type="text" required value="<?=(isset($this->occu->controller->view_data->client->name)) ? $this->occu->controller->view_data->client->name : '' ?>"><br />

	<label for="address">Mailing Address</label>
	<input name="address" type="text" value="<?=(isset($this->occu->controller->view_data->client->address)) ? $this->occu->controller->view_data->client->address : '' ?>"><br />

	<label for="phone">Phone Number</label>
	<input name="phone" type="text" value="<?=(isset($this->occu->controller->view_data->client->phone)) ? $this->occu->controller->view_data->client->phone : '' ?>"><br />

	<label for="email">E-mail Address</label>
	<input name="email" type="text" value="<?=(isset($this->occu->controller->view_data->client->email)) ? $this->occu->controller->view_data->client->email : '' ?>"><br />
	
	<input type="submit" value="Submit" />
</form>