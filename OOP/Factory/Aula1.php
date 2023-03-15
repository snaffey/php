<?php
/* Factory Method Classes
    Padrao de criacao: relacionado a criacao de objetos
*/

class ProductFactory
{
    protected $product;
    public function make($model = null)
    {
        if (strtolower($model) == 'r') {
            return $this->product = new ProductModelR();
        }
        return $this->product = new ProductModelS('s', 'pc desktop');
    }
}

class ProductOrder
{
    protected $productOrders = array();
    protected $product;
    public function __construct()
    {
        $this->product = new ProductFactory();
    }
    public function order($model = null)
    {
        $product = $this->product->make($model);
        $this->productOrders[] = $product->getModel();
        $this->productOrders[] = $product->getType();
    }
    public function getProductOrders()
    {
        return $this->productOrders;
    }
}

interface Product
{
    public function getModel();
    public function getType();
}

class ProductModelR implements Product
{
    protected $model = 'r';
    protected $type = 'pc portatil';
    public function getModel()
    {
        return $this->model;
    }
    public function getType()
    {
        return $this->type;
    }
}

class ProductModelS implements Product
{
    protected $model;
    protected $type;
    public function __construct($m, $t)
    {
        $this->model = $m;
        $this->type = $t;
    }
    public function getModel()
    {
        return $this->model;
    }
    public function getType()
    {
        return $this->type;
    }
}

class ProductOrder1 implements Iterator
{
    protected $productOrders = array();
    protected $product;
    private $position = 0;

    public function __construct()
    {
        $this->product = new ProductFactory();
        $this->position = 0;
    }

    public function order($model = null)
    {
        $product = $this->product->make($model);
        $this->productOrders[] = $product->getModel();
        $this->productOrders[] = $product->getType();
    }

    public function getProductOrders()
    {
        return $this->productOrders;
    }

    public function rewind()
    {
        $this->position = 0;
    }

    public function current()
    {
        return $this->productOrders[$this->position];
    }

    public function key()
    {
        return $this->position;
    }

    public function next()
    {
        ++$this->position;
    }

    public function valid()
    {
        return isset($this->productOrders[$this->position]);
    }
}

$productOrders = new ProductOrder1();
$productOrders->order('r');
$productOrders->order('s');

foreach ($productOrders as $product) {
    echo $product . ' ';
}
