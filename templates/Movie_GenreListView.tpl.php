<?php
	$this->assign('title','MOVITORY | Movies_Genres');
	$this->assign('nav','movies_genres');

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
	.script("scripts/app/movies_genres.js").wait(function(){
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
	<i class="icon-th-list"></i> Movies_Genres
	<span id=loader class="loader progress progress-striped active"><span class="bar"></span></span>
	<span class='input-append pull-right searchContainer'>
		<input id='filter' type="text" placeholder="Search..." />
		<button class='btn add-on'><i class="icon-search"></i></button>
	</span>
</h1>

	<!-- underscore template for the collection -->
	<script type="text/template" id="movie_GenreCollectionTemplate">
		<table class="collection table table-bordered table-hover">
		<thead>
			<tr>
				<th id="header_Movieid">Movieid<% if (page.orderBy == 'Movieid') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
				<th id="header_Genreid">Genreid<% if (page.orderBy == 'Genreid') { %> <i class='icon-arrow-<%= page.orderDesc ? 'up' : 'down' %>' /><% } %></th>
			</tr>
		</thead>
		<tbody>
		<% items.each(function(item) { %>
			<tr id="<%= _.escape(item.get('movieid')) %>">
				<td><%= _.escape(item.get('movieid') || '') %></td>
				<td><%= _.escape(item.get('genreid') || '') %></td>
			</tr>
		<% }); %>
		</tbody>
		</table>

		<%=  view.getPaginationHtml(page) %>
	</script>

	<!-- underscore template for the model -->
	<script type="text/template" id="movie_GenreModelTemplate">
		<form class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div id="movieidInputContainer" class="control-group">
					<label class="control-label" for="movieid">Movieid</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="movieid" placeholder="Movieid" value="<%= _.escape(item.get('movieid') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
				<div id="genreidInputContainer" class="control-group">
					<label class="control-label" for="genreid">Genreid</label>
					<div class="controls inline-inputs">
						<input type="text" class="input-xlarge" id="genreid" placeholder="Genreid" value="<%= _.escape(item.get('genreid') || '') %>">
						<span class="help-inline"></span>
					</div>
				</div>
			</fieldset>
		</form>

		<!-- delete button is is a separate form to prevent enter key from triggering a delete -->
		<form id="deleteMovie_GenreButtonContainer" class="form-horizontal" onsubmit="return false;">
			<fieldset>
				<div class="control-group">
					<label class="control-label"></label>
					<div class="controls">
						<button id="deleteMovie_GenreButton" class="btn btn-mini btn-danger"><i class="icon-trash icon-white"></i> Delete Movie_Genre</button>
						<span id="confirmDeleteMovie_GenreContainer" class="hide">
							<button id="cancelDeleteMovie_GenreButton" class="btn btn-mini">Cancel</button>
							<button id="confirmDeleteMovie_GenreButton" class="btn btn-mini btn-danger">Confirm</button>
						</span>
					</div>
				</div>
			</fieldset>
		</form>
	</script>

	<!-- modal edit dialog -->
	<div class="modal hide fade" id="movie_GenreDetailDialog">
		<div class="modal-header">
			<a class="close" data-dismiss="modal">&times;</a>
			<h3>
				<i class="icon-edit"></i> Edit Movie_Genre
				<span id="modelLoader" class="loader progress progress-striped active"><span class="bar"></span></span>
			</h3>
		</div>
		<div class="modal-body">
			<div id="modelAlert"></div>
			<div id="movie_GenreModelContainer"></div>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal" >Cancel</button>
			<button id="saveMovie_GenreButton" class="btn btn-primary">Save Changes</button>
		</div>
	</div>

	<div id="collectionAlert"></div>
	
	<div id="movie_GenreCollectionContainer" class="collectionContainer">
	</div>

	<p id="newButtonContainer" class="buttonContainer">
		<button id="newMovie_GenreButton" class="btn btn-primary">Add Movie_Genre</button>
	</p>

</div> <!-- /container -->

<?php
	$this->display('_Footer.tpl.php');
?>
