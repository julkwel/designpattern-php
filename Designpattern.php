<?php
/**
 * RAJERISON Julien
 * 14 - 03 - 2019
 * PHPstorm
 */

// design patter factory

/**
 * Class pdoFactory
 * Ny factory dia natao mba tsy hikitihana class marobe indray miaraka , izany hoe ny fuction ao anatin'ilay
 * class parent ihany no kitihanao dia efa mahazo daholo izay rehetra nanao instanciation
 */
class pdoFactory
{
    /**
     * @return PDO
     */
    public static function getBdd()
    {
        $db = new PDO('', '', '', '');
        $db->setAttribute('', '');
        return $db;
    }
}

/**
 * Instance factory class
 */
$instance = pdoFactory::getBdd();

//-----------------------------------------------------------//

// Observer pattern

/**
 * Class Observee
 * Ny observer dia natao mba hanaraha-maso ny fiovan'ny objet anankiray
 */
class Observee implements SplSubject
{
    protected $observers = [];
    protected $nom;

    /**
     * @param SplObserver $observer
     */
    public function attach(SplObserver $observer)
    {
        $this->observers[] = $observer;
    }

    /**
     * @param SplObserver $observer
     */
    public function detach(SplObserver $observer)
    {
        if (is_int($key = array_search($observer, $this->observers, true))) {
            unset($this->observers[$key]);
        }
    }

    /**
     * notify all observer if an event provide
     */
    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
        $this->notify();
    }
}

/**
 * Class observer1 observe an event via SplObserver
 */
class observer1 implements SplObserver
{
    public function update(SplSubject $subject)
    {
        echo 'update spl1';
    }
}

/**
 * Instance abserver and get an event via observer1
 */
$user = new Observee();
$user->attach(new Observer1);
$user->setNom('victor');


//-----------------------------------------------------------//

// factory

/**
 * Interface Formater
 * Ny factory dia natao mba hanampiana fonctionalité tsy ampy ao anatin'ny class instanciena
 */
interface Formater
{
    public function format($text);
}

/**
 * Class Writer
 */
abstract class Writer
{
    protected $formater;

    /**
     * @param $text
     * @return mixed
     */
    abstract public function write($text);

    /**
     * Writer constructor.
     * @param Formater $formater
     */
    public function __construct(Formater $formater)
    {
        $this->formater = $formater;
    }

}

//-----------------------------------------------------------//

// Singleton anti-pattern

/**
 * Class Singleton
 * Ny singleton dia natao mba tsy hahafahan'ny olona miinstancier ny function iray any anatin'ny constructor na clone
 * Antipattern izy satria tsy natao ho ampiasaina miverina indroa akory
 */
class Singleton
{
    private $nom;
    protected static $instance;

    /**
     * Singleton constructor.
     */
    protected function __construct()
    {
    } // prevent user to instance via constructor

    /**
     * Singleton clone
     */
    protected function __clone()
    {
    } // prevent user to clone

    /**
     * @return Singleton
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param $nom
     * @return mixed
     */
    public function setNom($nom)
    {
        return $this->nom = $nom;
    }
}

/**
 * Instance singleton
 */
$obj = Singleton::getInstance();
$obj->setNom('bebe');

//-----------------------------------------------------------//

// Itterator pattern

/**
 * Class tIterator_array
 * Ny itterator dia natao hiainoana ny etape ataon'ny objet iray
 */
class tIterator_array implements Iterator
{
    private $myArray;

    /**
     * tIterator_array constructor.
     * @param $givenArray
     */
    public function __construct($givenArray)
    {
        $this->myArray = $givenArray;
    }

    /**
     * @return mixed
     */
    function rewind()
    {
        return reset($this->myArray);
    }

    /**
     * @return mixed
     */
    function current()
    {
        return current($this->myArray);
    }

    /**
     * @return int|mixed|null|string
     */
    function key()
    {
        return key($this->myArray);
    }

    /**
     * @return mixed
     */
    function next()
    {
        return next($this->myArray);
    }

    /**
     * @return bool
     */
    function valid()
    {
        return key($this->myArray) !== null;
    }
}

/**
 * Itterate an array
 */
$obj = new tIterator_array([1, 2, 3]);
foreach ($obj as $key => $value) {
    var_dump($key, $value);
}

//-----------------------------------------------------------//

// Generator pattern
/**
 * @param $n
 * @return Generator
 * Ny generator dia natao higenerana objet iray avy amin'ny alalan'ny instanciation
 */
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

/**
 * Add a generator instance
 */
$fibs = fib(9);
foreach ($fibs as $fib) {
    echo " " . $fib;
}
