<?php

namespace Hasob\FoundationCore\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hasob\FoundationCore\Models\Page;

use Hasob\FoundationCore\Events\PageCreatedEvent;
use Hasob\FoundationCore\Events\PageUpdatedEvent;
use Hasob\FoundationCore\Events\PageDeletedEvent;

use Hasob\FoundationCore\Requests\API\CreatePageAPIRequest;
use Hasob\FoundationCore\Requests\API\UpdatePageAPIRequest;

use Hasob\FoundationCore\Controllers\BaseController;

use Hasob\FoundationCore\Models\Organization;

/**
 * Class PageController
 * @package Hasob\FoundationCore\Controllers\API
 */

class PageAPIController extends BaseController
{
    /**
     * Display a listing of the Page.
     * GET|HEAD /pages
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request, Organization $organization)
    {
        $query = Page::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        if ($organization != null){
            $query->where('organization_id', $organization->id);
        }

        $pages = $query->get();

        return $this->sendResponse($pages->toArray(), 'Pages retrieved successfully');
    }

    /**
     * Store a newly created Page in storage.
     * POST /pages
     *
     * @param CreatePageAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePageAPIRequest $request, Organization $organization)
    {
        $input = $request->all();

        /** @var Page $page */
        $page = Page::create($input);
        if (empty($request->page_path) == true){
            $page->page_path = strtolower(self::generateRandomCode(8));
        }
        $page->save();
        PageCreatedEvent::dispatch($page);
        return $this->sendResponse($page->toArray(), 'Page saved successfully');
    }

    /**
     * Display the specified Page.
     * GET|HEAD /pages/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id, Organization $organization)
    {
        /** @var Page $page */
        $page = Page::find($id);

        if (empty($page)) {
            return $this->sendError('Page not found');
        }

        return $this->sendResponse($page->toArray(), 'Page retrieved successfully');
    }

    /**
     * Update the specified Page in storage.
     * PUT/PATCH /pages/{id}
     *
     * @param int $id
     * @param UpdatePageAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePageAPIRequest $request, Organization $organization)
    {
        /** @var Page $page */
        $page = Page::find($id);

        if (empty($page)) {
            return $this->sendError('Page not found');
        }

        $page->fill($request->all());
        $page->save();
        
        PageUpdatedEvent::dispatch($page);
        return $this->sendResponse($page->toArray(), 'Page updated successfully');
    }

    /**
     * Remove the specified Page from storage.
     * DELETE /pages/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id, Organization $organization)
    {
        /** @var Page $page */
        $page = Page::find($id);

        if (empty($page)) {
            return $this->sendError('Page not found');
        }

        $page->delete();
        PageDeletedEvent::dispatch($page);
        return $this->sendSuccess('Page deleted successfully');
    }
}
