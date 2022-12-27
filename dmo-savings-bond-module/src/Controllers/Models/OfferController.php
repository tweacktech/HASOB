<?php

namespace DMO\SavingsBond\Controllers\Models;

use DMO\SavingsBond\Models\Offer;

use DMO\SavingsBond\Requests\CreateOfferRequest;
use DMO\SavingsBond\Requests\UpdateOfferRequest;

use DMO\SavingsBond\DataTables\OfferDataTable;

use Hasob\FoundationCore\Controllers\BaseController;
use Hasob\FoundationCore\Models\Organization;

use Session;

use Illuminate\Http\Request;
use Illuminate\Http\Response;


class OfferController extends BaseController
{
    /**
     * Display a listing of the Offer.
     *
     * @param OfferDataTable $offerDataTable
     * @return Response
     */
    public function index(OfferDataTable $offerDataTable)
    {
        $current_user = Auth()->user();
        $cdv_offers = new \Hasob\FoundationCore\View\Components\CardDataView(Offer::class, "dmo-savings-bond-module::pages.offers.card_view_item");
        $cdv_offers     //->setDataQuery(['organization_id'=>$org->id])
                        //->addDataGroup('Most recent Offers','organization_id','value')
                        ->setSearchFields(['created_at','offer_title'])
                        //->addDataOrder('display_ordinal','DESC')
                        ->addDataOrder('created_at','DESC')
                        ->enableSearch(true)
                        ->enablePagination(true)
                        ->setPaginationLimit(20)
                        ->setSearchPlaceholder('Search Offer By Offer-Title or Date');
        if (request()->expectsJson()){
            return $cdv_offers->render();
        }
        return view('dmo-savings-bond-module::pages.offers.card_view_index')
                    ->with('current_user', $current_user)
                   /* ->with('months_list', BaseController::monthsList())
                    ->with('states_list', BaseController::statesList())*/
                    ->with('cdv_offers', $cdv_offers);
        /*
        return $offerDataTable->render('dmo-savings-bond-module::pages.offers.index',[
            'current_user'=>$current_user,
            'months_list'=>BaseController::monthsList(),
            'states_list'=>BaseController::statesList()
        ]);
        */
    }

    /**
     * Show the form for creating a new Offer.
     *
     * @return Response
     */
    public function create()
    {
        return view('dmo-savings-bond-module::pages.offers.create');
    }

    /**
     * Store a newly created Offer in storage.
     *
     * @param CreateOfferRequest $request
     *
     * @return Response
     */
    public function store(CreateOfferRequest $request)
    {
        $input = $request->all();
        $input['organization_id'] = Auth()->user()->organization_id;
        /** @var Offer $offer */
        $offer = Offer::create($input);
    //Note that the event associated to this method was fired in the Model!
        /*Flash::success('Offer saved successfully.');*/
        //Session::flash('success', 'Offer saved successfully.');
        return redirect(route('sb.offers.index'));
    }

    /**
     * Display the specified Offer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Offer $offer */
        $offer = Offer::find($id);
        if (empty($offer)) {
            //Flash::error('Offer not found');
            //Session::flash('error', 'Offer not found.');
            return redirect(route('sb.offers.index'));
        }
        if (request()->expectsJson()){
            return $this->sendResponse($offer->toArray(), '');
        }
        return view('dmo-savings-bond-module::pages.offers.show')->with('offer', $offer);
    }

    /**
     * Show the form for editing the specified Offer.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Offer $offer */
        $offer = Offer::find($id);
        if (empty($offer)) {
            //Flash::error('Offer not found');
            //Session::flash('error', 'Offer not found.');
            return redirect(route('sb.offers.index'));
        }
        return view('dmo-savings-bond-module::pages.offers.edit')->with('offer', $offer);
    }

    /**
     * Update the specified Offer in storage.
     *
     * @param  int              $id
     * @param UpdateOfferRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateOfferRequest $request)
    {
        /** @var Offer $offer */
        $offer = Offer::find($id);
        if (empty($offer)) {
            //Flash::error('Offer not found');
            //Session::flash('error', 'Offer not found.');
            return redirect(route('sb.offers.index'));
        }
        $offer->fill($request->all());
        $offer->save();
    //Note that the event associated to this method was fired in the Model!
        //Flash::success('Offer updated successfully.');
        //Session::flash('success', 'Offer updated successfully.');
        return redirect(route('sb.offers.index'));
    }

    /**
     * Remove the specified Offer from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Offer $offer */
        $offer = Offer::find($id);
        if (empty($offer)) {
            //Flash::error('Offer not found');
            //Session::flash('error', 'Offer not found.');
            return redirect(route('sb.offers.index'));
        }
        $offer->delete();
    //Note that the event associated to this method was fired in the Model!
        //Flash::success('Offer deleted successfully.');
        //Session::flash('success', 'Offer deleted successfully.');
        return redirect(route('sb.offers.index'));
    }

        
    public function processBulkUpload(Request $request){

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
