<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Job_orders extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->settings_model->get_settings();   
        $this->load->model("portal/job_orders_model"); 
        
        if($this->session->userdata("USERID") == null)
        {
                echo "Sorry you are not logged in";
                die();
        }
    }

	public function add_job_orders()
	{
        $this->job_orders_model->name = $this->input->post("name");
        $this->job_orders_model->code = $this->input->post("code");
        $this->job_orders_model->status = $this->input->post("status");
        $this->job_orders_model->address = $this->input->post("address");
        $this->job_orders_model->job_orders_details = $this->input->post("job_orders_details");
        
        $this->job_orders_model->date_created = date("Y-m-d H:i:s A");
        $this->job_orders_model->created_by =  $this->session->userdata("USERID");
        echo $this->job_orders_model->insert_job_orders();
	}

	public function edit_job_orders()
	{
        $job_orders_id = $this->input->post("id");
        $this->job_orders_model->name = $this->input->post("name");
        $this->job_orders_model->code = $this->input->post("code");
        $this->job_orders_model->address = $this->input->post("address");
        $this->job_orders_model->job_orders_details = $this->input->post("job_orders_details");
        $this->job_orders_model->status = $this->input->post("status");
        $this->job_orders_model->date_modified = date("Y-m-d H:i:s A");
        $this->job_orders_model->modified_by =  $this->session->userdata("USERID");
        $this->job_orders_model->id = $job_orders_id;
        echo $this->job_orders_model->update_job_orders();
	}

	public function delete_job_orders()
	{
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $data_job_orders = $this->db->get("job_orders");
        $this->db->where("id",$id);
        $data["status"] = 3;
        echo $result = $this->db->update("job_orders",$data);
        $data = json_encode($data_job_orders->row());
        $this->logs->log = "Deleted job_orders - ID:". $data_job_orders->row()->id .", job_orders Title: ".$data_job_orders->row()->name ;
        $this->logs->details = json_encode($data);
        $this->logs->module = "job_orders";
        $this->logs->created_by = $this->session->userdata("USERID");
        $this->logs->insert_log();
        
	}

    public function get_job_orders_data()
    {
        $id = $this->input->post("id");
        $this->db->where("id",$id);
        $result = $this->db->get("job_orders");
        $job_orders = $result->row(); 
        $return["job_orders"] = $job_orders;
        echo json_encode($return); 
    } 

    public function get_job_orders_selection()
    {
        
        $search = $this->input->get("term[term]");
        $this->db->like("name",$search);  
        $this->db->where("status",1);  
        $this->db->select("name as text"); 
        $this->db->select("id as id");
        $this->db->limit(10);
        $filteredValues=$this->db->get("job_orders")->result_array();

        echo json_encode(array(
            'items' => $filteredValues
        )); 
    }
    public function get_job_orders_list()
    {
        $this->load->model("portal/data_table_model","dt_model");  
        $this->dt_model->select_columns = array("t1.id","t1.name","t1.code","t1.address","IF(t1.status=1,'Active','Inactive') as status","t1.date_created","t2.username as created_by","t1.date_modified","t3.username as modified_by");  
        $this->dt_model->where  = array("t1.id","t1.name","t1.code","t1.address","t1.status","t1.date_created","t2.username","t1.date_modified","t3.username");  
        $select_columns = array("id","name","code","address","status","date_created","created_by","date_modified","modified_by");  
        $this->dt_model->table = "job_orders AS t1 LEFT JOIN user_accounts AS t2 ON t2.id = t1.created_by LEFT JOIN user_accounts AS t3 ON t3.id = t1.modified_by ";  
        $this->dt_model->index_column = "t1.id";
        $this->dt_model->staticWhere = "t1.status != 3"; 
        $result = $this->dt_model->get_table_list();
        $output = $result["output"];
        $rResult = $result["rResult"];
        $aColumns = $result["aColumns"];
        foreach ($rResult->result_array() as $aRow) {
            $row = array();
            foreach ($select_columns as $col) {
                    if($col == "username" || $col == "created_by" || $col == "modified_by")
                    {
                        $row[] = $aRow[$col];
                    }
                    else if($col == "status")
                    {
                        if($aRow[$col] == "Inactive")
                        {
                            $row[] = '<center><small class="label bg-gray">'.$aRow[$col].'</small></center>';
                        }
                        else if($aRow[$col] == "Active")
                        {
                            $row[] = '<center><small class="label bg-green">'.$aRow[$col].'</small></center>';
                        }
                    }
                    else if($col == "cover_image")
                    {
                        if($aRow[$col] != null)
                        {    
                            $row[] = "<a href=\"#\" onclick='return false;'><img class='img-thumbnail' src='".base_url()."uploads/job_orders/".$aRow[$col]."' style='height:70px;' onclick='img_preview(\"".$aRow[$col]."\");return false;'></a>";
                        }
                        else
                        {
                            $row[] = "None";
                        }
                     }
                    else
                    {
                        $row[] = $aRow[$col] ;
                    }
            }
            
            $btns = '<!--<a href="#" onclick="_view('.$aRow['id'].');return false;" class="glyphicon glyphicon-search text-orange" data-toggle="tooltip" name="View Details"></a>-->
            <a href="#" onclick="_edit('.$aRow['id'].');return false;" class="glyphicon glyphicon-edit text-blue" data-toggle="tooltip" name="Edit"></a>
            <a href="#" onclick="_delete('.$aRow['id'].',\''.$aRow["name"].'\');return false;" class="glyphicon glyphicon-remove text-red" data-toggle="tooltip" name="Delete"></a>';
            array_push($row,$btns);
            $output['data'][] = $row;
        }
        echo json_encode( $output );
    }
}