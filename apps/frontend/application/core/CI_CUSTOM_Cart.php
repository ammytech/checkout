<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class CI_CUSTOM_Cart extends CI_Cart
{
      
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * Insert items into the cart and save it to the session table
     *
     * @param	array
     * @return	bool
     */
    public function insert($items = array())
    {
        // Was any cart data passed? No? Bah...
        if ( ! is_array($items) OR count($items) === 0)
        {
            log_message('error', 'The insert method must be passed an array containing data.');
            return FALSE;
        }
        
        // You can either insert a single product using a one-dimensional array,
        // or multiple products using a multi-dimensional one. The way we
        // determine the array type is by looking for a required array key named "id"
        // at the top level. If it's not found, we will assume it's a multi-dimensional array.
        
        $save_cart = FALSE;
        if (isset($items['id']))
        {
            if (($rowid = $this->_insert($items)))
            {
                $save_cart = TRUE;
            }
        }
        else
        {
            foreach ($items as $val)
            {
                if (is_array($val) && isset($val['id']))
                {
                    if ($this->_insert($val))
                    {
                        $save_cart = TRUE;
                    }
                }
            }
        }
        
        // Save the cart data if the insert was successful
        if ($save_cart === TRUE)
        {
            $this->_save_cart();
            return isset($rowid) ? $rowid : TRUE;
        }
        
        return FALSE;
    }
    /**
     * Save the cart array to the session DB
     *
     * @return	bool
     */
    protected  function _save_cart()
    {
        
        // Let's add up the individual prices and set the cart sub-total
        $this->_cart_contents['total_items'] = $this->_cart_contents['cart_total'] = 0;
        foreach ($this->_cart_contents as $key => $val)
        {
            // We make sure the array contains the proper indexes
            if ( ! is_array($val) OR ! isset($val['price'], $val['qty']))
            {
                continue;
            }
            
            $this->_cart_contents['cart_total'] += ($val['price'] * $val['qty']);
            $this->_cart_contents['total_items'] += $val['qty'];
            $this->_cart_contents[$key]['subtotal'] = ($this->_cart_contents[$key]['price'] * $this->_cart_contents[$key]['qty']);
        
            //fetch the actual product stored in the database
            $this->CI->db->where('id', $val['id']);
            $get_product = $this->CI->db->get('product');
            $product_price_rules = '';
            foreach($get_product->result() as $gp)
            {
                $product_price_rules = $gp->price_rules; // this can be config based setting to enable/disable the functionality
                
                if (!empty($product_price_rules)) {
                    if ($this->cart_product_rules($product_price_rules, $val, $key) === FALSE) {
                        
						return FALSE;
					}
                }
            }
        }
        
        // Is our cart empty? If so we delete it from the session
        if (count($this->_cart_contents) <= 2)
        {
            $this->CI->session->unset_userdata('cart_contents');
            
            // Nothing more to do... coffee time!
            return FALSE;
        }
        
        // If we made it this far it means that our cart has data.
        // Let's pass it to the Session class so it can be stored
        $this->CI->session->set_userdata(array('cart_contents' => $this->_cart_contents));
        
        // Woot!
        return TRUE;
    }
	/**
	 * Cart total amount changes for product rules applied
	 * @param string $product_price_rules
	 * @param int $val
	 * @param string $key
	 * @return boolean
	 */
	public function cart_product_rules($product_price_rules, $val, $key)
    {
        $product_price_rules_array = json_decode($product_price_rules, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            log_message('error', 'pricing rules format is incorrect in product table, please update valid json');

            return FALSE;
        }
        // Cart Subtotal calculation for multiItemSelectDiscount key for pricing rules
        if (! empty($product_price_rules_array['multiItemSelectDiscount'])) {
            $this->cart_multi_item_discount($product_price_rules_array, $val, $key);
        }
    }
	public function cart_multi_item_discount($product_price_rules_array, $val, $key)
    {
        $product_price_rules_multi_item_select = $product_price_rules_array['multiItemSelectDiscount'];
        $priceValue = $discountValue = 0;
        $priceValue = intval($val['price']);
        $discountValue = intval($product_price_rules_multi_item_select['discount']);
        $quantity = intval($product_price_rules_multi_item_select['quantity']);

        if ($val['qty'] >= $quantity) {
            $numberOfTimeApplyDiscount = floor($val['qty'] / $quantity);
            $totalDiscountAmount = ($discountValue * $numberOfTimeApplyDiscount);
            $this->_cart_contents[$key]['subtotal'] = $this->_cart_contents[$key]['subtotal'] - $totalDiscountAmount;
        }
    }
    
}
