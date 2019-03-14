<?php

// design patter factory
class pdoFactory{
    public static function getBdd(){
        $db = new PDO('','','','');
        $db->setAttribute('','');
        return $db;
    }
}

$instance = pdoFactory::getBdd();

// Observer pattern
class Observee implements SplSubject {
    protected $observers = [];
    protected $nom;

    public function attach(SplObserver $observer){
     $this->observers[] = $observer;
    }

    public function detach(SplObserver $observer){
        if (is_int($key = array_search($observer,$this->observers,true))){
            unset($this->observers[$key]);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer){
            $observer->update($this);
        }
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom){
        $this->nom = $nom;
        $this->notify();
    }
}

class observer1 implements SplObserver{
    public function update(SplSubject $subject)
    {
        echo 'update spl1';
    }
}

$user = new Observee();
$user->attach(new Observer1);
$user->setNom('victor');


// factory
interface Formater
{
    public function format($text);
}

abstract class Writer
{
 protected $formater;

 abstract public function write($text);

 public function __construct(Formater $formater)
 {
    $this->formater = $formater;
 }

}

// Singleton anti-pattern
class Singleton
{
    private $nom;
    protected static $instance;

    protected function __construct()
    {
    }

    protected function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public static function getInstance()
    {
        if(!isset(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        return $this->nom = $nom;
    }
}

$obj = Singleton::getInstance();
$obj->setNom('bebe');

// Itterator pattern
class tIterator_array implements Iterator {
    private $myArray  ;

    public function __construct( $givenArray ) {
        $this->myArray = $givenArray;
    }
    function rewind() {
        return reset($this->myArray);
    }
    function current() {
        return current($this->myArray);
    }
    function key() {
        return key($this->myArray);
    }
    function next() {
        return next($this->myArray);
    }
    function valid() {
        return key($this->myArray) !== null;
    }
}

$obj = new tIterator_array([ 1,2,3]);
foreach($obj as $key=>$value)
{
    var_dump($key,$value);
}

// Generator pattern
function fib($n)
{
    $cur = 1;
    $prev = 0;
    for ($i = 0; $i < $n; $i++) {
        yield $cur;

        $temp = $cur;
        $cur = $prev + $cur;
        $prev = $temp;
    }
}

$fibs = fib(9);
foreach ($fibs as $fib) {
    echo " " . $fib;
}