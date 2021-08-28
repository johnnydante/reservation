<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reservation extends Mailable
{
    use Queueable, SerializesModels;

    protected $strSubject, $strVehicleName, $strTemplate;

    /**
     * Create a new message instance.
     *
     * @param $strSubject
     * @param $strVehicleName
     */
    public function __construct($strSubject, $strVehicleName)
    {
        $this->strSubject = $strSubject;
        $this->strVehicleName = $strVehicleName;
        $this->strTemplate = $this->setTemplate();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'))
            ->subject($this->strSubject)
            ->markdown($this->strTemplate, ['vehicleName' =>  $this->strVehicleName]);
    }

    private function setTemplate() {
        switch ($this->strSubject) {
            default:
            case 'Nowa rezerwacja':
                return 'emails.new-reservation';
                break;
            case 'Przypomnienie o rezerwacji':
                return 'emails.reservation-reminder';
                break;
        }
    }
}
