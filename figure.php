<?php
interface Figure
{
  public function getPerimeter();
  public function getSquare();
}
class Point
{
    private $x;
    private $y;

    /**
     * Point constructor.
     * @param $x
     * @param $y
     */
    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }
}

class Circle implements Figure
{
    const PI = 3.1415;
    private $center;
    private $b;
    /**
     * Circle constructor.
     * @param Point $center
     * @param Point $b
     */
    public function __construct(Point $center, Point $b)
    {
        $this->center = $center;
        $this->b = $b;
        $this->validate();
    }

    /**
     * @return float|int
     */
    public function getPerimeter()
    {
        return 2 * self::PI * $this->getRadius();
    }

    /**
     * @return float|int
     */
    public function getSquare()
    {
        return self::PI * pow($this->getRadius(), 2);
    }

    /**
     * @return float
     */
    private function getRadius()
    {
        return sqrt(pow((($this->b->getX()) - ($this->center->getX())), 2) + pow((($this->b->getY()) - ($this->center->getY())), 2));
    }

    /**
     *
     * @throws Exception
     */
    private function validate()
    {
        if($this->center->getX() == $this->b->getX() && $this->center->getY() == $this->b->getY()){
            throw new Exception('Invalid circle!');
        }
    }
}

class Rectangle implements Figure
{
    private $a;
    private $b;
    private $c;
    private $d;

    /**
     * Rectangle constructor.
     * @param Point $a
     * @param Point $b
     * @param Point $c
     * @param Point $d
     */
    public function __construct(Point $a, Point $b, Point $c, Point $d)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        $this->d = $d;
        $this->validate();
    }

    /**
     * @return float|int
     */
    public function getPerimeter()
    {
        return ($this->getAB() + $this->getBC()) * 2;
    }

    /**
     * @return float|int
     */
    public function getSquare()
    {
        return $this->getAB() * $this->getBC();
    }

    /**
     * @return float
     */
    private function getAB()
    {
        return sqrt(pow(($this->b->getX() - $this->a->getX()), 2) + pow(($this->b->getY() - $this->a->getY()), 2));
    }

    /**
     * @return float
     */
    private function getBC()
    {
        return sqrt(pow(($this->c->getX() - $this->b->getX()), 2) + pow(($this->c->getY() - $this->b->getY()), 2));
    }

    /**
     * @return float
     */
    private function getAC()
    {
        return sqrt(pow(($this->c->getX() - $this->a->getX()), 2) + pow(($this->c->getY() - $this->a->getY()), 2));
    }

    /**
     * @return float
     */
    private function getBD()
    {
        return sqrt(pow(($this->d->getX() - $this->b->getX()), 2) + pow(($this->d->getY() - $this->b->getY()), 2));
    }


    /**
     * @throws Exception
     */
    private function validate()
    {
        if(!$this->getAC() == $this->getBD()){
            throw new Exception('It is not rectangle!');
        }
    }
}


