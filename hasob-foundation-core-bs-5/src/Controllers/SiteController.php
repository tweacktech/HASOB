<?php

namespace Hasob\FoundationCore\Controllers;

use Carbon;
use Session;
use Validator;

use Hasob\FoundationCore\Models\Site;

use Hasob\FoundationCore\Events\SiteCreatedEvent;
use Hasob\FoundationCore\Events\SiteUpdatedEvent;
use Hasob\FoundationCore\Events\SiteDeletedEvent;

use Hasob\FoundationCore\Requests\CreateSiteRequest;
use Hasob\FoundationCore\Requests\UpdateSiteRequest;

use Hasob\FoundationCore\DataTables\SiteDataTable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;

use Flash;


use Illuminate\Http\Request;
use Illuminate\Http\Response;


class SiteController extends BaseController
{
    /**
     * Display a listing of the Site.
     *
     * @param SiteDataTable $siteDataTable
     * @return Response
     */
    public function index(Organization $org, SiteDataTable $siteDataTable)
    {
        $current_user = Auth()->user();

        $cdv_sites = new \Hasob\FoundationCore\View\Components\CardDataView(Site::class, "hasob-foundation-core::sites.card_view_item");
        $cdv_sites->setDataQuery(['organization_id'=>$org->id])
                        ->setSearchFields(['site_name','description'])
                        ->addDataOrder('display_ordinal','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search Sites');

        if (request()->expectsJson()){
            return $cdv_sites->render();
        }

        return view('hasob-foundation-core::sites.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_sites', $cdv_sites);
    }

    /**
     * Show the form for creating a new Site.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('hasob-foundation-core::pages.sites.create');
    }

    /**
     * Store a newly created Site in storage.
     *
     * @param CreateSiteRequest $request
     *
     * @return Response
     */
    public function store(Organization $org, CreateSiteRequest $request)
    {
        $input = $request->all();

        /** @var Site $site */
        $site = Site::create($input);
        if (empty($request->site_path) == true){
            $site->site_path = strtolower(self::generateRandomCode(8));
        }
        $site->save();
      //  Flash::success('Site saved successfully.');
        Session::flash('success','Site saved successfully');
        SiteCreatedEvent::dispatch($site);
        return redirect(route('fc.sites.index'));
    }

    /**
     * Display the specified Site.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Organization $org, $id)
    {
        /** @var Site $site */
        $site = Site::find($id);

        if (empty($site)) {
           // Flash::error('Site not found');
            Session::flash('error','Site not found');
            return redirect(route('fc.sites.index'));
        }

        return view('hasob-foundation-core::sites.show')->with('site', $site);
    }

    /**
     * Show the form for editing the specified Site.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Organization $org, $id)
    {
        /** @var Site $site */
        $site = Site::find($id);

        if (empty($site)) {
           // Flash::error('Site not found');
            Session::flash('error','Site not found');
            return redirect(route('fc.sites.index'));
        }

        return view('hasob-foundation-core::sites.edit')->with('site', $site);
    }

    /**
     * Update the specified Site in storage.
     *
     * @param  int              $id
     * @param UpdateSiteRequest $request
     *
     * @return Response
     */
    public function update(Organization $org, $id, UpdateSiteRequest $request)
    {
        /** @var Site $site */
        $site = Site::find($id);

        if (empty($site)) {
            //Flash::error('Site not found');
            Session::flash('error','Site not found');
            return redirect(route('fc.sites.index'));
        }

        $site->fill($request->all());
        $site->save();

        //Flash::success('Site updated successfully.');
        Session::flash('success','Site updated successfully');
        SiteUpdatedEvent::dispatch($site);
        return redirect(route('fc.sites.index'));
    }

    /**
     * Remove the specified Site from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Organization $org, $id)
    {
        /** @var Site $site */
        $site = Site::find($id);

        if (empty($site)) {
            //Flash::error('Site not found');
            Session::flash('error','Site not found');
            return redirect(route('fc.sites.index'));
        }

        $site->delete();

        //Flash::success('Site deleted successfully.');
        Session::flash('error','Site deleted successfully.');
        SiteDeleted::dispatch($site);
        return redirect(route('fc.sites.index'));
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
