<?php
class OrderItemModel extends CI_Model{

    function OrderItemModel(){
        // Call the Model constructor
        parent::__construct();
    }

    //add new order item (by default will be qty=1)
    function addOrderItem($item_id, $order_id, $param){
    	$param['item_id']  = $item_id;
    	$param['order_id'] = $order_id;
        $this->db->insert('order_item', $param);
        $order_item_id = $this->db->insert_id();
        
        return $order_item_id;
    }
    
    //update the given order_item_id or (order_id and item_id)
    function updateOrderItem($param, $order_item_id = NULL, $order_id = NULL, $item_id = NULL){
    	if ($order_item_id != NULL){
   			$this->db->where('order_item_id', $order_item_id);
    	}
    	else{
    		$this->db->where('order_id', $order_id);
    		$this->db->where('item_id', $item_id);
    	}
 			
    	$this->db->update('order_item', $param);
    }
    
    //remove the given order item
    function removeOrderItem($order_item_id = NULL, $order_id = NULL, $item_id = NULL){
        if ($order_item_id != NULL){
   			$this->db->where('order_item_id', $order_item_id);
    	}
    	else{
    		$this->db->where('order_id', $order_id);
    		$this->db->where('item_id', $item_id);
    	}
    	$this->db->delete('order_item');
    }
    
    //remove all order item for a given order_id
    function emptyOrderItem($order_id){
    	$this->db->where('order_id', $order_id);
    	$this->db->delete('order_item');
    }
    
    //return list of order_item base on a given order_id
    function getOrderItemList($order_id){
    	$sql = 'select oi.order_item_id, oi.item_id, oi.order_id, oi.price, oi.price_discount_amt, oi.price_discount_percent, oi.qty,
				i.qty as qty_available, p.product_id, p.product_name, c.color_id, c.color_name, s.size_id, s.size_name
				from order_item oi inner join item i on oi.item_id = i.item_id
				inner join product p on p.product_id = i.product_id
				left join color c on c.color_id = i.color_id
				left join size s on s.size_id = i.size_id where oi.order_id = ?';
    	$query = $this->db->query($sql, array($order_id));
    	$data = $query->result_array();
    	$query->free_result();
    	return $data;
    }
    
    //return a order item for a given order_item_id or (order_id and item_id)
    function getOrderItem($order_item_id = NULL, $order_id = NULL, $item_id = NULL){
    	$sql = 'select oi.order_item_id, oi.item_id, oi.order_id, oi.price, oi.price_discount_amt, oi.price_discount_percent, oi.qty,
				i.qty as qty_available, p.product_id, p.product_name, c.color_id, c.color_name, s.size_id, s.size_name
				from order_item oi inner join item i on oi.item_id = i.item_id
				inner join product p on p.product_id = i.product_id
				left join color c on c.color_id = i.color_id
				left join size s on s.size_id = i.size_id ';
    	if ($order_item_id != NULL){
    		$sql = $sql.' where oi.order_item_id = ?';
    		$param = array($order_item_id);
    	}
    	else{
    		$sql = $sql.' where oi.order_id = ? and oi.item_id = ?';
    		$param = array($order_id, $item_id);
    	}
    	
    	$query = $this->db->query($sql, $param);
    	$data = $query->row_array();
    	$query->free_result();
    	return $data;
    }
    
    function getNumberOfItem($order_id){
    	$sql = 'select ifnull(sum(qty), 0) as num_item from order_item where order_id = ?';
    	$query = $this->db->query($sql, $order_id);
        $data = $query->row_array();
        
        $query->free_result();  
        return $data['num_item'];
    }
    
    
    
}