<?php

namespace Hasob\FoundationCore\Controllers;

use Hasob\FoundationCore\Models\Page;

use Hasob\FoundationCore\Events\PageCreatedEvent;
use Hasob\FoundationCore\Events\PageUpdatedEvent;
use Hasob\FoundationCore\Events\PageDeletedEvent;

use Hasob\FoundationCore\Requests\CreatePageRequest;
use Hasob\FoundationCore\Requests\UpdatePageRequest;

use Hasob\FoundationCore\DataTables\PageDataTable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;

use Flash;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class PageController extends BaseController
{
    /**
     * Display a listing of the Page.
     *
     * @param PageDataTable $pageDataTable
     * @return Response
     */
    public function index(Organization $org, PageDataTable $pageDataTable)
    {
        $current_user = Auth()->user();

        $cdv_pages = new \Hasob\FoundationCore\View\Components\CardDataView(Page::class, "hasob-foundation-core::pages.card_view_item");
        $cdv_pages->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('label','field','value')
                        //->setSearchFields(['field_to_search1','field_to_search2'])
                        //->addDataOrder('display_ordinal','DESC')
                        //->addDataOrder('id','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search Page');

        if (request()->expectsJson()){
            return $cdv_pages->render();
        }

        return view('hasob-foundation-core::pages.card_view_index')
                    ->with('current_user', $current_user)
                    ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())
                    ->with('cdv_pages', $cdv_pages);

        /*
        return $pageDataTable->render('hasob-foundation-core::pages.pages.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new Page.
     *
     * @return Response
     */
    public function create(Organization $org)
    {
        return view('hasob-foundation-core::pages.create');
    }

    /**
     * Store a newly created Page in storage.
     *
     * @param CreatePageRequest $request
     *
     * @return Response
     */
    public function store(Organization $org, CreatePageRequest $request)
    {
        $input = $request->all();

        /** @var Page $page */
        $page = Page::create($input);
        
        if (empty($request->page_path) == true){
            $page->page_path = strtolower(self::generateRandomCode(8));
        }
        $page->save();

        Flash::success('Page saved successfully.');

        PageCreatedEvent::dispatch($page);
        return redirect(route('fc.pages.index'));
    }

    /**
     * Display the specified Page.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show(Organization $org, $id)
    {
        /** @var Page $page */
        $page = Page::find($id);

        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('fc.pages.index'));
        }

        return view('hasob-foundation-core::pages.show')->with('page', $page);
    }

    /**
     * Show the form for editing the specified Page.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit(Organization $org, $id)
    {
        /** @var Page $page */
        $page = Page::find($id);

        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('fc.pages.index'));
        }

        return view('hasob-foundation-core::pages.edit')->with('page', $page);
    }

    /**
     * Update the specified Page in storage.
     *
     * @param  int              $id
     * @param UpdatePageRequest $request
     *
     * @return Response
     */
    public function update(Organization $org, $id, UpdatePageRequest $request)
    {
        /** @var Page $page */
        $page = Page::find($id);

        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('fc.pages.index'));
        }

        $page->fill($request->all());
        $page->save();

        Flash::success('Page updated successfully.');
        
        PageUpdatedEvent::dispatch($page);
        return redirect(route('fc.pages.index'));
    }

    /**
     * Remove the specified Page from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy(Organization $org, $id)
    {
        /** @var Page $page */
        $page = Page::find($id);

        if (empty($page)) {
            Flash::error('Page not found');

            return redirect(route('fc.pages.index'));
        }

        $page->delete();

        Flash::success('Page deleted successfully.');
        PageDeletedEvent::dispatch($page);
        return redirect(route('fc.pages.index'));
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
