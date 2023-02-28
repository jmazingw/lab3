<?php
namespace App\Models;

use CodeIgniter\Model;

class GuestModel extends Model
{
    protected $table = 'jdgonzales2_myguests';
    protected $allowedFields = ['ANSname', 'ANSsubject', 'email', 'ANSmessage'];

    public function getGuests($Name = false)
    {
        if ($Name === false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $Name])->first();
    }

}
