<?php
	$this->assign('title','MOVITORY | Movies');
	$this->assign('nav','movies');

	$this->display('_Header.tpl.php');
?>

<script type="text/javascript">
	$LAB.script("bootstrap/js/bootstrap-datepicker.js")
	.script("bootstrap/js/bootstrap-timepicker.js")
	.script("bootstrap/js/bootstrap-combobox.js")
	.script("scripts/libs/underscore-min.js").wait()
	.script("scripts/libs/underscore.date.min.js")
	.script("scripts/libs/backbone-min.js")
	.script("scripts/app.js")
	.script("scripts/model.js").wait()
	.script("scripts/view.js").wait()
	.script("scripts/app/movies.js").wait(function(){
		$(document).ready(function(){
			page.init();
		});
		
		// hack for IE9 which may respond inconsistently with document.ready
		setTimeout(function(){
			if (!page.isInitialized) page.init();
		},1000);
	});
</script>

<div class="container">

<h1>
	<i class="icon-th-list"></i> Movies
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="movieCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Id">Id<% if (page.orderBy == 'Id') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Name">Name<% if (page.orderBy == 'Name') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Year">Year<% if (page.orderBy == 'Year') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Location">Location<% if (page.orderBy == 'Location') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Barcode">Barcode<% if (page.orderBy == 'Barcode') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<th id="header_Rating">Rating<% if (page.orderBy == 'Rating') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Contactid">Contactid<% if (page.orderBy == 'Contactid') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Extraid">Extraid<% if (page.orderBy == 'Extraid') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
-->
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('id')) %>">
				<td><%= _.escape(item.get('id') || '') %></td>
				<td><%= _.escape(item.get('name') || '') %></td>
				<td><%= _.escape(item.get('year') || '') %></td>
				<td><%= _.escape(item.get('location') || '') %></td>
				<td><%= _.escape(item.get('barcode') || '') %></td>
<!-- UNCOMMENT TO SHOW ADDITIONAL COLUMNS
				<td><%= _.escape(item.get('rating') || '') %></td>
				<td><%= _.escape(item.get('contactid') || '') %></td>
				<td><%= _.escape(item.get('extraid') || '') %></td>
-->
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="movieModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="idInputContainer" class="control-group">
					<label class="control-label" for="id">Id</label>
					<div class="controls inline-inputs">
						<span class="input-xlarge uneditable-input" id="id"><%= _.escape(item.get('id') || '') %></span>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="nameInputContainer" class="control-group">
					<label class="control-label" for="name">Name</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="name" placeholder="Name" value="<%= _.escape(item.get('name') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="yearInputContainer" class="control-group">
					<label class="control-label" for="year">Year</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="year" placeholder="Year" value="<%= _.escape(item.get('year') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="locationInputContainer" class="control-group">
					<label class="control-label" for="location">Location</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="location" placeholder="Location" value="<%= _.escape(item.get('location') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="barcodeInputContainer" class="control-group">
					<label class="control-label" for="barcode">Barcode</label>
					<div class="controls inline-inputs">
						<textarea class="input-xlarge" id="barcode" rows="3"><%= _.escape(item.get('barcode') || '') %></textarea>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="ratingInputContainer" class="control-group">
					<label class="control-label" for="rating">Rating</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="rating" placeholder="Rating" value="<%= _.escape(item.get('rating') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="contactidInputContainer" class="control-group">
					<label class="control-label" for="contactid">Contactid</label>
					<div class="controls inline-inputs">
						<select id="contactid" name="contactid"></select>
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="extraidInputContainer" class="control-group">
					<label class="control-label" for="extraid">Extraid</label>
					<div class="controls inline-inputs">
						<select id="extraid" name="extraid"></select>
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteMovieButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteMovieButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Movie</button>
						<span id="confirmDeleteMovieContainer" class="hide">
							<button id="cancelDeleteMovieButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteMovieButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="movieDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Movie
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="movieModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveMovieButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="movieCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newMovieButton" class="btn btn-primary">Add Movie</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
