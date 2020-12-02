<?php


namespace App\Useless;


use App\Useless\_Interface\Patient;

class Doctor extends Person
{

    private $speciality;
    private $tools;

    public function __construct($lastname, $firstname, $speciality, $tools = null)
    {
        parent::__construct($lastname, $firstname);

        $this->speciality = $speciality;
        $this->tools = $tools;
    }

    public function heal(Patient $person)
    {
        $message = $person->auscultate()."<br />";

        $message .= $this->getFirstname() . " " . $this->getLastname() .
            " (" . $this->speciality . ") soigne " .
            $person->getFirstname() . " " . $person->getLastname() .
            " (patient)";

        if ($this->tools != null) {
            $message .= " avec son " . $this->tools;
        }

        return $message;
    }

}