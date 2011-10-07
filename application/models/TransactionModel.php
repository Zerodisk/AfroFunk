<?php
class TransactionModel extends CI_Model{

    function TransactionModel(){
        // Call the Model constructor
        parent::__construct();
    }
    
    function transacNew($item_id, $qty){
    	$this::addNewTransaction($item_id, 'PIN', $qty);
    }
    
    function transacSale($item_id, $qty, $order_id){
    	$this::addNewTransaction($item_id, 'PSA', $qty, $order_id);
    }
    
    function transacRefund($item_id, $qty, $order_id){
    	$this::addNewTransaction($item_id, 'PRF', $qty, $order_id);
    }
    
    function transacRemove($item_id, $qty){
    	$this::addNewTransaction($item_id, 'POT', $qty);
    }
    
    function transacExchange($item_id_from, $item_id_to, $qty, $order_id = NULL){
    	$this::addNewTransaction($item_id_from, 'PXI', $qty, $order_id);
    	$this::addNewTransaction($item_id_to,   'PXO', $qty, $order_id);
    }
    
    function getSummaryQtyByItem($item_id){
    	$sql = 'select sum(qty) as qty from transaction';
    	$query = $this->db->query($sql);
        $data = $query->row_array();
        
        $query->free_result();  
        return $data['qty'];   
    }
    
    
    /* ----------------- start private internal function here --------------- */
    private function addNewTransaction($item_id, $transaction_type, $qty, $order_id = NULL){
    	$param = array(
    					'item_id' 			=> $item_id,
    					'order_id'			=> $order_id,
    					'transaction_type'	=> $transaction_type,
    					'qty'				=> ($qty * $this::getTransactionTypeValue($transaction_type)),
    					'date_created' 		=> date('Y-m-d H:i:s'),
    	              );
    	$this->db->insert('transaction', $param); 
    }
    
    private function getTransactionTypeValue($transaction_type){
    	$sql = 'select value from transaction_mapping where transaction_type = ?';
    	$query = $this->db->query($sql, array($transaction_type));
        $value = 0;
    	
        if ($query->num_rows() > 0){
           $row = $query->row_array(); 
           $value = $row['value'];
        }
        
        $query->free_result(); 
        return $value;
    }
    
}