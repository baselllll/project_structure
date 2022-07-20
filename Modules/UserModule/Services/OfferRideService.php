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

            Arr::only($data,['person_number','duration','price','requested_number','message','status','distance','In_Between_Date','occupied_Seat','date_offer_ride','time_offer_ride','user_id','vechile_id','location_from','location_to','WhenToGo','offering_seats','Max_Speed','occupied_Seat','needs_desciption','Accept_Offer']);
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
                'time_offer_ride'=>$data['time_offer_ride'],
                'Occupied_Seat'=>$data['occupied_Seat'],
                'In_Between_Date'=>$data['In_Between_Date'],
                'distance'=>$data['distance'],
                'price'=>$data['price'],
                'requested_number'=>$data['requested_number'],
                'message'=>$data['message'],
                'status'=>$data['status'],
                'duration'=>$data['duration'],
                'person_number'=>$data['person_number'],
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
        Arr::only($data,['person_number','duration','price','requested_number','message','status','distance','In_Between_Date','occupied_Seat','date_offer_ride','time_offer_ride','user_id','vechile_id','location_from','location_to','WhenToGo','offering_seats','Max_Speed','occupied_Seat','needs_desciption','Accept_Offer']);
        $offer_ride = $this->OfferRideRepository->update([
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
            'time_offer_ride'=>$data['time_offer_ride'],
            'Occupied_Seat'=>$data['occupied_Seat'],
            'In_Between_Date'=>$data['In_Between_Date'],
            'distance'=>$data['distance'],
            'price'=>$data['price'],
            'requested_number'=>$data['requested_number'],
            'message'=>$data['message'],
            'status'=>$data['status'],
            'duration'=>$data['duration'],
            'person_number'=>$data['person_number'],
            ],$id);

        return $offer_ride;
     }
     public  function  searchOnRideOffer(array $data){
         Arr::only($data,['location_from','location_to','filter']);
         $offer_ride = $this->OfferRideRepository->with(['user','vechile'])
             ->Where('location_from', 'like', '%' .$data['location_from'] . '%')
             ->orWhere('location_to', 'like', '%' .$data['location_to'] . '%')
             ->orderBy($data['filter'], 'DESC')
             ->paginate(5);
         return $offer_ride;
     }
     public function updateStatusRideOffer($offer_ride_id,array $data){
         Arr::only($data,['status']);
         if($data['status']=="Requested"){
             $requested_number = $this->OfferRideRepository->findByField('id',$offer_ride_id)->first()->requested_number;
             $offer_ride_requested = $this->OfferRideRepository->with(['user','vechile'])->
             update([
                 'requested_number'=> ++$requested_number,
                 'status'=>$data['status']
             ],$offer_ride_id);
             $offer_ride_requested->save();
             return $offer_ride_requested;
         }
         $offer_ride = $this->OfferRideRepository->with(['user','vechile'])->
             update([
                'status'=>$data['status']
         ],$offer_ride_id);
         return $offer_ride;
     }
     public function updateMessageOnRideOffer($offer_ride_id,array $data){
         Arr::only($data,['message']);
         $offer_ride = $this->OfferRideRepository->with(['user','vechile'])->
         update([
             'message'=>$data['message']
         ],$offer_ride_id);
         return $offer_ride;
     }
}
