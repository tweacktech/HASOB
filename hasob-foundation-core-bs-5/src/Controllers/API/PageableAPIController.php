<?php

namespace Hasob\FoundationCore\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hasob\FoundationCore\Models\Pageable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;


class PageableAPIController extends BaseController
{

    public function index(Request $request, Organization $organization)
    {
        $query = Pageable::query();

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

    public function store(Request $request, Organization $organization)
    {
        $input = $request->all();

        $page = Pageable::create($input);
        $page->save();
        
        return $this->sendResponse($page->toArray(), 'Page saved successfully');
    }

    public function show($id, Organization $organization)
    {
        $page = Pageable::find($id);

        if (empty($page)) {
            return $this->sendError('Page not found');
        }

        return $this->sendResponse($page->toArray(), 'Page retrieved successfully');
    }

    public function update($id, Request $request, Organization $organization)
    {
        $page = Pageable::find($id);

        if (empty($page)) {
            return $this->sendError('Page not found');
        }

        $page->fill($request->all());
        $page->save();
        
        return $this->sendResponse($page->toArray(), 'Page updated successfully');
    }

    public function destroy($id, Organization $organization)
    {
        $page = Pageable::find($id);

        if (empty($page)) {
            return $this->sendError('Page not found');
        }

        $page->delete();
        return $this->sendSuccess('Page deleted successfully');
    }
}
