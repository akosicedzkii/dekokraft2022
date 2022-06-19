<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Search extends CI_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    $this->settings_model->get_settings();
    $this->load->model("portal/users_model");
    if ($this->session->userdata("USERID") == null) {
        redirect(base_url() . "portal/login");
    }
    $this->user_access = $this->settings_model->get_user_access();
    $this->default_page = $this->settings_model->get_role_default_page();
    $this->db->query("optimize table materials");

  }

  public function index()
  {
    $search_query = $this->input->post("search_query",TRUE);
    $this->db->where("code",$search_query);
    $response = $this->db->query("SELECT il.invoice_id,c.customer_name,i.date_created,pv.color,pv.description FROM invoice_lines il left join invoices i on i.id  = il.invoice_id  LEFT JOIN customers c ON c.id  = i.customer_id LEFT JOIN product_variants pv on pv.id = il.product_id LEFT join products p on p.id = pv.product_id WHERE p.code = '$search_query'");
    $return = "";
    if($response=="")
    {
        echo "No Result Found!!";
        exit;
    }
    foreach ($response->result() as $res) {
        $return .= "<div class='card-body'>";
        $return .= "<div class='callout callout-info'><b>Invoice ID:</b> ". $res->invoice_id;
        $return .= "<br><b>Customer Name:</b> ". $res->customer_name;
        $return .= "<br><b>Date Ordered:</b> ". $res->date_created;
        $return .= "<br><b>Product Variant:</b> ". $res->description;
        $return .= "<br><b>Color:</b> ". $res->color."</div>";
        $return .="</div>";

    }
    echo $return;
  }

}


/* End of file Search.php */
/* Location: ./application/controllers/Search.php */