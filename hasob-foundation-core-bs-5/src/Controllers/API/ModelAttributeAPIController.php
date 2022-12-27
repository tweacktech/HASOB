<?php

namespace Hasob\FoundationCore\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Hasob\FoundationCore\Models\ModelArtifact;

use Hasob\FoundationCore\Requests\API\UpdateModelArtifactAPIRequest;
use Hasob\FoundationCore\Requests\API\CreateModelArtifactAPIRequest;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;


class ModelAttributeAPIController extends BaseController
{

    public function index(Request $request, Organization $organization)
    {
        $query = ModelArtifact::query();

        if ($request->get('skip')) {
            $query->skip($request->get('skip'));
        }
        if ($request->get('limit')) {
            $query->limit($request->get('limit'));
        }
        
        if ($organization != null){
            $query->where('organization_id', $organization->id);
        }

        $attributes = $query->get();

        return $this->sendResponse($attributes->toArray(), 'Attributes retrieved successfully');
    }

    public function store(CreateModelArtifactAPIRequest $request, Organization $organization)
    {
        $input = $request->all();

        $attribute = ModelArtifact::create($input);
        $attribute->save();
        
        return $this->sendResponse($attribute->toArray(), 'Attribute saved successfully');
    }

    public function show($id, Organization $organization)
    {
        $attribute = ModelArtifact::find($id);

        if (empty($attribute)) {
            return $this->sendError('Attribute not found');
        }

        return $this->sendResponse($attribute->toArray(), 'Attribute retrieved successfully');
    }

    public function update($id, UpdateModelArtifactAPIRequest $request, Organization $organization)
    {
        $attribute = ModelArtifact::find($id);

        if (empty($attribute)) {
            return $this->sendError('Attribute not found');
        }

        $attribute->fill($request->all());
        $attribute->save();
        
        return $this->sendResponse($attribute->toArray(), 'Attribute updated successfully');
    }

    public function destroy($id, Organization $organization)
    {
        $attribute = ModelArtifact::find($id);

        if (empty($attribute)) {
            return $this->sendError('Attribute not found');
        }

        $attribute->delete();
        return $this->sendSuccess('Attribute deleted successfully');
    }
}
