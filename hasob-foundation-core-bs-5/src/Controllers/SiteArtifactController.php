<?php

namespace Hasob\FoundationCore\Controllers;

use Hasob\FoundationCore\Models\SiteArtifact;

use Hasob\FoundationCore\Events\SiteArtifactCreatedEvent;
use Hasob\FoundationCore\Events\SiteArtifactUpdatedEvent;
use Hasob\FoundationCore\Events\SiteArtifactDeletedEvent;

use Hasob\FoundationCore\Requests\CreateSiteArtifactRequest;
use Hasob\FoundationCore\Requests\UpdateSiteArtifactRequest;

use Hasob\FoundationCore\DataTables\SiteArtifactDataTable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SiteArtifactController extends BaseController
{
    /**
     * Display a listing of the SiteArtifact.
     *
     * @param SiteArtifactDataTable $siteArtifactDataTable
     * @return Response
     */
    public function index(Organization $org, SiteArtifactDataTable $siteArtifactDataTable)
    {
        $current_user = Auth()->user();

        $cdv_site_artifacts = new \Hasob\FoundationCore\View\Components\CardDataView(SiteArtifact::class, "hasob-foundation-core::site_artifacts.card_view_item");
        $cdv_site_artifacts->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search SiteArtifact');

        if (request()->expectsJson()){
            return $cdv_site_artifacts->render();
        }

        return view('hasob-foundation-core::site_artifacts.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_site_artifacts', $cdv_site_artifacts);

        /*
        return $siteArtifactDataTable->render('hasob-foundation-core::pages.site_artifacts.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new SiteArtifact.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('hasob-foundation-core::site_artifacts.create');
    }

    /**
     * Store a newly created SiteArtifact in storage.
     *
     * @param CreateSiteArtifactRequest $request
     *
     * @return Response
     */
    public function store(Organization $org, CreateSiteArtifactRequest $request)
    {
        $input = $request->all();

        /** @var SiteArtifact $siteArtifact */
        $siteArtifact = SiteArtifact::create($input);

        Flash::success('Site Artifact saved successfully.');

        SiteArtifactCreatedEvent::dispatch($siteArtifact);
        return redirect(route('fc.siteArtifacts.index'));
    }

    /**
     * Display the specified SiteArtifact.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Organization $org, $id)
    {
        /** @var SiteArtifact $siteArtifact */
        $siteArtifact = SiteArtifact::find($id);

        if (empty($siteArtifact)) {
            Flash::error('Site Artifact not found');

            return redirect(route('fc.siteArtifacts.index'));
        }

        return view('hasob-foundation-core::site_artifacts.show')->with('siteArtifact', $siteArtifact);
    }

    /**
     * Show the form for editing the specified SiteArtifact.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Organization $org, $id)
    {
        /** @var SiteArtifact $siteArtifact */
        $siteArtifact = SiteArtifact::find($id);

        if (empty($siteArtifact)) {
            Flash::error('Site Artifact not found');

            return redirect(route('fc.siteArtifacts.index'));
        }

        return view('hasob-foundation-core::site_artifacts.edit')->with('siteArtifact', $siteArtifact);
    }

    /**
     * Update the specified SiteArtifact in storage.
     *
     * @param  int              $id
     * @param UpdateSiteArtifactRequest $request
     *
     * @return Response
     */
    public function update(Organization $org, $id, UpdateSiteArtifactRequest $request)
    {
        /** @var SiteArtifact $siteArtifact */
        $siteArtifact = SiteArtifact::find($id);

        if (empty($siteArtifact)) {
            Flash::error('Site Artifact not found');

            return redirect(route('fc.siteArtifacts.index'));
        }

        $siteArtifact->fill($request->all());
        $siteArtifact->save();

        Flash::success('Site Artifact updated successfully.');
        
        SiteArtifactUpdatedEvent::dispatch($siteArtifact);
        return redirect(route('fc.siteArtifacts.index'));
    }

    /**
     * Remove the specified SiteArtifact from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Organization $org, $id)
    {
        /** @var SiteArtifact $siteArtifact */
        $siteArtifact = SiteArtifact::find($id);

        if (empty($siteArtifact)) {
            Flash::error('Site Artifact not found');

            return redirect(route('fc.siteArtifacts.index'));
        }

        $siteArtifact->delete();

        Flash::success('Site Artifact deleted successfully.');
        SiteArtifactDeletedEvent::dispatch($siteArtifact);
        return redirect(route('fc.siteArtifacts.index'));
    }

        
    public function processBulkUpload(Organization $org, Request $request){

        $attachedFileName = time() . '.' . $request->file->getClientOriginalExtension();
        $request->file->move(public_path('uploads'), $attachedFileName);
        $path_to_file = public_path('uploads').'/'.$attachedFileName;

        //Process each line
        $loop = 1;
        $errors = [];
        $lines = file($path_to_file);

        if (count($lines) > 1) {
            foreach ($lines as $line) {
                
                if ($loop > 1) {
                    $data = explode(',', $line);
                    // if (count($invalids) > 0) {
                    //     array_push($errors, $invalids);
                    //     continue;
                    // }else{
                    //     //Check if line is valid
                    //     if (!$valid) {
                    //         $errors[] = $msg;
                    //     }
                    // }
                }
                $loop++;
            }
        }else{
            $errors[] = 'The uploaded csv file is empty';
        }
        
        if (count($errors) > 0) {
            return $this->sendError($this->array_flatten($errors), 'Errors processing file');
        }
        return $this->sendResponse($subject->toArray(), 'Bulk upload completed successfully');
    }
}
