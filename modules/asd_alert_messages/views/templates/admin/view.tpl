<div class="row">
	<div class="col-lg-3">
		<div class="panel">
			<div class="panel-heading" style="border: 0px solid black;">
				<h3 style="padding-left: 17px;">List of messages</h3>
			</div>

			<div class="panel-body" style="padding: 0;">

				{if count($messages) > 0}
					{foreach $messages AS $message}
						<div style="border-bottom: solid 1px #eee;display: inline-block;width: 100%;">
							<div style="width: 30px;float: left;" class="btn btn-danger"
								onclick="deleteAlert({$message['id']})"><i class="icon-trash"></i></div>
							<div style="width: calc( 100% - 30px );float: left; font-size: 16px; padding-left: 5px; padding-top: 5px;cursor: pointer;"
								onclick="openAlert({$message['id']})">{$message['title']}</div>
							<div style="display: none;">
								<input type="hidden" id="dashboard_message_id_{$message['id']}" value="{$message['id']}"></span>
								<input type="hidden" id="message_title_{$message['id']}" value="{$message['title']}"></span>
								<input type="hidden" id="title_en_{$message['id']}" value="{$message['title_en']}"></span>
								<input type="hidden" id="title_es_{$message['id']}" value="{$message['title_es']}"></span>
								<input type="hidden" id="title_fr_{$message['id']}" value="{$message['title_fr']}"></span>
								<input type="hidden" id="title_pt_{$message['id']}" value="{$message['title_pt']}"></span>
								<input type="hidden" id="title_it_{$message['id']}" value="{$message['title_it']}"></span>

								<input type="hidden" id="message_en_{$message['id']}" value="{$message['message_en']}"></span>
								<input type="hidden" id="message_es_{$message['id']}" value="{$message['message_es']}"></span>
								<input type="hidden" id="message_fr_{$message['id']}" value="{$message['message_fr']}"></span>
								<input type="hidden" id="message_ro_{$message['id']}" value="{$message['message_ro']}"></span>
								<input type="hidden" id="message_pt_{$message['id']}" value="{$message['message_pt']}"></span>
								<input type="hidden" id="message_it_{$message['id']}" value="{$message['message_it']}"></span>
								<input type="hidden" id="message_type_{$message['id']}"
									value="{$message['message_type']}"></span>
								<input type="hidden" id="message_status_{$message['id']}"
									value="{$message['message_status']}"></span>
							</div>
						</div>
					{/foreach}
				{else}
					<div> Sem mensagens a apresentar </div>
				{/if}

				<div>
					<button class="btn btn-success" type="button" onclick="newAlert()"
						style="text-transform: uppercase; font-size: 16px; width: 100%;margin-top: 20px;">
						Create new message
					</button>
				</div>

			</div>
		</div>
	</div>

	<div class="col-lg-9">
		<div class="panel">
			<div class="panel-heading text-center" style="border: 0px solid black;">
				<div style="margin: 10px 25px;">
					<span style="float: right;"><button type="button" class="btn btn-info" onclick="saveFormData()"
							id="save_button">Save</button></span>
					<span style="float: left;margin: 5px; font-size: 20px;" id="title_panel"></span>
				</div>
			</div>
			<div class="panel-body" style="padding: 0 15px;">
				<form action="/admin77500/index.php?controller=AdminDashboard&token={$token}&save_dashboard_message=1"
					method="post">
					<input type="hidden" value="0" id="dashboard_message_id" name="message_id">
					<div class="row">

						<div class="col-lg-6">
							<input placeholder="Message title" type="text" id="dashboard_message_title"
								name="dashboard_message_title" value=""
								onchange="$('#title_panel').text($(this).val())">

						</div>

						<div class="col-lg-12" style="padding: 1rem 0;">
							<div class="form-group col-lg-6">
								<label for="title_en" class="col-sm-2 col-form-label">Title EN</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="title_en" name="title_en">
								</div>
							</div>
							<div class="form-group col-lg-6">
								<label for="title_es" class="col-sm-2 col-form-label">Title ES</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="title_es" name="title_es">
								</div>
							</div>
							<div class="form-group col-lg-6">
								<label for="title_fr" class="col-sm-2 col-form-label">Title FR</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="title_fr" name="title_fr">
								</div>
							</div>
							<div class="form-group col-lg-6">
								<label for="title_pt" class="col-sm-2 col-form-label">Title PT</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="title_pt" name="title_pt">
								</div>
							</div>
							<div class="form-group col-lg-6">
								<label for="title_it" class="col-sm-2 col-form-label" name="title_it">Title IT</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="title_it" name="title_it">
								</div>
							</div>
						</div>
					

						<div class="col-lg-3" style="display: none;">
							<select name="dashboard_message_type" id="dashboard_message_type"
								onchange="set_message_type($(this).val())">
								<option {if Configuration::get('dashboard_message_type_1') == 1} selected="selected"
									{/if} value="1">Danger</option>
								<option {if Configuration::get('dashboard_message_type_1') == 2} selected="selected"
									{/if} value="2">Warning</option>
								<option {if Configuration::get('dashboard_message_type_1') == 3} selected="selected"
									{/if} value="3">Success</option>
								<option {if Configuration::get('dashboard_message_type_1') == 4} selected="selected"
									{/if} value="4">Info</option>
							</select>
						</div>

						<div class="col-lg-3">
							<input style="margin-top: 8px;" type="checkbox" id="enable_dashboard_message_type"
								name="enable_dashboard_message_type"
								{if Configuration::get('enable_dashboard_message_type') == 1} checked="checked" {/if}
								value="1"><span style="margin-left: 5px;">Enable message</span>
						</div>

						<div class="col-lg-12">
							<div class="spacer-10"></div>
						</div>

						<div class="col-lg-6">
							<div class="input-group-prepend">EN</div>
							<textarea class="textarea_input" name="dashboard_message_en" id="dashboard_message_en"
								oninput="set_message($(this).val())"></textarea>
						</div>
						<div class="col-lg-6">
							<div class="input-group-prepend">ES</div>
							<textarea class="textarea_input" name="dashboard_message_es" id="dashboard_message_es"
								oninput="set_message($(this).val())"></textarea>
						</div>

						<div class="col-lg-12">
							<div class="spacer-10"></div>
						</div>

						<div class="col-lg-6">
							<div class="input-group-prepend">FR</div>
							<textarea class="textarea_input" name="dashboard_message_fr" id="dashboard_message_fr"
								oninput="set_message($(this).val())"></textarea>
						</div>
						<div class="col-lg-6">
							<div class="input-group-prepend">RO</div>
							<textarea class="textarea_input" name="dashboard_message_ro" id="dashboard_message_ro"
								oninput="set_message($(this).val())"></textarea>
						</div>

						<div class="col-lg-12">
							<div class="spacer-10"></div>
						</div>

						<div class="col-lg-6">
							<div class="input-group-prepend">PT</div>
							<textarea class="textarea_input" name="dashboard_message_pt" id="dashboard_message_pt"
								oninput="set_message($(this).val())"></textarea>
						</div>


						<div class="col-lg-6">
							<div class="input-group-prepend">IT</div>
							<textarea class="textarea_input" name="dashboard_message_it" id="dashboard_message_it"
								oninput="set_message($(this).val())"></textarea>
						</div>

						<div class="col-lg-12"> </div>

						<div class="col-lg-12" style="display: none;">
							<h1 style="border: 0px solid black;">Preview</h1>
							<div style="min-height: 50px;" id="dashboard_preview_message" class="alert alert-info">
								
							</div>

							<div class="col-lg-12"> </div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<script>
		let message = "Write a message to preview";
		let message_type = "alert alert-info";

		function change_dashboard_type() {
			let html = '<div id="dashboard_preview_message" class="' + message_type + '">' + message + '</div>';
			$('#dashboard_preview_message').replaceWith(html);
		}

		function set_message(message_data) {
			message = message_data;
			change_dashboard_type();
		}

		function set_message_type(type) {

			if (type == 1) message_type = "alert alert-danger";
			else if (type == 2) message_type = "alert alert-warning";
			else if (type == 3) message_type = "alert alert-success";
			else message_type = "alert alert-info";

			change_dashboard_type();
		}

		function saveFormData() {

			let id = $('#dashboard_message_id').val();
			let title = $('#dashboard_message_title').val();
			let message_type = $('#dashboard_message_type').val();
			let message_status = document.getElementById('enable_dashboard_message_type').checked;

			let title_en = $('#title_en').val();
			let title_es = $('#title_es').val();
			let title_fr = $('#title_fr').val();
			let title_ro = $('#title_ro').val();
			let title_pt = $('#title_pt').val();
			let title_it = $('#title_it').val();

			let message_en = $('#dashboard_message_en').val();
			let message_es = $('#dashboard_message_es').val();
			let message_fr = $('#dashboard_message_fr').val();
			let message_ro = $('#dashboard_message_ro').val();
			let message_pt = $('#dashboard_message_pt').val();
			let message_it = $('#dashboard_message_it').val();

			$.ajax({
				type: 'POST',
				url : '/admineuromus1/index.php?controller=AdminWmModuleAlertMessages&action=saveMessage&token={Tools::getValue("token")}',
				data: {
					'id': id,
					'title': title,
					'title_en' : title_en,
					'title_es' : title_es,
					'title_fr' : title_fr,
					'title_pt' : title_pt,
					'title_it' : title_it,
					'message_type': message_type,
					'message_status': message_status,
					'message_en': message_en,
					'message_es': message_es,
					'message_fr': message_fr,
					'message_ro': message_ro,
					'message_pt': message_pt,
					'message_it': message_it,
				},
				success: function(data) {}
			});

			setTimeout(function() {
				location.reload();
			}, 3000);

		}

		function deleteAlert(index) {

			var result = confirm("Are you sure you want to delete de message?");

			if (result) {

				$.ajax({
					type: 'POST',
					url : '/admineuromus1/index.php?controller=AdminWmModuleAlertMessages&action=deleteMessage&token={Tools::getValue("token")}&id='+index,
					data: {
						'id': index
					},
					success: function(data) {}
				});

				setTimeout(function() {
					location.reload();
				}, 2000);
			}
		}

		function openAlert(index) {

			$('#dashboard_message_id').val($('#dashboard_message_id_' + index).val());
			$('#dashboard_message_title').val($('#message_title_' + index).val());
			$('#title_en').val($('#title_en_' + index).val());
			$('#title_es').val($('#title_es_' + index).val());
			$('#title_fr').val($('#title_fr_' + index).val());
			$('#title_pt').val($('#title_pt_' + index).val());
			$('#title_it').val($('#title_it_' + index).val());


			$('#dashboard_message_type').val($('#message_type_' + index).val());
			$('#dashboard_message_en').val($('#message_en_' + index).val());
			$('#dashboard_message_es').val($('#message_es_' + index).val());
			$('#dashboard_message_fr').val($('#message_fr_' + index).val());
			$('#dashboard_message_ro').val($('#message_ro_' + index).val());
			$('#dashboard_message_pt').val($('#message_pt_' + index).val());
			$('#dashboard_message_it').val($('#message_it_' + index).val());

			if ($('#message_status_' + index).val() == 1) {
				$('#enable_dashboard_message_type').prop('checked', 'checked');
			} else {
				$('#enable_dashboard_message_type').prop('checked', '');
			}

			set_message($('#dashboard_message_en').val());
			set_message_type($('#dashboard_message_type').val());

			$('#title_panel').text($('#message_title_' + index).val());
			$('#title_en').text($('#title_' + index).val());

			change_dashboard_type();
		}

		function newAlert() {

			$('#dashboard_message_id').val(0);
			$('#dashboard_message_title').val('');
			$('#dashboard_message_type').val('');
			$('#dashboard_message_en').val('');
			$('#dashboard_message_es').val('');
			$('#dashboard_message_fr').val('');
			$('#dashboard_message_ro').val('');
			$('#dashboard_message_pt').val('');
			$('#dashboard_message_it').val('');
			$('#enable_dashboard_message_type').prop('checked', '');

			set_message("Write a message to preview");
			set_message_type(1);
			change_dashboard_type();
		}

		$(document).ready(function() {
			change_dashboard_type();
		});
	</script>
	<style>
		.spacer-1 {
			width: 100%;
			height: 1px;
			display: inline-block;
		}

		.spacer-5 {
			width: 100%;
			height: 5px;
			display: inline-block;
		}

		.spacer-10 {
			width: 100%;
			height: 10px;
			display: inline-block;
		}

		.spacer-20 {
			width: 100%;
			height: 20px;
			display: inline-block;
		}

		.textarea_input {
			height: 100px !important;
			width: calc(100% - 30px) !important;
			float: left;
		}

		.input-group-prepend {
			height: 100px;
			line-height: 6;
			width: 30px;
			float: left;
			padding: 3px 5px;
			font-size: 16px;
			background-color: #dfe7ea;
			border: 1px solid #C7D6DB;
		}

		#save_button {
			width: 50px;
			font-size: 16px;
			text-transform: uppercase;
			margin-top: 5px;
		}
</style>