<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nutritionist;
class Ticket extends Model
{
    use HasFactory;
    const TestType = 5;
    const TypeDietPlan = 3;

    public function userTest()
    {
        return $this->hasMany(UserTest::class, 'payment_transaction_id', 'payment_transation_id');
    }

    public function status()
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'ticket_owner_id');
    }

    public function nutritionist()
    {
        return $this->hasOne(Nutritionist::class, 'id', 'ticket_assigned_to');
    }

    public function getTicketsMessage($ticketId)
    {
        return Ticket::whereId($ticketId)->with(['user.healthStatus', 'ticketmessages.messages'])->first();
    }

    public function ticketmessages()
    {
        return $this->hasOne(GroupChat::class);
    }

    //Get Day By Number
    public function getTicketTitle($ticket_type)
    {

        switch ($ticket_type) {
            case 1:
                return "Report";
                break;
            case 2:
                return "Support";
                break;
            case 3:
                return "Diet Plan";
                break;
            case 4:
                return "Consultation";
                break;
            case 5:
                return "Test";
                break;
            case 6:
                return "Organ Consultation Without Report";
                break;
            case 7:
                return "Dna Test Support";
                break;
            case 8:
                return "Chronic Disease Support";
                break;
            case 9:
                return "Weight Loss Support";
                break;
            case 10:
                return "Diet Plan Support";
                break;
            case 11:
                return "Talk To Genahealthx";
                break;
            case 12:
                return "Other Support";
                break;

        }
    }

    public function getNutiritionistName($id){
        // with('NutritionistMetadata')->
        return Nutritionist::where('id',$id)->value('name');
    }
}
