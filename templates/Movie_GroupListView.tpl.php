<?php
	$this->assign('title','MOVITORY | Movies_Groups');
	$this->assign('nav','movies_groups');

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
	.script("scripts/app/movies_groups.js").wait(function(){
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
	<i class="icon-th-list"></i> Movies_Groups
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="movie_GroupCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Movieid">Movieid<% if (page.orderBy == 'Movieid') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Groupid">Groupid<% if (page.orderBy == 'Groupid') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('movieid')) %>">
				<td><%= _.escape(item.get('movieid') || '') %></td>
				<td><%= _.escape(item.get('groupid') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="movie_GroupModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="movieidInputContainer" class="control-group">
					<label class="control-label" for="movieid">Movieid</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="movieid" placeholder="Movieid" value="<%= _.escape(item.get('movieid') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="groupidInputContainer" class="control-group">
					<label class="control-label" for="groupid">Groupid</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="groupid" placeholder="Groupid" value="<%= _.escape(item.get('groupid') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteMovie_GroupButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteMovie_GroupButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Movie_Group</button>
						<span id="confirmDeleteMovie_GroupContainer" class="hide">
							<button id="cancelDeleteMovie_GroupButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteMovie_GroupButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="movie_GroupDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Movie_Group
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="movie_GroupModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveMovie_GroupButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="movie_GroupCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newMovie_GroupButton" class="btn btn-primary">Add Movie_Group</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
