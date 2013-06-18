<?php
/** @package    MOVITORY::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Movie.php");

/**
 * MovieController is the controller class for the Movie object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package MOVITORY::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class MovieController extends AppBaseController
{

	/**
	 * Override here for any controller-specific functionality
	 *
	 * @inheritdocs
	 */
	protected function Init()
	{
		parent::Init();

		// TODO: add controller-wide bootstrap code
		
		// TODO: if authentiation is required for this entire controller, for example:
		// $this->RequirePermission(ExampleUser::$PERMISSION_USER,'SecureExample.LoginForm');
	}

	/**
	 * Displays a list view of Movie objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Movie records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new MovieCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Name,Year,Location,Barcode,Rating,Contactid,Extraid'
				, '%'.$filter.'%')
			);

			// TODO: this is generic query filtering based only on criteria properties
			foreach (array_keys($_REQUEST) as $prop)
			{
				$prop_normal = ucfirst($prop);
				$prop_equals = $prop_normal.'_Equals';

				if (property_exists($criteria, $prop_normal))
				{
					$criteria->$prop_normal = RequestUtil::Get($prop);
				}
				elseif (property_exists($criteria, $prop_equals))
				{
					// this is a convenience so that the _Equals suffix is not needed
					$criteria->$prop_equals = RequestUtil::Get($prop);
				}
			}

			$output = new stdClass();

			// if a sort order was specified then specify in the criteria
 			$output->orderBy = RequestUtil::Get('orderBy');
 			$output->orderDesc = RequestUtil::Get('orderDesc') != '';
 			if ($output->orderBy) $criteria->SetOrder($output->orderBy, $output->orderDesc);

			$page = RequestUtil::Get('page');

			if ($page != '')
			{
				// if page is specified, use this instead (at the expense of one extra count query)
				$pagesize = $this->GetDefaultPageSize();

				$movies = $this->Phreezer->Query('Movie',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $movies->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $movies->TotalResults;
				$output->totalPages = $movies->TotalPages;
				$output->pageSize = $movies->PageSize;
				$output->currentPage = $movies->CurrentPage;
			}
			else
			{
				// return all results
				$movies = $this->Phreezer->Query('Movie',$criteria);
				$output->rows = $movies->ToObjectArray(true, $this->SimpleObjectParams());
				$output->totalResults = count($output->rows);
				$output->totalPages = 1;
				$output->pageSize = $output->totalResults;
				$output->currentPage = 1;
			}


			$this->RenderJSON($output, $this->JSONPCallback());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method retrieves a single Movie record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$movie = $this->Phreezer->Get('Movie',$pk);
			$this->RenderJSON($movie, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Movie record and render response as JSON
	 */
	public function Create()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$movie = new Movie($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $movie->Id = $this->SafeGetVal($json, 'id');

			$movie->Name = $this->SafeGetVal($json, 'name');
			$movie->Year = $this->SafeGetVal($json, 'year');
			$movie->Location = $this->SafeGetVal($json, 'location');
			$movie->Barcode = $this->SafeGetVal($json, 'barcode');
			$movie->Rating = $this->SafeGetVal($json, 'rating');
			$movie->Contactid = $this->SafeGetVal($json, 'contactid');
			$movie->Extraid = $this->SafeGetVal($json, 'extraid');

			$movie->Validate();
			$errors = $movie->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$movie->Save();
				$this->RenderJSON($movie, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Movie record and render response as JSON
	 */
	public function Update()
	{
		try
		{
						
			$json = json_decode(RequestUtil::GetBody());

			if (!$json)
			{
				throw new Exception('The request body does not contain valid JSON');
			}

			$pk = $this->GetRouter()->GetUrlParam('id');
			$movie = $this->Phreezer->Get('Movie',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $movie->Id = $this->SafeGetVal($json, 'id', $movie->Id);

			$movie->Name = $this->SafeGetVal($json, 'name', $movie->Name);
			$movie->Year = $this->SafeGetVal($json, 'year', $movie->Year);
			$movie->Location = $this->SafeGetVal($json, 'location', $movie->Location);
			$movie->Barcode = $this->SafeGetVal($json, 'barcode', $movie->Barcode);
			$movie->Rating = $this->SafeGetVal($json, 'rating', $movie->Rating);
			$movie->Contactid = $this->SafeGetVal($json, 'contactid', $movie->Contactid);
			$movie->Extraid = $this->SafeGetVal($json, 'extraid', $movie->Extraid);

			$movie->Validate();
			$errors = $movie->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$movie->Save();
				$this->RenderJSON($movie, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Movie record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$movie = $this->Phreezer->Get('Movie',$pk);

			$movie->Delete();

			$output = new stdClass();

			$this->RenderJSON($output, $this->JSONPCallback());

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}
}

?>
