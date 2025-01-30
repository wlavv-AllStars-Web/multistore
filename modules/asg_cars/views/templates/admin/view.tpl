{if $alert_only_asm}
	<div class="alert alert-danger" role="alert">
		Only works on ALL STARS MOTORSPORT
	</div>
{else}

<div class="row">
	<div class="col-lg-12">
		<div class="panel">
			<div class="panel-heading" style="border: 0px solid black;">
				<h3 style="padding-left: 17px;">List of cars</h3>
			</div>

			<div class="panel-body" style="padding: 0;">

				{if count($cars) > 0}
					<div id="sortable-cars" class="row" style="display: flex;flex-wrap:wrap">
					{foreach $cars AS $car}
						{* <pre>{$car['images'][0]|print_r}</pre> *}
						<div class="col-lg-2 car-item" data-id="{$car['id_asg_car']}" style="border-bottom: solid 1px #eee;display: flex;flex-direction:column;border-radius: .25rem;padding:0 .5rem; 1rem .5rem">
							<div class="col-lg-12" style="padding:0;border: 2px solid #333;">

								<img src="/{$car['images'][0]}" alt="Car Image" style="width: 100%;"/>
						
							</div>
							<div class="col-lg-12" style="padding: .5rem;display:flex;flex:1;flex-direction:column-reverse;border: 2px solid #333;border-top:0;justify-content: space-between;background-color: #fff;">
								<div style="width: 30px;display:flex;justify-content: center;" class="btn btn-danger"
									onclick="deleteAlert({$car['id_asg_car']})"><i class="icon-trash"></i></div>
								<div style="width: calc( 100% - 30px );float: left; font-size: 16px; padding-left: 5px; padding-top: 5px;cursor: pointer;
								overflow: hidden;
								display: -webkit-box;
								-webkit-line-clamp: 2; /* number of lines to show */
										line-clamp: 2; 
								-webkit-box-orient: vertical;"
								onclick="openAlert({$car['id_asg_car']})">{$car['car_name']}</div>
							</div>
							<div style="display: none;">
								<input type="hidden" name="id_{$car['id_asg_car']}" value="{$car['id_asg_car']}"> <!-- For updates, pass the record ID -->
								<input type="text" name="name_{$car['id_asg_car']}" placeholder="Car Name" value="{$car['car_name']}" required>
								<textarea name="description_{$car['id_asg_car']}" placeholder="Car Description" value="{$car['description']}"></textarea>
								<input type="number" name="id_shop_{$car['id_asg_car']}" placeholder="Shop ID" required value="{$context->shop->id}">
								
								<input id="images_{$car['id_asg_car']}" type="file" name="images[]" multiple accept="image/*">

								<div style="display: none;" id="hidden_inputs_{$car['id_asg_car']}">
									{foreach $languages AS $lang}
										{if isset($car['products'][$lang.id_lang]) && count($car['products'][$lang.id_lang]) > 0}
											{foreach $car['products'][$lang.id_lang] AS $category => $products}
												{foreach $products AS $product}
													<input type="hidden" 
														name="product_{$car['id_asg_car']}_{$category}_{$product['id_asg_car_product']}_{$lang.id_lang}_name" 
														idlang="{$lang.id_lang}"
														value="{$product['product_name']}">
													<input type="hidden" 
														name="product_{$car['id_asg_car']}_{$category}_{$product['id_asg_car_product']}_{$lang.id_lang}_product" 
														idlang="{$lang.id_lang}"
														value="{$product['id_product']}">
												{/foreach}
											{/foreach}
										{/if}
									{/foreach}
								</div>
							</div>
						</div>
					{/foreach}
					</div>
				{else}
					<div> No cars created </div>
				{/if}

				<div>
					<button class="btn btn-success" type="button" onclick="newAlert()"
						style="text-transform: uppercase; font-size: 16px; width: 100%;margin-top: 20px;">
						Create new Car
					</button>
				</div>

			</div>
		</div>
	</div>

	<div class="col-lg-12">
		<div class="panel">

			<div class="panel-body" style="padding: 0 15px;">
				<form action="/admineuromus1/index.php?controller=AdminAsgCars&token={$token}&save_car=1"
					method="post">
					<input type="hidden" value="0" id="car_id" name="car_id">
					<input type="hidden" value="0" id="car_position" name="car_position">
					<input type="hidden" value="{$context->shop->id}" id="id_shop" name="id_shop">
					<div class="row">

						<div class="col-lg-6">
							<input placeholder="Car name in galleries" type="text" id="car_name_galleries"
								name="car_name_galleries" value=""
								onchange="$('#title_panel').text($(this).val())">
						</div>
						<div class="col-lg-6">
							<input placeholder="Car name in details" type="text" id="name_car"
								name="name_car" value=""
								onchange="$('#title_panel').text($(this).val())">
						</div>

						<div class="col-lg-12">
							<label for="dashboard_car_images">Upload Car Images</label>
							<input type="hidden" id="existing_images" name="existing_images">
							<input type="file" id="imagesCar" name="images[]" accept="image/*"
								multiple onchange="handleImagePreview(this)">
							<div id="image_preview" style="margin-top: 10px;">
								<!-- Preview of uploaded images will appear here -->
							</div>
						</div>

						<script>
							// Function to preview images when selected
							function handleImagePreview(input) {
								const previewContainer = document.getElementById('image_preview');

								const maxImages = 15; // Set a limit of 5 images
								if (previewContainer.children.length >= maxImages) {
									alert(`You can only upload up to `+maxImages+` images.`);
									return; // Exit the function if the limit is reached
								}

								// Check if files are selected
								if (input.files) {
								Array.from(input.files).forEach(file => {
									if (file.type.startsWith('image/')) {
									const reader = new FileReader();
									reader.onload = function(e) {
										const imgContainer = document.createElement('div');
										imgContainer.style.display = 'inline-block';
										imgContainer.style.margin = '5px';
										imgContainer.style.position = 'relative';

										const img = document.createElement('img');
										img.src = e.target.result;
										img.style.maxWidth = '100px';


										const removeButton = document.createElement('i');
										removeButton.classList.add('fa-solid')
										removeButton.classList.add('fa-trash')
										removeButton.style.position = 'absolute';
										removeButton.style.right = '0';
										removeButton.onclick = function() {
											removeImage(imgContainer)
											// imgContainer.remove();
										};

										imgContainer.appendChild(img);
										imgContainer.appendChild(removeButton);
										previewContainer.appendChild(imgContainer);
									};
									reader.readAsDataURL(file);
									}
								});
								}
							}

							function removeImage(imgElement) {
								console.log(imgElement.querySelector("img"))
								let img_url = imgElement.querySelector("img").getAttribute("src")

								$.ajax({
									type: 'POST',
									url: '/admineuromus1/index.php?controller=AdminAsgCars&action=removeImageCar&token={Tools::getValue("token")}',
									data: {
										'img_url': img_url
									},
									success: function (response) {
										imgElement.remove();
									},
									error: function (xhr, status, error) {
										console.error("Error updating positions:", error);
									}
								});
							}
						</script>

						<div class="col-lg-12" style="padding: 1rem 0;">
							<div class="form-group col-lg-8">
								<label for="title_en" class="col-sm-12 col-form-label">Description</label>
								<div class="col-sm-10">
									<!-- Language Dropdown -->


									<!-- Description Input Fields -->
									{foreach $languages AS $lang}
										<input type="text" class="form-control description-input" id="description_{$lang.iso_code}" name="description_{$lang.iso_code}" style="display: none;">
									{/foreach}
								</div>
								<div class="col-sm-2">
									<select id="languageSelector" class="form-control" style="margin-bottom: 10px;">
										{foreach $languages AS $lang}
											<option value="description_{$lang.iso_code}">{$lang.name}</option>
										{/foreach}
									</select>
								</div>
							</div>
						</div>
						<script type="text/javascript">
							document.addEventListener('DOMContentLoaded', function() {
								// Get the language selector and all description inputs
								var languageSelector = document.getElementById('languageSelector');
								var descriptionInputs = document.querySelectorAll('.description-input');

								// Function to show the selected input field
								function showSelectedInput() {
									// Hide all input fields
									descriptionInputs.forEach(function(input) {
										input.style.display = 'none';
									});

									// Show the selected input field
									var selectedInput = document.getElementById(languageSelector.value);
									if (selectedInput) {
										selectedInput.style.display = 'block';
									}
								}

								// Show the initial selected input field
								showSelectedInput();

								// Add event listener to the language selector
								languageSelector.addEventListener('change', showSelectedInput);
							});
						</script>

						{* <div class="col-lg-12" style="padding: 1rem 0;">
							<div class="form-group col-lg-8">
								<label for="title_en" class="col-sm-12 col-form-label">Details Text</label>
								<div class="col-sm-10">
									<!-- Language Dropdown -->


									<!-- Description Input Fields -->
									{foreach $languages AS $lang}
										<input type="text" class="form-control details-input" id="details_{$lang.iso_code}" name="details_{$lang.iso_code}" style="display: none;">
									{/foreach}
								</div>
								<div class="col-sm-2">
									<select id="languageSelectorDetails" class="form-control" style="margin-bottom: 10px;">
										{foreach $languages AS $lang}
											<option value="details_{$lang.iso_code}">{$lang.name}</option>
										{/foreach}
									</select>
								</div>
							</div>
						</div>
						<script type="text/javascript">
							document.addEventListener('DOMContentLoaded', function() {
								// Get the language selector and all details inputs
								var languageSelectorDetails = document.getElementById('languageSelectorDetails');
								var detailsInputs = document.querySelectorAll('.details-input');

								// Function to show the selected input field
								function showSelectedInput() {
									// Hide all input fields
									detailsInputs.forEach(function(input) {
										input.style.display = 'none';
									});

									// Show the selected input field
									var selectedInput = document.getElementById(languageSelectorDetails.value);
									if (selectedInput) {
										selectedInput.style.display = 'block';
									}
								}

								// Show the initial selected input field
								showSelectedInput();

								// Add event listener to the language selector
								languageSelectorDetails.addEventListener('change', showSelectedInput);
							});
						</script> *}

						<div class="col-lg-12" style="padding: 1rem 0;">
							<div class="form-group col-lg-8">
								<label for="title_en" class="col-sm-12 col-form-label">Budget Text</label>
								<div class="col-sm-10">
									<!-- budget Input Fields -->
									{foreach $languages AS $lang}
										<input type="text" class="form-control budget-input" id="budget_{$lang.iso_code}" name="budget_{$lang.iso_code}" style="display: none;">
									{/foreach}
								</div>
								<div class="col-sm-2">
									<select id="languageSelectorBudget" class="form-control" style="margin-bottom: 10px;">
										{foreach $languages AS $lang}
											<option value="budget_{$lang.iso_code}">{$lang.name}</option>
										{/foreach}
									</select>
								</div>
							</div>
						</div>
						<script type="text/javascript">
						document.addEventListener('DOMContentLoaded', function() {
							// Get the language selector and all budget inputs
							var languageSelectorBudget = document.getElementById('languageSelectorBudget');
							var budgetInputs = document.querySelectorAll('.budget-input');

							// Function to show the selected input field
							function showSelectedInput() {
								// Hide all input fields
								budgetInputs.forEach(function(input) {
									input.style.display = 'none';
								});

								// Show the selected input field
								var selectedInput = document.getElementById(languageSelectorBudget.value);
								if (selectedInput) {
									selectedInput.style.display = 'block';
								}
							}

							// Show the initial selected input field
							showSelectedInput();

							// Add event listener to the language selector
							languageSelectorBudget.addEventListener('change', showSelectedInput);
						});
						</script>


						{* <div class="col-lg-3" style="display: none;">
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
						</div> *}

						<div class="col-lg-3">
							<input style="margin-top: 8px;" type="checkbox" id="display_car" name="display_car" onclick="checkCheckbox()" value="0"><span style="margin-left: 5px;">Display car</span>
						</div>

						<script>
							function checkCheckbox() {
								let checkbox = document.querySelector("#display_car")

								if (checkbox.checked == true) {
									checkbox.setAttribute("value",1)
								}else{
									checkbox.setAttribute("value",0)
								}
							}
						</script>

						<div class="col-lg-12">
							<div class="spacer-30" style="padding: 20px 0;"></div>
						</div>

						{* <pre>{$languages|print_r}</pre> *}
						{foreach from=$languages item=lang key=key }
							<div class="col-lg-12">
								<div class="input-group">
									<h1>Content {$lang.iso_code|upper}</h1>
								</div>

								<!-- Motor Section -->
								<div class="Motor">
									<h4><span class="badge badge-primary">Motor</span></h4>
									<div class="products_motor" id="products_motor_{$lang.id_lang}">
										<div class="product_motor_item product_item">
											<div class="col-lg-10">
												<input type="text" name="motor[{$lang.id_lang}][name][1]"
													placeholder="Motor Product Name">
											</div>
											<div class="col-lg-2">
												<input type="text" name="motor_link[{$lang.id_lang}][link][1]"
													placeholder="Motor Product ID">
											</div>
											
										</div>
									</div>
									<button type="button" class="btn btn-secondary add-motor-product"
										data-lang="{$lang.id_lang}">
										ADD ONE MORE MOTOR PRODUCT
									</button>
								</div>

								<div class="spacer-2"></div>

								<!-- Chassis Section -->
								<div class="Chassis">
									<h4><span class="badge badge-primary">Chassis</span></h4>
									<div class="products_chassis" id="products_chassis_{$lang.id_lang}">
										<div class="product_chassis_item product_item">
											<div class="col-lg-10">
												<input type="text" name="chassis[{$lang.id_lang}][name][1]"
													placeholder="Chassis Product Name">
											</div>
											<div class="col-lg-2">
												<input type="text" name="chassis_link[{$lang.id_lang}][link][1]"
													placeholder="Chassis Product ID">
											</div>
										</div>
									</div>
									<button type="button" class="btn btn-secondary add-chassis-product"
										data-lang="{$lang.id_lang}">
										ADD ONE MORE CHASSIS PRODUCT
									</button>
								</div>

								<div class="spacer-2"></div>

								<!-- Interior Section -->
								<div class="Interior">
									<h4><span class="badge badge-primary">Interior</span></h4>
									<div class="products_interior" id="products_interior_{$lang.id_lang}">
										<div class="product_interior_item product_item">
											<div class="col-lg-10">
												<input type="text" name="interior[{$lang.id_lang}][name][1]"
													placeholder="Interior Product Name">
											</div>
											<div class="col-lg-2">
												<input type="text" name="interior_link[{$lang.id_lang}][link][1]"
													placeholder="Interior Product ID">
											</div>
										</div>
									</div>
									<button type="button" class="btn btn-secondary add-interior-product"
										data-lang="{$lang.id_lang}">
										ADD ONE MORE INTERIOR PRODUCT
									</button>
								</div>

								<div class="spacer-2"></div>

								<!-- Exterior Section -->
								<div class="Exterior">
									<h4><span class="badge badge-primary">Exterior</span></h4>
									<div class="products_exterior" id="products_exterior_{$lang.id_lang}">
										<div class="product_exterior_item product_item">
											<div class="col-lg-10">
												<input type="text" name="exterior[{$lang.id_lang}][name][1]"
													placeholder="Exterior Product Name">
											</div>
											<div class="col-lg-2">
												<input type="text" name="exterior_link[{$lang.id_lang}][link][1]"
													placeholder="Exterior Product ID">
											</div>
										</div>
									</div>
									<button type="button" class="btn btn-secondary add-exterior-product"
										data-lang="{$lang.id_lang}">
										ADD ONE MORE EXTERIOR PRODUCT
									</button>
								</div>

								<div class="spacer-2"></div>

								<!-- Audio Section -->
								<div class="Audio">
									<h4><span class="badge badge-primary">Audio</span></h4>
									<div class="products_audio" id="products_audio_{$lang.id_lang}">
										<div class="product_audio_item product_item">
											<div class="col-lg-10">
												<input type="text" name="audio[{$lang.id_lang}][name][1]"
													placeholder="Audio Product Name">
											</div>
											<div class="col-lg-2">
												<input type="text" name="audio_link[{$lang.id_lang}][link][1]"
													placeholder="Audio Product ID">
											</div>
										</div>
									</div>
									<button type="button" class="btn btn-secondary add-audio-product"
										data-lang="{$lang.id_lang}">
										ADD ONE MORE AUDIO PRODUCT
									</button>
								</div>



								<div class="spacer-3"></div>
							</div>

						{/foreach}



						<div class="col-lg-12"> </div>

						<div class="col-lg-12" style="display: none;">
							<h1 style="border: 0px solid black;">Preview</h1>
							<div style="min-height: 50px;" id="dashboard_preview_message" class="alert alert-info">

							</div>

							<div class="col-lg-12"> </div>
						</div>
					</div>
				</form>
				<div class="text-center" style="border: 0px solid black;">
					{* <div style="margin: 10px 25px;"> *}
						<span>
							<button style="width: auto;" type="button" class="btn btn-info" onclick="saveFormData()"
								id="save_button">Save</button>
						</span>
						{* <span style="float: left;margin: 5px; font-size: 20px;" id="title_panel"></span> *}
					{* </div> *}
				</div>
			</div>
		</div>
	</div>

	<style>
		.spacer-2 {
			width: 100%;
			height: 1px;
			margin: 1rem 0;
			background: #333;
		}

		.spacer-3 {
			width: 100%;
			height: 14px;
			margin: 1rem 0;
			background: #333;
		}

		.product_item {
			padding: .5rem 0;
			display: flex
		}
	</style>

	<script>
		// JavaScript for dynamically adding motor and chassis inputs
		document.addEventListener('DOMContentLoaded', function() {
			// Handle motor products
			// JavaScript to dynamically add new product inputs
			$(document).on('click', '.add-motor-product', function(index) {
				var langId = $(this).data('lang');
				let container = $('#products_motor_' + langId);
				let currentIndex = container.find('.product_item').length + 1;

				let newProductHtml = '<div class="product_motor_item product_item d-flex">' +
					'<div class="col-lg-10"><input type="text" name="motor[' + langId +
					'][name]['+currentIndex+']" placeholder="Motor Product Name"></div>' +
					'<div class="col-lg-2"><input type="text" name="motor_link[' + langId +
					'][link]['+currentIndex+']" placeholder="Motor Product ID"></div>' +
					'<input type="hidden" name="motor_product_car['+langId+'][product_car_id]['+currentIndex+']" value="0"></div>';

				container.append(newProductHtml);
			});

			$(document).on('click', '.add-chassis-product', function() {
				var langId = $(this).data('lang');

				let container = $('#products_chassis_' + langId);
				let currentIndex = container.find('.product_item').length + 1;

				let newProductHtml = '<div class="product_chassis_item product_item d-flex">' +
					'<div class="col-lg-10"><input type="text" name="chassis[' + langId +
					'][name]['+currentIndex+']" placeholder="Chassis Product Name"></div>' +
					'<div class="col-lg-2"><input type="text" name="chassis_link[' + langId +
					'][link]['+currentIndex+']" placeholder="Chassis Product ID"></div>' +
					'</div>';
				container.append(newProductHtml);
			});

			$(document).on('click', '.add-interior-product', function() {
				var langId = $(this).data('lang');

				let container = $('#products_interior_' + langId);
				let currentIndex = container.find('.product_item').length + 1;

				let newProductHtml = '<div class="product_interior_item product_item d-flex">' +
					'<div class="col-lg-10"><input type="text" name="interior[' + langId +
					'][name]['+currentIndex+']" placeholder="Interior Product Name"></div>' +
					'<div class="col-lg-2"><input type="text" name="interior_link[' + langId +
					'][link]['+currentIndex+']" placeholder="Interior Product ID"></div>' +
					'</div>';
				container.append(newProductHtml);
			});

			$(document).on('click', '.add-exterior-product', function() {
				var langId = $(this).data('lang');

				let container = $('#products_exterior_' + langId);
				let currentIndex = container.find('.product_item').length + 1;

				let newProductHtml = '<div class="product_exterior_item product_item d-flex">' +
					'<div class="col-lg-10"><input type="text" name="exterior[' + langId +
					'][name]['+currentIndex+']" placeholder="Exterior Product Name"></div>' +
					'<div class="col-lg-2"><input type="text" name="exterior_link[' + langId +
					'][link]['+currentIndex+']" placeholder="Exterior Product ID"></div>' +
					'</div>';
				container.append(newProductHtml);
			});

			$(document).on('click', '.add-audio-product', function() {
				var langId = $(this).data('lang');

				let container = $('#products_audio_' + langId);
				let currentIndex = container.find('.product_item').length + 1;

				var newProductHtml = '<div class="product_audio_item product_item d-flex">' +
					'<div class="col-lg-10"><input type="text" name="audio[' + langId +
					'][name]['+currentIndex+']" placeholder="Audio Product Name"></div>' +
					'<div class="col-lg-2"><input type="text" name="audio_link[' + langId +
					'][link]['+currentIndex+']" placeholder="Audio Product ID"></div>' +
					'</div>';
				container.append(newProductHtml);
			});

		});
	</script>


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

		function collectAllProductData() {
			let categories = ['motor', 'chassis', 'interior', 'exterior', 'audio'];
			let languagesIds = [];
			{foreach from=$languages item=lang key=key}
				languagesIds.push('{$lang.id_lang}');
			{/foreach}

			let productsData = {};

			categories.forEach(function (category) {
				productsData[category] = [];

				languagesIds.forEach(function (langId) {
					// Iterate over all .product_item elements inside the category-language container
					$('#products_' + category + '_' + langId + ' .product_item').each(function (index) {
						// Find the inputs for the current product item
						let i = index + 1
						let productName = $(this).find('input[name="' + category + '[' + langId + '][name][' + i + ']"]').val();
						let productLink = $(this).find('input[name="' + category + '_link[' + langId + '][link][' + i + ']"]').val();
						let productCarId = $(this).find('input[name="' + category + '_product_car[' + langId + '][product_car_id][' + i + ']"]').val();

						// Only add if productName or productLink is present
						if (productName || productLink) {
							productsData[category].push({
								'name': productName,
								'link': productLink,
								'id_lang': langId,
								'id_asg_car_product': productCarId || null
							});
						}
					});
				});
			});

			return productsData;
		}


		function saveFormData() {
			let id = $('input[name="car_id"]').val();
			let name = $('input[name="name_car"]').val();
			let car_name_galleries = $('input[name="car_name_galleries"]').val();
			let description = $('input[name="description"]').val();
			let id_shop = $('input[name="id_shop"]').val();
			let display = $('#display_car').val();

			

			let description_en = $('input[name="description_en"]').val();
			let description_es = $('input[name="description_es"]').val();
			let description_fr = $('input[name="description_fr"]').val();
			let description_pt = $('input[name="description_pt"]').val();
			let description_it = $('input[name="description_it"]').val();

			// let details_en = $('input[name="details_en"]').val();
			// let details_es = $('input[name="details_es"]').val();
			// let details_fr = $('input[name="details_fr"]').val();
			// let details_pt = $('input[name="details_pt"]').val();
			// let details_it = $('input[name="details_it"]').val();
			
			let budget_en = $('input[name="budget_en"]').val();
			let budget_es = $('input[name="budget_es"]').val();
			let budget_fr = $('input[name="budget_fr"]').val();
			let budget_pt = $('input[name="budget_pt"]').val();
			let budget_it = $('input[name="budget_it"]').val();

			
			// Collect product data (motor, chassis, etc.)
			let productsData = collectAllProductData();

			// Image data
			let imagesInput = document.querySelector('#imagesCar');
			let images = imagesInput.files; // FileList
			let existingImages = $('#existing_images').val();



			let formData = new FormData();
			formData.append('id', id);
			formData.append('name', name);
			formData.append('car_name_galleries', car_name_galleries);
			formData.append('description', description);
			formData.append('id_shop', id_shop);
			formData.append('display', display);

			formData.append('description_en', description_en);
			formData.append('description_es', description_es);
			formData.append('description_fr', description_fr);
			formData.append('description_pt', description_pt);
			formData.append('description_it', description_it);

			// formData.append('details_en', details_en);
			// formData.append('details_es', details_es);
			// formData.append('details_fr', details_fr);
			// formData.append('details_pt', details_pt);
			// formData.append('details_it', details_it);
			
			formData.append('budget_en', budget_en);
			formData.append('budget_es', budget_es);
			formData.append('budget_fr', budget_fr);
			formData.append('budget_pt', budget_pt);
			formData.append('budget_it', budget_it);

			if($('#car_position').val() > 0){
				let position = $('#car_position').val();
				formData.append('position', position);
			}

			// Append product data (motor, chassis, etc.)
			if (Object.keys(productsData).length > 0) {
				formData.append('products_data', JSON.stringify(productsData));
			}

			// Append existing image URLs
			if (existingImages) {
				formData.append('existing_images', existingImages);
			}

			// Append images to form data
			if (images.length > 0) {
				for (let i = 0; i < images.length; i++) {
				formData.append('images[]', images[i]);
				}
			}

			

			// Check the data for debugging purposes
			for (let pair of formData.entries()) {
				console.log(pair[0] + ': ' + pair[1]);
			}

			// Uncomment the AJAX call for form submission:
			$.ajax({
			  type: 'POST',
			  url: '/admineuromus1/index.php?controller=AdminAsgCars&action=saveCar&token={Tools::getValue("token")}',
			  data: formData,
			  processData: false,
			  contentType: false,
			  success: function(data) {
			    // Handle success (e.g., redirect, update UI)
			  }
			});

			setTimeout(function() {
				location.reload();
			}, 3000);
		}



		function deleteAlert(index) {

			var result = confirm("Are you sure you want to delete de car?");

			if (result) {

				$.ajax({
					type: 'POST',
					url : '/admineuromus1/index.php?controller=AdminAsgCars&action=deleteCar&token={Tools::getValue("token")}&id='+index,
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

				$.ajax({
					type: 'GET',
					url : '/admineuromus1/index.php?controller=AdminAsgCars&action=getdataCar&token={Tools::getValue("token")}',
					data: {
						'id': index
					},
					success: function(data) {
						const car =  data[index];

						console.log(car)

						$('#car_id').val(car.id_asg_car);
						$('input#name_car').val(car.car_name);
						$('input#car_name_galleries').val(car.car_name_galleries);
						$('#description_en').val(car.description_en);
						$('#description_es').val(car.description_es);
						$('#description_fr').val(car.description_fr);
						$('#description_pt').val(car.description_pt);
						$('#description_it').val(car.description_it);

						$('#car_position').val(car.position)
						// $('#details_en').val(car.details_en);
						// $('#details_es').val(car.details_es);
						// $('#details_fr').val(car.details_fr);
						// $('#details_pt').val(car.details_pt);
						// $('#details_it').val(car.details_it);
						$('#budget_en').val(car.budget_en);
						$('#budget_es').val(car.budget_es);
						$('#budget_fr').val(car.budget_fr);
						$('#budget_pt').val(car.budget_pt);
						$('#budget_it').val(car.budget_it);
						$('#id_shop').val(car.id_shop);

						if(car.display == 1){
							$('#display_car').prop('checked',true);
							$('#display_car').val(1);
						}else{
							$('#display_car').prop('checked',false);
							$('#display_car').val(0);
						}

						// Object.keys(car.images).forEach((index) => {
						// 	let image = car.images[index]; // This is the actual image path
						// 	console.log(image); // Log the image path

						// 	let container = $('#image_preview');
						// 	var newProductHtml = '<img src="https://' + image + '" style="max-width: 100px; margin: 5px;"/>';
						// 	container.append(newProductHtml);
						// });
						$('#image_preview').html('');
						let images = []; 

						// Display existing images
						if (car.images && car.images.length > 0) {
							car.images.forEach((image, index) => {
								if (index < 15) {
									let imageUrl = '/'+image;
									
									// $('#image_preview').append(imageHtml);
									images.push(imageUrl); // Store existing image URLs

										const imgContainer = document.createElement('div');
										imgContainer.style.display = 'inline-block';
										imgContainer.style.margin = '5px';
										imgContainer.style.position = 'relative';


										const imageElement = document.createElement('img');
										imageElement.src = imageUrl;
										imageElement.style.maxWidth = '100px';
										imgContainer.appendChild(imageElement);

										const removeButton = document.createElement('i');
										removeButton.classList.add('fa-solid', 'fa-trash');
										removeButton.style.position = 'absolute';
										removeButton.style.right = '0';
										removeButton.style.color = 'red';
										removeButton.style.padding = '5px';
										removeButton.onclick = function() {
											// imgContainer.remove();
											removeImage(imgContainer)
										};

										imgContainer.appendChild(imageElement);
										imgContainer.appendChild(removeButton);
										$('#image_preview').append(imgContainer);
								}
							});
						}

						$('#existing_images').val(JSON.stringify(images));

						$('#imagesCar').on('change', function() {
							let totalImages = images.length + this.files.length; // Total images (existing + new)

							if (totalImages > 15) {
								alert("You can upload a maximum of 15 images.");
								// Optionally, you can prevent the upload of new images by clearing the input
								this.value = '';  // Clear the input field
							}
						});

						
						Object.keys(car.products).forEach((langId) => {
							const langProducts = car.products[langId];
							console.log(langProducts)

							Object.keys(langProducts).forEach((category) => {
								const categoryProducts = langProducts[category];

								$('#products_'+category+'_'+langId).html('')

								categoryProducts.forEach((product,index) => {
									let i = index + 1;
									let productProductInput = `
										<div class="product_motor_item product_item">
											<div class="col-lg-10">
												<input type="text" name="`+category+`[`+langId+`][name][`+i+`]" value="`+product.product_name+`" placeholder="Motor Product Name">
											</div>
											<div class="col-lg-2">
												<input type="text" name="`+category+`_link[`+langId+`][link][`+i+`]" value="`+product.id_product+`" placeholder="Motor Product ID">
											</div>
											<input type="hidden" name="`+category+`_product_car[`+langId+`][product_car_id][`+i+`]" value="`+product.id_asg_car_product+`">
										</div>`;

									$('#products_'+category+'_'+langId).append(productProductInput)

									// $('input[name="'+category+'['+ langId +'][name]"]').val(product.product_name)
									// $('input[name="'+category+'_link['+ langId +'][link]"]').val(product.id_product)

									// const newInput = $('<input>', {
									// 	type: 'hidden',
									// 	name: category + '_product_car[' + langId + '][product_car_id]',
									// 	value: product.id_asg_car_product, // You can set the value dynamically
									// });

									// $('input[name="' + category + '[' + langId + '][name]"]').after(newInput);
								})
							})
							// $('input[name="motor['+ product.id +'][name]"]').val()
							// $('input[name="motor_link['+ product.id +'][link]"]').val()
						})

					},
					error: function(xhr, status, error) {
						console.error('Error: '+ error);
					}
				});

			// $('#car_id').val($('input[name=id_' + index+']').val());
			// $('#name_car').val($('input[name=name_' + index+']').val());

			// $('#description').val($('textarea[name=description_' + index+']').val());

			// $('#id_shop').val($('input[name=id_shop]').val());



			// $('input[name="motor[2][name]"]').val($('input[name=product_'+index+'_motor_6_2_name]').val())
			// $('input[name="motor_link[2][link]"]').val($('input[name=product_'+index+'_motor_6_2_product]').val())



			// $('#dashboard_message_type').val($('#message_type_' + index).val());
			// $('#dashboard_message_en').val($('#message_en_' + index).val());
			// $('#dashboard_message_es').val($('#message_es_' + index).val());
			// $('#dashboard_message_fr').val($('#message_fr_' + index).val());
			// $('#dashboard_message_ro').val($('#message_ro_' + index).val());
			// $('#dashboard_message_pt').val($('#message_pt_' + index).val());
			// $('#dashboard_message_it').val($('#message_it_' + index).val());

			// if ($('#message_status_' + index).val() == 1) {
			// 	$('#enable_dashboard_message_type').prop('checked', 'checked');
			// } else {
			// 	$('#enable_dashboard_message_type').prop('checked', '');
			// }

			// set_message($('#dashboard_message_en').val());
			// set_message_type($('#dashboard_message_type').val());

			// $('#title_panel').text($('#message_title_' + index).val());
			// $('#title_en').text($('#title_' + index).val());

			// change_dashboard_type();
		}

		function newAlert() {

			location.reload();
		}



		$("#sortable-cars").sortable({
			update: function (event, ui) {
				let sortedIds = [];
				$(".car-item").each(function () {
					let carId = $(this).data("id"); // This should be the id_asg_car, not the position
					sortedIds.push({
						id_asg_car: carId,
						position: $(this).index() + 1  // Using index to define the position
					});
				});

				$.ajax({
					type: 'POST',
					url: '/admineuromus1/index.php?controller=AdminAsgCars&action=update_position&token={Tools::getValue("token")}',
					data: {
						'sortedIds': sortedIds
					},
					success: function (response) {
							console.log("Positions updated:", response);
					},
					error: function (xhr, status, error) {
						console.error("Error updating positions:", error);
					}
				});
			}
		});

			$("#sortable-cars").disableSelection();
	
		// imgs car sort

		$("#image_preview").sortable({
			update: function (event, ui) {
				let sortedImages = [];
				$("#image_preview div").each(function () {
					let imgUrl = $(this).find("img").attr("src").replace(/^\//, ""); // Remove leading "/"
					sortedImages.push(imgUrl);
				});

				$.ajax({
					type: "POST",
					url: "/admineuromus1/index.php?controller=AdminAsgCars&action=updateImageOrder&token={Tools::getValue('token')}",
					data: { sortedImages: sortedImages, carId: $('#car_id').val() },
					success: function (response) {
						console.log("Image order updated:", response);
					},
					error: function (xhr, status, error) {
						alert("Cannot change order of the last images if they haven't been saved yet. Save the page first then sort them..")
						// console.error("Error updating image order:", error);
					}
				});
			}
		});

		$("#image_preview").disableSelection();
	

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

		#image_preview {
			display: flex;
			flex-wrap: wrap;
		}

		#image_preview img:hover{
			cursor: all-scroll;
		}
		#image_preview i:hover{
			color: #333 !important;
			cursor: pointer;
		}

		#sortable-cars .car-item {
			cursor: all-scroll;
		}
</style>
{/if}