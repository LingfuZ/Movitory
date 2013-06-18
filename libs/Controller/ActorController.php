<?php
/** @package    MOVITORY::Controller */

/** import supporting libraries */
require_once("AppBaseController.php");
require_once("Model/Actor.php");

/**
 * ActorController is the controller class for the Actor object.  The
 * controller is responsible for processing input from the user, reading/updating
 * the model as necessary and displaying the appropriate view.
 *
 * @package MOVITORY::Controller
 * @author ClassBuilder
 * @version 1.0
 */
class ActorController extends AppBaseController
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
	 * Displays a list view of Actor objects
	 */
	public function ListView()
	{
		$this->Render();
	}

	/**
	 * API Method queries for Actor records and render as JSON
	 */
	public function Query()
	{
		try
		{
			$criteria = new ActorCriteria();
			
			// TODO: this will limit results based on all properties included in the filter list 
			$filter = RequestUtil::Get('filter');
			if ($filter) $criteria->AddFilter(
				new CriteriaFilter('Id,Firstname,Lastname,Dateofbirth,City,State'
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

				$actors = $this->Phreezer->Query('Actor',$criteria)->GetDataPage($page, $pagesize);
				$output->rows = $actors->ToObjectArray(true,$this->SimpleObjectParams());
				$output->totalResults = $actors->TotalResults;
				$output->totalPages = $actors->TotalPages;
				$output->pageSize = $actors->PageSize;
				$output->currentPage = $actors->CurrentPage;
			}
			else
			{
				// return all results
				$actors = $this->Phreezer->Query('Actor',$criteria);
				$output->rows = $actors->ToObjectArray(true, $this->SimpleObjectParams());
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
	 * API Method retrieves a single Actor record and render as JSON
	 */
	public function Read()
	{
		try
		{
			$pk = $this->GetRouter()->GetUrlParam('id');
			$actor = $this->Phreezer->Get('Actor',$pk);
			$this->RenderJSON($actor, $this->JSONPCallback(), true, $this->SimpleObjectParams());
		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method inserts a new Actor record and render response as JSON
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

			$actor = new Actor($this->Phreezer);

			// TODO: any fields that should not be inserted by the user should be commented out

			// this is an auto-increment.  uncomment if updating is allowed
			// $actor->Id = $this->SafeGetVal($json, 'id');

			$actor->Firstname = $this->SafeGetVal($json, 'firstname');
			$actor->Lastname = $this->SafeGetVal($json, 'lastname');
			$actor->Dateofbirth = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dateofbirth')));
			$actor->City = $this->SafeGetVal($json, 'city');
			$actor->State = $this->SafeGetVal($json, 'state');

			$actor->Validate();
			$errors = $actor->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$actor->Save();
				$this->RenderJSON($actor, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}

		}
		catch (Exception $ex)
		{
			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method updates an existing Actor record and render response as JSON
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
			$actor = $this->Phreezer->Get('Actor',$pk);

			// TODO: any fields that should not be updated by the user should be commented out

			// this is a primary key.  uncomment if updating is allowed
			// $actor->Id = $this->SafeGetVal($json, 'id', $actor->Id);

			$actor->Firstname = $this->SafeGetVal($json, 'firstname', $actor->Firstname);
			$actor->Lastname = $this->SafeGetVal($json, 'lastname', $actor->Lastname);
			$actor->Dateofbirth = date('Y-m-d H:i:s',strtotime($this->SafeGetVal($json, 'dateofbirth', $actor->Dateofbirth)));
			$actor->City = $this->SafeGetVal($json, 'city', $actor->City);
			$actor->State = $this->SafeGetVal($json, 'state', $actor->State);

			$actor->Validate();
			$errors = $actor->GetValidationErrors();

			if (count($errors) > 0)
			{
				$this->RenderErrorJSON('Please check the form for errors',$errors);
			}
			else
			{
				$actor->Save();
				$this->RenderJSON($actor, $this->JSONPCallback(), true, $this->SimpleObjectParams());
			}


		}
		catch (Exception $ex)
		{


			$this->RenderExceptionJSON($ex);
		}
	}

	/**
	 * API Method deletes an existing Actor record and render response as JSON
	 */
	public function Delete()
	{
		try
		{
						
			// TODO: if a soft delete is prefered, change this to update the deleted flag instead of hard-deleting

			$pk = $this->GetRouter()->GetUrlParam('id');
			$actor = $this->Phreezer->Get('Actor',$pk);

			$actor->Delete();

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
