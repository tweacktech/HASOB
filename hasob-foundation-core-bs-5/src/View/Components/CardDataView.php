<?php

namespace Hasob\FoundationCore\View\Components;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\View\Component;
use Illuminate\Support\Facades\Log;


class CardDataView extends Component
{
    
    private $control_id;
    private $search_fields;
    private $relationship_key;
    private $relationship_search_fields;
    private $search_placeholder_text;
    public $query_relationship;

    private $data_set_pagination_limit;
    private $data_set_enable_pagination;
    private $data_set_enable_search;
    
    private $data_item_template_path;
    private $data_set_group_list;
    private $data_set_query;

    private $data_set_order_list;
    private $data_set_model;

    private $json_data_route_name;


    public function __construct($model, $template){

        $this->control_id = "cdv_".time();
        $this->data_set_pagination_limit = 20;
        $this->data_set_enable_pagination = true;
        $this->data_set_enable_search = false;
        
        $this->data_item_template_path = $template;
        $this->data_set_model = $model;

        return $this;
    }

    public function setJSONDataRouteName($route_name){
        $this->json_data_route_name = $route_name;
        return $this;
    }

    public function getJSONDataRouteName(){
        if (empty($this->json_data_route_name)==false){
            return $this->json_data_route_name;
        }
        return url()->full();
    }

    public function setDataItemTemplate($path){
        $this->data_item_template_path = $path;
        return $this;
    }

    public function setSearchFields($fields){
        $this->search_fields = $fields;
        return $this;
    }

    public function setQueryRelationship($relationship){
        $this->query_relationship = $relationship;
        return $this;
    }

    public function setSearchRelationKey($relationship){
        $this->relationship_key = $relationship;
        return $this;
    }

    public function setSearchPlaceholder($text){
        $this->search_placeholder_text = $text;
        return $this;
    }

    public function enableSearch($enabled=true){
        $this->data_set_enable_search = $enabled;
        return $this;
    }

    public function enablePagination($enabled=true){
        $this->data_set_enable_pagination = $enabled;
        return $this;
    }

    public function setPaginationLimit($limit=20){
        $this->data_set_pagination_limit = $limit;
        return $this;
    }

    public function setDataQuery($query){
        $this->data_set_query = $query;
        return $this;
    }

    public function addDataGroup($group_name, $query_field, $query_value, $query_operator='='){
        if ($this->data_set_group_list == null){
            $this->data_set_group_list = array();
        }
        $this->data_set_group_list[$group_name] = [$query_field, $query_operator, $query_value];
        return $this;
    }

    public function addDataOrder($order_field, $order_type){
        if ($this->data_set_order_list == null){
            $this->data_set_order_list = array();
        }
        $this->data_set_order_list[$order_field] = $order_type;
        return $this;
    }

    public function render(){

        if (request()->expectsJson()){

            $search_term = null;
            if (request()->has('st')){
                $search_term = request()->input('st');
            }

            $model_query = new $this->data_set_model();

            if (is_array($this->data_set_query) && $this->data_set_query != null){
                $model_query = $model_query->where($this->data_set_query);
            }
            if (is_array($this->query_relationship)){
                foreach ($this->query_relationship as $key => $fields) {
                    if(is_array($fields)){
                        $model_query =   $model_query->whereHas($key, function($q) use ($fields){
                            foreach($fields as $idx=>$value){
                                $q->where($idx,$value);
                            }
                        });
                    }
                }
            }

            if ($this->data_set_order_list != null && is_array($this->data_set_order_list)){
                foreach($this->data_set_order_list as $order_field=>$order_type){
                    $model_query = $model_query->orderBy($order_field, $order_type);
                }
            }

            if (empty($search_term)==false && $this->search_fields!=null && is_array($this->search_fields)){
                
                $search_fields = $this->search_fields;
                $relationship = $this->relationship_key;
                if(is_array($relationship)){
                    foreach ($relationship as $key => $fields) {
                      if(is_array($fields)){
                        $model_query->whereHas($key ,function($q) use ($fields,$search_term){
                            foreach($fields as $idx=>$search_field){
                                if($idx == 0){
                                    $q->where($search_field,'LIKE',"%{$search_term}%");   
                                }else{
                                    $q->orWhere($search_field,'LIKE',"%{$search_term}%");
                                }       
                            }
                        })->orWhere(function($q) use ($search_fields, $search_term){
                                foreach($search_fields as $idx=>$search_field){
                                    $q->orWhere($search_field,"LIKE","%{$search_term}%");
                            }
                        });
                      }
                    }   
                } else{
                        $model_query->where(function($q) use ($search_fields, $search_term){
                            foreach($search_fields as $idx=>$search_field){
                                $q->orWhere($search_field,"LIKE","%{$search_term}%");
                            }
                        });
                }
            }
            
            $group_term = null;
            if (request()->has('grp')){
                $group_term = request()->input('grp');
            }
            if (empty($group_term)==false 
                && $this->data_set_group_list!=null 
                && is_array($this->data_set_group_list)
                && isset($this->data_set_group_list[$group_term])
                && count($this->data_set_group_list[$group_term])==3){
                
                $model_query = $model_query->where(
                    $this->data_set_group_list[$group_term][0],
                    $this->data_set_group_list[$group_term][1],
                    $this->data_set_group_list[$group_term][2]
                );
            }

            $results = [];
            $results_count = 0;
            $selected_page = 1;
            
            if ($this->data_set_enable_pagination == true){

                $selected_page = 1;
                if (request()->has('pg')){
                    $selected_page = request()->input('pg');
                }

                $results = $model_query->paginate($this->data_set_pagination_limit,['*'],'page',$selected_page);
                $results_count = $results->total();

            } else {
                $results = $model_query->get();
                $results_count = count($results);
            }

            $card_html = "";
            foreach($results as $data_item){
                $card_html .= view($this->data_item_template_path)->with('data_item', $data_item);
            }

            return response()->json([
                "paginate" => $this->data_set_enable_pagination,
                "page_number" => $selected_page,
                "pages_total" => intval(ceil($results_count/$this->data_set_pagination_limit)),
                "search_term" => $search_term,
                "result_count" => $results_count,
                "control_id" => $this->control_id,
                "cards_html" => $card_html,
                "page_limit" => $this->data_set_pagination_limit,
            ]);
        }

        return view('hasob-foundation-core::cardview.index')
                    ->with('control_id',$this->control_id)
                    ->with('data_set_query',$this->data_set_query)
                    ->with('data_set_group_list',$this->data_set_group_list)
                    ->with('data_set_pagination_limit',$this->data_set_pagination_limit)
                    ->with('data_set_enable_pagination',$this->data_set_enable_pagination)
                    ->with('data_set_enable_search',$this->data_set_enable_search)
                    ->with('search_placeholder_text',$this->search_placeholder_text);

    }

    public function render_css(){
        return view("hasob-foundation-core::cardview.card-view-css")
                    ->with('control_id',$this->control_id)
                    ->with('data_set_query',$this->data_set_query)
                    ->with('data_set_group_list',$this->data_set_group_list)
                    ->with('data_set_pagination_limit',$this->data_set_pagination_limit)
                    ->with('data_set_enable_pagination',$this->data_set_enable_pagination)
                    ->with('data_set_enable_search',$this->data_set_enable_search)
                    ->with('search_placeholder_text',$this->search_placeholder_text);
    }

    public function render_js(){
        return view("hasob-foundation-core::cardview.card-view-js")
                    ->with('control_id',$this->control_id)
                    ->with('control_obj',$this)
                    ->with('data_set_query',$this->data_set_query)
                    ->with('data_set_group_list',$this->data_set_group_list)
                    ->with('data_set_pagination_limit',$this->data_set_pagination_limit)
                    ->with('data_set_enable_pagination',$this->data_set_enable_pagination)
                    ->with('data_set_enable_search',$this->data_set_enable_search)
                    ->with('search_placeholder_text',$this->search_placeholder_text);        
    }

}