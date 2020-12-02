<?php


namespace App\Useless;


use App\Useless\_Interface\Patient;

class Person implements Patient
{

    private $lastname;
    private $firstname;

    /**
     * Person constructor.
     * @param $lastname
     * @param $firstname
     */
    public function __construct($lastname = null, $firstname = null)
    {
        $this->lastname = $lastname;
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    public function sayHello(): string
    {
        return 'Hello world';
    }

    public function auscultate(): string
    {
        return "Kof kof, suis balade docteur";
    }

}