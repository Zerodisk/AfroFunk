<?php
class ItemModel extends CI_Model{
    
    function ItemModel()
    {
        // Call the Model constructor
        parent::__construct();
        $this->load->model('TransactionModel');
    }

    //return list of items for a given product_id
    public function getItemList($product_id, $active_only = TRUE){
    	$sql_extra = '';
    	if ($active_only){
    		$sql_extra = ' and i.is_active = 1 ';
    	}
    	
    	$sql = 'select i.item_id, i.qty, i.weight, i.date_created, i.date_modified,
				i.color_id, c.color_name, i.size_id, s.size_name, i.is_active
				from item i left join size s on i.size_id = s.size_id
					left join color c on i.color_id = c.color_id
				where i.product_id = ? '.$sql_extra;
    	$query = $this->db->query($sql, array($product_id));
        $data = $query->result_array();
        
        $query->free_result();  
        return $data;     	
    }
    
    //return a single item for a given item_id
    public function getItem($item_id, $active_only = TRUE){
    	$sql_extra = '';
    	if ($active_only){
    		$sql_extra = ' and i.is_active = 1 ';
    	}
    	$sql = 'select i.item_id, i.qty, i.weight, i.date_created, i.date_modified,
				i.color_id, c.color_name, i.size_id, s.size_name,
				p.product_id, p.product_name, p.price, p.price_discount_amt, (p.price - p.price_discount_amt) as price_sell
				from item i inner join product p on i.product_id = p.product_id
				    left join size s on i.size_id = s.size_id
					left join color c on i.color_id = c.color_id
				where i.item_id = ? '.$sql_extra;
    	$query = $this->db->query($sql, array($item_id));
        $data = $query->row_array();
        
        $query->free_result();  
        return $data;
    }
    
    //add new item for under a given product_it
    public function addNewItem($product_id, $qty = 0, $param = NULL){
    	if (!is_array($param)){
    		$param = array();
    	}
    	
    	$param['product_id'] = $product_id;
    	$param['qty'] = $qty;
    	$param['date_created'] 	= date('Y-m-d H:i:s');
    	$param['date_modified'] = date('Y-m-d H:i:s');
    	
    	$this->db->insert('item', $param);
    	$item_id = $this->db->insert_id();

    	if ($qty > 0){
    		$this->TransactionModel->transacNew($item_id, $qty);
    	}
    	
    	return $item_id;
    }
    
    //for replenish stock item
    public function replenishItem($item_id, $replenish_qty){
    	//add new transaction
    	$this->TransactionModel->transacNew($item_id, $replenish_qty);
		//update qty
		$this::updateQty($item_id);
    }
    
    //for update item
    public function updateItem($item_id, $param = NULL){
    	if (!is_array($param)){
    		$param = array();
    	}
    	
    	$param['date_modified'] = date('Y-m-d H:i:s');
        $this->db->where('item_id', $item_id);
        $this->db->update('item', $param);
    }
    
    //for delete item and behide the sence will just disable item
    public function deleteItem($item_id){
    	$param = array();
    	$param['is_active'] = 0;
    	$this::updateItem($item_id, $param);
    }
    
    //function for updateing item.qty and transaction table by a given transac_type and quantity
    public function updateStock($item_id, $transac_type, $qty){
    	if ($qty <= 0)
    		return FALSE;		//can't update with negative/zero qty before apply transac type value
    
	    //add new transaction
	    $this->TransactionModel->addNewTransaction($item_id, $transac_type, $qty);
	    //get current quantity available
	    $current_qty = $this->TransactionModel->getSummaryQtyByItem($item_id);
	    //update to item table
	    $this::updateItem($item_id, array('qty' => $current_qty));
	    return TRUE;
    }   
    
    
    
    /*----------------- start private function here---------------- */
    
    //update the qty in item table base on the summary qty on transaction table
    private function updateQty($item_id){
    	//get summary qty
    	$qty = $this->TransactionModel->getSummaryQtyByItem($item_id);
    	//update item
    	$param = array();
    	$param['qty'] = $qty;
    	$this::updateItem($item_id, $param);
    }
    
}