<?php


namespace Modules\UserModule\Services;

use Exception;
use Illuminate\Support\Arr;
use Modules\UserModule\Repositories\OfferRideRepository;
use Prettus\Repository\Eloquent\BaseRepository;
use Spatie\Permission\Models\Role;

class OfferRideService extends BaseService
{
    protected $OfferRideRepository;
    public function __construct(OfferRideRepository $OfferRideRepository)

    {
        $this->OfferRideRepository = $OfferRideRepository;
    }

    /**
     * @inheritDoc
     */
    function getRepository(): BaseRepository
    {
        return $this->OfferRideRepository;
    }
    public function get_role_if_from_name($role_name){
        return Role::whereName($role_name)->first();

    }
    public function createofferRide(array $data)
    {

            Arr::only($data,['date_offer_ride','time_offer_ride','user_id','vechile_id','location_from','location_to','WhenToGo','offering_seats','Max_Speed','occupied_Seat','needs_desciption','Accept_Offer']);
            $offer_ride = $this->OfferRideRepository->create([
                'user_id' =>Arr::get($data, 'user_id'),
                'vechile_id'=>$data['vechile_id'],
                'location_from'=>$data['location_from'],
                'location_to'=>$data['location_to'],
                'WhenToGo'=>$data['WhenToGo'],
                'offering_seats'=>$data['offering_seats'],
                'Max_Speed'=>$data['Max_Speed'],
                'needs_desciption'=>$data['needs_desciption'],
                'Accept_Offer'=>$data['Accept_Offer'],
                'date_offer_ride'=>$data['date_offer_ride'],
                'time_offer_ride'=>$data['time_offer_ride']
            ]);
            $offer_ride = $this->OfferRideRepository->with(['user','vechile'])->find($offer_ride->id);
           return $offer_ride;

    }
    public function getallofferRide($page_size=10){
        return $this->OfferRideRepository->with(['user','vechile'])->paginate($page_size);
     }

     public function deleteofferRide($id){
        return $this->OfferRideRepository->delete($id);
     }

     public function updateofferRide(array $data,$id){
        Arr::only($data,['user_id','vechile_id','location_from','location_to','WhenToGo','offering_seats','Max_Speed','occupied_Seat','needs_desciption','Accept_Offer']);
        $offer_ride = $this->OfferRideRepository->update([
            'user_id' =>Arr::get($data, 'user_id'),
            'vechile_id'=>$data['vechile_id'],
            'location_from'=>$data['location_from'],
            'location_to'=>$data['location_to'],
            'WhenToGo'=>$data['WhenToGo'],
            'offering_seats'=>$data['offering_seats'],
            'Max_Speed'=>$data['Max_Speed'],
            'needs_desciption'=>$data['needs_desciption'],
            'Accept_Offer'=>$data['Accept_Offer']
            ],$id);

        return $offer_ride;
     }
}
