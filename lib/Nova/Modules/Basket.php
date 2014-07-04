<?php
/**
 * Creates a basket set up in an ecommerce environment. Returns an instance of this class, using sessions to return the
 * basket.
 *
 * Created by PhpStorm.
 * User: ciaran
 * Date: 02/07/14
 * Time: 09:23
 */

class Nova_Basket
{

    /**
     * @var array
     */
    protected $_items = array ();

    /**
     * @var array
     */
    protected $_itemRules = array ();



    /**
     * @param $itemRules
     * @return $this
     */
    public function setItemRules($itemRules)
    {
        $this->_itemRules = $itemRules;
        return $this;
    }

    /**
     * @return array
     */
    public function getItemRules()
    {
        return $this->_itemRules;
    }


    /**
     * @return mixed
     */
    public function getBasket()
    {
        return NovaSession::get('basket');
    }

    /**
     * Add an item to the basket
     *
     * @param array $item
     * @return $this
     */
    public function add(array $item)
    {
        //Check for an existing basket
        if (NovaSession::get('basket') !== false)
        {
            $this->_items = NovaSession::get('basket');
        }

        $item['name'] = key($item);
        $item['quantity'] = $item[key($item)];
        unset($item[key($item)]);

        //Check for any existing items. If there are, add the quantity on.
        foreach ($this->_items as $key=>$value)
        {
            if ($item['name'] == $value['name'])
            {
                $item['quantity'] += $value['quantity'];
                unset($this->_items[$key]);
            }
        }

        array_push($this->_items, $item);

        NovaSession::set('basket', $this->_items);
        return $this;
    }

    /**
     * Remove an item from the basket
     *
     * @param $item
     * @return $this
     */
    public function remove($item)
    {
        if(($key = array_search($item, NovaSession::get('basket'))) !== false) {
            NovaSession::destroyKey('basket', $key);
            return $this;
        }
        else
        {
            echo 'That item was not found in the basket';
        }
    }
}