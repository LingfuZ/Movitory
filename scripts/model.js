/**
 * backbone model definitions for MOVITORY
 */

/**
 * Use emulated HTTP if the server doesn't support PUT/DELETE or application/json requests
 */
Backbone.emulateHTTP = false;
Backbone.emulateJSON = false

var model = {};

/**
 * long polling duration in miliseconds.  (5000 = recommended, 0 = disabled)
 * warning: setting this to a low number will increase server load
 */
model.longPollDuration = 5000;

/**
 * whether to refresh the collection immediately after a model is updated
 */
model.reloadCollectionOnModelUpdate = true;

/**
 * Actor Backbone Model
 */
model.ActorModel = Backbone.Model.extend({
	urlRoot: 'api/actor',
	idAttribute: 'id',
	id: '',
	firstname: '',
	lastname: '',
	dateofbirth: '',
	city: '',
	state: '',
	defaults: {
		'id': null,
		'firstname': '',
		'lastname': '',
		'dateofbirth': new Date(),
		'city': '',
		'state': ''
	}
});

/**
 * Actor Backbone Collection
 */
model.ActorCollection = Backbone.Collection.extend({
	url: 'api/actors',
	model: model.ActorModel,

	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	collectionHasChanged: true,

	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, xhr) {

		// check the raw response to determine if collection actually changed
		// note xhr param was removed from backbone 0.99
		var responseText = xhr ? xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastResponseText = responseText;

		var rows;

		if (response.currentPage)
		{
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}
		else
		{
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * Contact Backbone Model
 */
model.ContactModel = Backbone.Model.extend({
	urlRoot: 'api/contact',
	idAttribute: 'id',
	id: '',
	firstname: '',
	lastname: '',
	email: '',
	phone: '',
	defaults: {
		'id': null,
		'firstname': '',
		'lastname': '',
		'email': '',
		'phone': ''
	}
});

/**
 * Contact Backbone Collection
 */
model.ContactCollection = Backbone.Collection.extend({
	url: 'api/contacts',
	model: model.ContactModel,

	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	collectionHasChanged: true,

	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, xhr) {

		// check the raw response to determine if collection actually changed
		// note xhr param was removed from backbone 0.99
		var responseText = xhr ? xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastResponseText = responseText;

		var rows;

		if (response.currentPage)
		{
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}
		else
		{
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * Extra Backbone Model
 */
model.ExtraModel = Backbone.Model.extend({
	urlRoot: 'api/extra',
	idAttribute: 'id',
	id: '',
	cover: '',
	trailer: '',
	wiki: '',
	defaults: {
		'id': null,
		'cover': '',
		'trailer': '',
		'wiki': ''
	}
});

/**
 * Extra Backbone Collection
 */
model.ExtraCollection = Backbone.Collection.extend({
	url: 'api/extras',
	model: model.ExtraModel,

	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	collectionHasChanged: true,

	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, xhr) {

		// check the raw response to determine if collection actually changed
		// note xhr param was removed from backbone 0.99
		var responseText = xhr ? xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastResponseText = responseText;

		var rows;

		if (response.currentPage)
		{
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}
		else
		{
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * Genre Backbone Model
 */
model.GenreModel = Backbone.Model.extend({
	urlRoot: 'api/genre',
	idAttribute: 'id',
	id: '',
	type: '',
	defaults: {
		'id': null,
		'type': ''
	}
});

/**
 * Genre Backbone Collection
 */
model.GenreCollection = Backbone.Collection.extend({
	url: 'api/genres',
	model: model.GenreModel,

	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	collectionHasChanged: true,

	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, xhr) {

		// check the raw response to determine if collection actually changed
		// note xhr param was removed from backbone 0.99
		var responseText = xhr ? xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastResponseText = responseText;

		var rows;

		if (response.currentPage)
		{
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}
		else
		{
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * Group Backbone Model
 */
model.GroupModel = Backbone.Model.extend({
	urlRoot: 'api/group',
	idAttribute: 'id',
	id: '',
	name: '',
	defaults: {
		'id': null,
		'name': ''
	}
});

/**
 * Group Backbone Collection
 */
model.GroupCollection = Backbone.Collection.extend({
	url: 'api/groups',
	model: model.GroupModel,

	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	collectionHasChanged: true,

	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, xhr) {

		// check the raw response to determine if collection actually changed
		// note xhr param was removed from backbone 0.99
		var responseText = xhr ? xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastResponseText = responseText;

		var rows;

		if (response.currentPage)
		{
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}
		else
		{
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * Movie Backbone Model
 */
model.MovieModel = Backbone.Model.extend({
	urlRoot: 'api/movie',
	idAttribute: 'id',
	id: '',
	name: '',
	year: '',
	location: '',
	barcode: '',
	rating: '',
	contactid: '',
	extraid: '',
	defaults: {
		'id': null,
		'name': '',
		'year': '',
		'location': '',
		'barcode': '',
		'rating': '',
		'contactid': '',
		'extraid': ''
	}
});

/**
 * Movie Backbone Collection
 */
model.MovieCollection = Backbone.Collection.extend({
	url: 'api/movies',
	model: model.MovieModel,

	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	collectionHasChanged: true,

	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, xhr) {

		// check the raw response to determine if collection actually changed
		// note xhr param was removed from backbone 0.99
		var responseText = xhr ? xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastResponseText = responseText;

		var rows;

		if (response.currentPage)
		{
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}
		else
		{
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * Movie_Actor Backbone Model
 */
model.Movie_ActorModel = Backbone.Model.extend({
	urlRoot: 'api/movie_actor',
	idAttribute: 'movieid',
	movieid: '',
	actorid: '',
	defaults: {
		'movieid': null,
		'actorid': ''
	}
});

/**
 * Movie_Actor Backbone Collection
 */
model.Movie_ActorCollection = Backbone.Collection.extend({
	url: 'api/movies_actors',
	model: model.Movie_ActorModel,

	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	collectionHasChanged: true,

	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, xhr) {

		// check the raw response to determine if collection actually changed
		// note xhr param was removed from backbone 0.99
		var responseText = xhr ? xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastResponseText = responseText;

		var rows;

		if (response.currentPage)
		{
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}
		else
		{
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * Movie_Genre Backbone Model
 */
model.Movie_GenreModel = Backbone.Model.extend({
	urlRoot: 'api/movie_genre',
	idAttribute: 'movieid',
	movieid: '',
	genreid: '',
	defaults: {
		'movieid': null,
		'genreid': ''
	}
});

/**
 * Movie_Genre Backbone Collection
 */
model.Movie_GenreCollection = Backbone.Collection.extend({
	url: 'api/movies_genres',
	model: model.Movie_GenreModel,

	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	collectionHasChanged: true,

	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, xhr) {

		// check the raw response to determine if collection actually changed
		// note xhr param was removed from backbone 0.99
		var responseText = xhr ? xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastResponseText = responseText;

		var rows;

		if (response.currentPage)
		{
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}
		else
		{
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

/**
 * Movie_Group Backbone Model
 */
model.Movie_GroupModel = Backbone.Model.extend({
	urlRoot: 'api/movie_group',
	idAttribute: 'movieid',
	movieid: '',
	groupid: '',
	defaults: {
		'movieid': null,
		'groupid': ''
	}
});

/**
 * Movie_Group Backbone Collection
 */
model.Movie_GroupCollection = Backbone.Collection.extend({
	url: 'api/movies_groups',
	model: model.Movie_GroupModel,

	totalResults: 0,
	totalPages: 0,
	currentPage: 0,
	pageSize: 0,
	orderBy: '',
	orderDesc: false,
	lastResponseText: null,
	collectionHasChanged: true,

	/**
	 * override parse to track changes and handle pagination
	 * if the server call has returned page data
	 */
	parse: function(response, xhr) {

		// check the raw response to determine if collection actually changed
		// note xhr param was removed from backbone 0.99
		var responseText = xhr ? xhr.responseText : JSON.stringify(response);
		this.collectionHasChanged = (this.lastResponseText != responseText);
		this.lastResponseText = responseText;

		var rows;

		if (response.currentPage)
		{
			rows = response.rows;
			this.totalResults = response.totalResults;
			this.totalPages = response.totalPages;
			this.currentPage = response.currentPage;
			this.pageSize = response.pageSize;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}
		else
		{
			rows = response;
			this.totalResults = rows.length;
			this.totalPages = 1;
			this.currentPage = 1;
			this.pageSize = this.totalResults;
			this.orderBy = response.orderBy;
			this.orderDesc = response.orderDesc;
		}

		return rows;
	}
});

